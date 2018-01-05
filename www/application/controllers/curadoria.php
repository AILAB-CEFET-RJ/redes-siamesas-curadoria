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
		$this->db->where('curation', 0);
		$this->db->limit(1);
		$this->dados['img_match'] = $this->db->get('img_match')->result('img_match');

		$strView = $this->dados['img_match'] == NULL ? 'curadoria/empty' : 'curadoria/registrar';

		$this->load->view('topo', $this->dados);
		$this->load->view($strView, $this->dados);
		$this->load->view('rodape');

		/*$this->load->library('pagination');		
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
		$this->load->view('curadoria/empty', $this->dados);
		$this->load->view('rodape');
		*/
	}

	public function teste(){
		echo "entrei no metodo teste do controller curadoria ";
		//imprime o parametro passado na url
		//localhost/curadoria/teste/xxx
		//segment(x) onde x é o indice na url
		// segment(1) == curadoria (controller)
		// segment(2) == teste (metodo)
		// segment(3) == xxx (parametro)
		echo $this->uri->segment(3);
	}

}
?>