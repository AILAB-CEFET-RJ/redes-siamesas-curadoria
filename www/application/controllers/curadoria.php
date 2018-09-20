<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curadoria extends CI_Controller {

	private $dados;	

	private $APPLICABLE = 1;
	private $NOT_APPLICABLE = 0;
	 
	public function __construct()
	{
		parent::__construct();	
		$this->load->helper("autentica");			
		$this->dados["usuario"] = verifica_sessao();
	} 
	
	public function index()	{		
		$this->load->database();
		$this->load->model("img_match");
		if($imgMatch = $this->img_match->get_next_register_by_distance($this->dados["usuario"]->id))
		{
			
			$imgMatch->img_id = $imgMatch->filename;
			$imgMatch->filename = $imgMatch->filename . ".JPEG";

			
			$this->load->model("question");
			$this->question->id = $imgMatch->question_id;
			$this->question->img_id = $imgMatch->vqa_img;
			$this->question->statement = $imgMatch->statement;
			$this->question->answer = $imgMatch->answer;
			
			$this->dados["question"] = $this->question;
			
			if($this->dados["question"] === false){
				die("Question não encontrada");
				redirect("curadoria/index");	
			}

			$this->dados['annotationImagenet'] = $imgMatch;

			$strView = 'curadoria/registrar';
		}
		else
		{
			$strView = 'curadoria/empty';
		}
				
		$this->load->view('topo', $this->dados);
		$this->load->view($strView, $this->dados);
		$this->load->view('rodape');
	}

	public function change_question($annotationVqaId, $annotationImagenetId, $oldQuestionId)
	{
		$this->load->database();
		$this->load->model("question");
		if($newQuestion = $this->question->get_new_question($annotationVqaId, $annotationImagenetId, $oldQuestionId, $this->dados["usuario"]->id)){
			$this->dados["question"] = $newQuestion;			
			$this->load->model("annotation");
			$this->dados["annotationVqa"] = $this->db->get_where("annotation", array("img_id" => $annotationVqaId))->row(0, "annotation");
			$this->dados["annotationImagenet"] = $this->db->get_where("annotation", array("img_id" => $annotationImagenetId))->row(0, "annotation");

			$strView = 'curadoria/registrar';
		}
		else{
			redirect("curadoria/index");	
		}

		$this->load->view('topo', $this->dados);
		$this->load->view($strView, $this->dados);
		$this->load->view('rodape');
	}

	public function register_match_question(){				
		$this->registerCuration($this->APPLICABLE, array());
	}


	public function register_no_match_question($annotationVqaId, $annotationImagenetId, $oldQuestionId)	{
		$vars = array('annotation_vqa_id' => $annotationVqaId, 'annotation_imagenet_id' => $annotationImagenetId, 'question_id' => $oldQuestionId);
		$this->registerCuration($this->NOT_APPLICABLE, $vars);
	}

	private function registerCuration($applicable, $vars)
	{
		$this->load->helper(array('form', 'url'));
		$usuario_id = $this->dados["usuario"]->id;

		if(!empty($_POST)){
		// captura variaveis POST
			$vqa_img_id = $this->input->post("annotation_vqa_id");
			$imagenet_img_id = $this->input->post("annotation_imagenet_id");
			$question_id = $this->input->post("question_id");
			$answer = $applicable == 1 ? $this->input->post("imagenet_answer") : NULL;
		} else{
			$vqa_img_id = $vars["annotation_vqa_id"];
			$imagenet_img_id = $vars["annotation_imagenet_id"];
			$question_id = $vars["question_id"];
			$answer = $applicable == 1 ? $this->input->post("imagenet_answer") : NULL;
		}

		// inicia a transação
		$this->load->database();
		$this->db->trans_start();

		// insere registro em user_curation, se for o caso
		$this->insertUserCuration($vqa_img_id, $imagenet_img_id, $usuario_id);

		// insere registro em question_curation para a quádrupla (question_id, vqa_img_id, imagenet_img_id, usuario_id)
		$this->insertQuestionCuration($vqa_img_id, $imagenet_img_id, $usuario_id, $question_id, $applicable, $answer);

		// atualiza user_curation, se for o caso
		//$this->updateUserCuration($vqa_img_id, $imagenet_img_id, $usuario_id);

		$this->db->trans_complete();

		/*$this->load->view('topo', $this->dados);
		$this->load->view($this->db->trans_status() === FALSE ? 'curadoria/fail' : 'curadoria/sucesso');
		$this->load->view('rodape');*/
		//redirect('curadoria/change_question/' . $vqa_img_id . '/' .  $imagenet_img_id . '/' . $question_id);
		redirect('curadoria/');
	}

	private function insertUserCuration($vqa_img_id, $imagenet_img_id, $usuario_id)
	{
		$this->load->model("user_curation");
		$user_curation = $this->db->get_where("user_curation", array("vqa_img_id" => $vqa_img_id, "imagenet_img_id" => $imagenet_img_id, "usuario_id" => $usuario_id))->row(0, "user_curation");

		if(!$user_curation)
		{
			$this->dados = array(
				"vqa_img_id" => $vqa_img_id,
				"imagenet_img_id" => $imagenet_img_id,
				"usuario_id" => $usuario_id,
				"curation" => 0
			);
			$this->db->insert('user_curation', $this->dados);
		}
	}

	private function insertQuestionCuration($vqa_img_id, $imagenet_img_id, $usuario_id, $question_id, $applicable, $answer)
	{
		try {
		
			$this->load->model("question_curation");
			$this->dados = array(
				"vqa_img_id" => $vqa_img_id,
				"imagenet_img_id" => $imagenet_img_id,
				"question_id" => $question_id,
				"usuario_id" => $usuario_id,
				"answer" => $answer,
				"applicable" => $applicable
			);
			$this->db->insert('question_curation', $this->dados);
		} catch(Exception $e) {

		}
	}

	private function updateUserCuration($vqa_img_id, $imagenet_img_id, $usuario_id)
	{
		$this->load->model("question");
		if(!$newQuestion = $this->question->get_question_for_curation($vqa_img_id, $imagenet_img_id, $usuario_id)){
			$this->load->model("user_curation");
			$this->user_curation->conclude($vqa_img_id, $imagenet_img_id, $usuario_id);
		}
	}

	private function insertMatchQuestion($question_id, $imagenet_img_id, $answer)
	{
		// ########################################################################################
		// COMENTADO POR CONTA DA MUDANÇA DE REQUISITO
		// A COPIA DA QUESTÃO PARA A IMAGEM CANDIDATA SERÁ FEITA POSTERIORMENTE CONFORME ANÁLISE DAS RESPOSTAS DADOS PELOS USUÁRIOS
		// ########################################################################################
		/*
		// recuperar questao do banco
		$this->load->model("question");
		$question = $this->db->get_where("question", array("id" => $question_id))->row(0, "question");

		// inserir uma copia da questao para a imagem candidata usando a resposta do usuário
		$this->dados = array(
			"img_id" => $imagenet_img_id,
			"statement" => $question->statement,
			"answer" => $answer			
		);
		$this->db->insert('question', $this->dados);
		*/
	}
}
?>
