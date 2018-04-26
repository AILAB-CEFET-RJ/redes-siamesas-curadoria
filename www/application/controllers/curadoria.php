<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curadoria extends CI_Controller {

	private $dados;	
	 
	public function __construct()
	{
		parent::__construct();	
		$this->load->helper("autentica");			
		$this->dados["usuario"] = verifica_sessao();		
	} 
	
	public function index()
	{
		$this->load->database();
		$this->load->model("img_match");
		if($imgMatch = $this->img_match->get_register_for_curation())
		{
			$this->load->model("annotation");
			$this->db->order_by('rand()');
			$annotationVqa = $this->db->get_where("annotation", array("img_id" => $imgMatch->vqa_img_id))->row(0, "annotation");
			$annotationImagenet = $this->db->get_where("annotation", array("img_id" => $imgMatch->imagenet_img_id))->row(0, "annotation");
			// admitindo que se o atributo curation de img_match ainda é 0, então ainda existem perguntas
			$this->load->model("question");

			$this->dados["question"] = $this->question->get_question_for_curation($annotationVqa->img_id, $annotationImagenet->img_id, $this->dados["usuario"]->id);
			$this->dados['annotationVqa'] = $annotationVqa;
			$this->dados['annotationImagenet'] = $annotationImagenet;

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
		if($newQuestion = $this->question->get_new_question($annotationVqaId, $annotationImagenetId, $oldQuestionId)){
			$this->dados["question"] = $newQuestion;
			$this->load->model("annotation");
			$this->dados["annotationVqa"] = $this->db->get_where("annotation", array("img_id" => $annotationVqaId))->row(0, "annotation");
			$this->dados["annotationImagenet"] = $this->db->get_where("annotation", array("img_id" => $annotationImagenetId))->row(0, "annotation");

			$strView = 'curadoria/registrar';
		}
		else{
			$strView = 'curadoria/empty_question';
		}

		$this->load->view('topo', $this->dados);
		$this->load->view($strView, $this->dados);
		$this->load->view('rodape');
	}

	public function register_match_question()
	{
		$this->load->helper(array('form', 'url'));

		$usuario_id = $this->dados["usuario"]->id;

		// captura variaveis POST
		$vqa_img_id = $this->input->post("annotation_vqa_id");
		$imagenet_img_id = $this->input->post("annotation_imagenet_id");
		$question_id = $this->input->post("question_id");

		// recuperar questao do banco
		$this->load->database();
		$this->load->model("question");
		$question = $this->db->get_where("question", array("id" => $question_id))->row(0, "question");

		// inicia a transação
		$this->db->trans_start();

		// inserir uma copia da questao para a imagem candidata usando a resposta do usuário
		$answer = $this->input->post("imagenet_answer");
		$this->dados = array(
			"img_id" => $imagenet_img_id,
			"statement" => $question->statement,
			"answer" => $answer			
		);
		$this->db->insert('question', $this->dados);

		// inserir registro em question_curation para a tripla (question_id, vqa_img_id, imagenet_img_id)
		$this->load->model("question_curation");
		$this->dados = array(
			"vqa_img_id" => $vqa_img_id,
			"imagenet_img_id" => $imagenet_img_id,
			"question_id" => $question_id,
			"usuario_id" => $usuario_id
		);
		$this->db->insert('question_curation', $this->dados);

		// verificar se ainda existe questão para o par (vqa_img_id, imagenet_img_id)
			// se não houver, update curation = true em img_match para o par (vqa_img_id, imagenet_img_id)
		if(!$newQuestion = $this->question->get_question_for_curation($vqa_img_id, $imagenet_img_id)){
			$this->load->model("img_match");
			$this->img_match->conclude($vqa_img_id, $imagenet_img_id);
		}

		$this->db->trans_complete();

		$this->load->view('topo', $this->dados);

		$this->load->view($this->db->trans_status() === FALSE ? 'curadoria/fail' : 'curadoria/sucesso');
		
		$this->load->view('rodape');
	}


	public function register_no_match_question()
	{
		$this->load->helper(array('form', 'url'));

		// captura variaveis POST
		$vqa_img_id = $this->input->post("annotation_vqa_id");
		$imagenet_img_id = $this->input->post("annotation_imagenet_id");
		$question_id = $this->input->post("question_id");

		// recuperar questao do banco
		$this->load->database();
		$this->load->model("question");
		$question = $this->db->get_where("question", array("id" => $question_id))->row(0, "question");

		// inicia a transação
		$this->db->trans_start();

		// inserir uma copia da questao para a imagem candidata usando a resposta do usuário
		/*$answer = $this->input->post("imagenet_answer") == 'Sim' ? 'sim' : 'nao';
		$this->dados = array(
			"img_id" => $imagenet_img_id,
			"statement" => $question->statement,
			"answer" => $answer
		);
		$this->db->insert('question', $this->dados);*/

		// inserir registro em question_curation para a tripla (question_id, vqa_img_id, imagenet_img_id)
		$this->load->model("question_curation");
		$this->dados = array(
			"vqa_img_id" => $vqa_img_id,
			"imagenet_img_id" => $imagenet_img_id,
			"question_id" => $question_id
		);
		$this->db->insert('question_curation', $this->dados);

		// verificar se ainda existe questão para o par (vqa_img_id, imagenet_img_id)
			// se não houver, update curation = true em img_match para o par (vqa_img_id, imagenet_img_id)
		if(!$newQuestion = $this->question->get_question_for_curation($vqa_img_id, $imagenet_img_id)){
			$this->load->model("img_match");
			$this->img_match->conclude($vqa_img_id, $imagenet_img_id);
		}

		$this->db->trans_complete();

		$this->load->view('topo', $this->dados);

		$this->load->view($this->db->trans_status() === FALSE ? 'curadoria/fail' : 'curadoria/sucesso');
		
		$this->load->view('rodape');
	}

}
?>
