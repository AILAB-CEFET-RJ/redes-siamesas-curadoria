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
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));		
		$this->load->database();
		$this->load->model("synset");
					
		$config['base_url'] = base_url() . 'synsets/index';	
		
		$sql = "select 
				count(synset.wnid) as qtde
			from 
				annotation
			left join
				synset
			on 
				annotation.wnid = synset.wnid";

		$resultado = $this->db->query($sql, array());
		$total_rows = $resultado->row()->qtde;	
		
		$config['total_rows'] = $total_rows;
		$this->dados['total_rows'] = $total_rows;

		$this->pagination->initialize($config); 
		
		$this->dados["paginacao"] = $this->pagination->create_links(); 
				
		$sql = "select 
					count(synset.wnid) as qtde, synset.*
				from 
					annotation
				left join
					synset
				on 
					annotation.wnid = synset.wnid
				group by
					synset.wnid
				limit 10";

		if($pagina > 0){
			$sql = $sql . " OFFSET " . $pagina; 
		}
		
		$this->dados["synsets"] = $this->db->query($sql, array())->result("synset");
		
		$this->dados["q"] = "";
		
		$this->load->view('topo', $this->dados);
		$this->load->view('synsets/lista', $this->dados);
		$this->load->view('rodape');
		
	}

	public function resultado_busca($q = "", $pagina = 0, $nz = ""){

		$q = $q == "" ? $_GET["q"] : $q;		
		
		if($q == "" || $q == null){
			redirect("synsets");
		}

		$this->load->library('pagination');	
		$this->load->database();	
		$this->load->model("synset");
		
		$this->db->like('synset.wnid', $q);		
		$this->db->or_like('words', $q);		

		$total_rows = $this->db->count_all_results("synset");

		$config['base_url'] = base_url('synsets/resultado_busca/' . $q);	
		$config['total_rows'] = $total_rows;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config); 
		
		$this->dados["paginacao"] = $this->pagination->create_links(); 

		$this->db->like('synset.wnid', $q);		
		$this->db->or_like('words', $q);	
				
		$this->db->limit(10, $pagina);
		

		$this->dados["synsets"] = $this->db->get("synset")->result("synset");
						
		$this->dados["q"] = $q;
		$this->dados["total_rows"] = $total_rows;
		$this->load->view('topo', $this->dados);
		$this->load->view('synsets/lista', $this->dados);
		$this->load->view('rodape');

	}


	public function detalhes($id){
		$this->load->database();
		$this->load->model("synset");


		$synset = $this->db->get_where("synset", array("wnid" => $id))->row(0, "synset");
		
		if(!$synset){						
			show_404("synset/detalhes");			
		} else {
			
			$this->dados["synset"] = $synset;
			$this->_loadImages($synset->wnid);
					
			$this->load->view('topo', $this->dados);
			$this->load->view('synsets/detalhes', $this->dados);
			$this->load->view('rodape');	
		}
	}	


	function _loadImages($wnid){
		$this->load->model("annotation");
		$this->load->helper("image");

		$this->db->where('is_valid', 1);
		$this->db->where('wnid', $wnid);

		$this->db->limit(10, 0);
		$this->dados["annotations"] = $this->db->get("annotation")->result("annotation");


		$this->db->where('is_valid', 1);
		$this->db->where('wnid', $wnid);
		$this->db->from('annotation');
		$this->dados["qtde_imagens"] = $this->db->count_all_results();
	
	}

}

?>