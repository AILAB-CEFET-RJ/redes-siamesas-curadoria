<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annotations extends CI_Controller {

	private $dados;
	 
	public function __construct(){
		parent::__construct();	
		$this->load->helper("autentica");			
		$this->dados["usuario"] = verifica_sessao();		
	} 
	
	public function index($pagina = 0)
	{
		$this->load->library('pagination');		
		$this->load->database();
		$this->load->model("annotation");
		
		$this->db->where('is_valid', 1);

		$config['base_url'] = base_url() . 'annotations/index';				
		$config['total_rows'] = $this->db->count_all_results("annotation");		
		
	
		$this->pagination->initialize($config); 
		
		$this->dados["paginacao"] = $this->pagination->create_links(); 
		
		$this->db->where('is_valid', 1);
		$this->db->limit(10, $pagina);
		$this->dados["annotations"] = $this->db->get("annotation")->result("annotation");
		
		$this->dados["q"] = "";
		
		$this->load->view('topo', $this->dados);
		$this->load->view('annotations/lista', $this->dados);
		$this->load->view('rodape');
	}

	public function details($id)
	{
		$this->load->database();
		$this->load->model("annotation");
		$this->load->helper("image");
		
		$annotation = $this->db->get_where("annotation", array("img_id" => $id))->row(0, "annotation");
		
		if(!$annotation){						
			show_404("annotations/excluir");			
		}	
			
		$this->dados["annotation"] = $annotation;
		$this->dados["image_size"] = get_image_size($annotation->filename);
		$this->dados["bound_box"] = get_bbox_coordinates($annotation->bound_box(), $this->dados["image_size"]);

		$this->load->view('topo', $this->dados);
		$this->load->view('annotations/detalhes', $this->dados);
		$this->load->view('rodape');		
	}


	public function atualizar(){
		$this->load->helper(array('form', 'url'));		
		$this->load->library('form_validation');
		$this->load->database();	
		
		$id = $this->input->post("id");

		$this->form_validation->set_rules('nome', 'Raz&atilde;o Social', 'required|is_unique[annotation.nome]|xss_clean');		

		$this->load->view('topo', $this->dados);
		
		if ($this->form_validation->run() == FALSE)
		{	
			$this->load->view('annotations/criar');
		}
		else
		{
			$this->dados = array();	
			$this->dados["nome"] = $this->input->post("nome");						
							
			$this->db->where('id', $id);				
			$this->db->update('annotation', $this->dados);
			$this->load->view('annotations/atualizado');
		}
			
		$this->load->view('rodape');
	}

	public function resultado_busca($q = "", $pagina = 0){

		$q = $q == "" ? $_GET["q"] : $q;		
				
		if($q == "" || $q == null){
			redirect("annotations");
		}

		$this->load->library('pagination');	
		$this->load->database();	
		$this->load->model("annotation");
		
		$sql = "SELECT COUNT(*) AS `numrows` 
				FROM annotation as a
				INNER JOIN synset as s
				ON a.wnid = s.wnid
				WHERE a.`is_valid` = ? 
				AND (a.`wnid` LIKE ? OR a.`attrs` LIKE ? or s.`words` LIKE ?)";
		
		$resultado = $this->db->query($sql, array(1, "%".$q."%", "%".$q."%", "%".$q."%"));		
		
		$total_rows = $resultado->row()->numrows;		

		$config['base_url'] = base_url('annotations/resultado_busca/' . $q);	
		$config['total_rows'] = $total_rows;
			$config['uri_segment'] = 4;
		$this->pagination->initialize($config); 
		
		$this->dados["paginacao"] = $this->pagination->create_links(); 
				
		$sql = "SELECT a.img_id, a.wnid, a.url, a.filename, a.attrs, a.md5, a.is_valid, a.dataset_source
				FROM annotation as a
				INNER JOIN synset as s
				ON a.wnid = s.wnid
				WHERE a.`is_valid` = ? 
				AND (a.`wnid` LIKE ? OR a.`attrs` LIKE ? or s.`words` LIKE ?) 
				LIMIT 10";
		
		if($pagina > 0){
			$sql = $sql . " OFFSET " . $pagina; 
		}

		$this->dados["annotations"] = $this->db->query($sql, array(1, "%".$q."%", "%".$q."%", "%".$q."%"))->result("annotation");
				

		$this->dados["q"] = $q;
		$this->dados["total_rows"] = $total_rows;
		$this->load->view('topo', $this->dados);
		$this->load->view('annotations/lista', $this->dados);
		$this->load->view('rodape');

		
	}

}
?>