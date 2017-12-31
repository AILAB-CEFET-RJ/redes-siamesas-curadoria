<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Synsets extends CI_Controller {

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
		$this->load->model("synset");
		
		
		$config['base_url'] = base_url() . 'synsets/index';				
		$config['total_rows'] = $this->db->count_all_results("synset");		
		
		$this->pagination->initialize($config); 
		
		$this->dados["paginacao"] = $this->pagination->create_links(); 
				
		$this->db->limit(10, $pagina);
		$this->dados["synsets"] = $this->db->get("synset")->result("synset");
		
		$this->dados["q"] = "";
		
		$this->load->view('topo', $this->dados);
		$this->load->view('synsets/lista', $this->dados);
		$this->load->view('rodape');
	}

	public function resultado_busca($q = "", $pagina = 0){

		$q = $q == "" ? $_GET["q"] : $q;		
				
		if($q == "" || $q == null){
			redirect("synsets");
		}


		$this->load->library('pagination');	
		$this->load->database();	
		$this->load->model("synset");
		
		$this->db->like('wnid', $q);		
		$this->db->or_like('words', $q);		
		
		$total_rows = $this->db->count_all_results("synset");

		$config['base_url'] = base_url('synsets/resultado_busca/' . $q);	
		$config['total_rows'] = $total_rows;
		
		$this->pagination->initialize($config); 
		
		$this->dados["paginacao"] = $this->pagination->create_links(); 
		

		$this->db->like('wnid', $q);		
		$this->db->or_like('words', $q);	
		
		$this->db->limit(10, $pagina);
		

		$this->dados["synsets"] = $this->db->get("synset")->result("synset");
		
		//echo $this->db->last_query();
		
		$this->dados["q"] = $q;
		$this->dados["total_rows"] = $total_rows;
		$this->load->view('topo', $this->dados);
		$this->load->view('synsets/lista', $this->dados);
		$this->load->view('rodape');

		
	}

}

?>