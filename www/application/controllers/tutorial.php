<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutorial extends CI_Controller {

	private $dados;
	 
	public function __construct(){
		parent::__construct();	
		$this->load->helper("autentica");			
		$this->dados["usuario"] = verifica_sessao();		
    } 


    public function index(){
        $this->load->view('topo', $this->dados);
		$this->load->view('tutorial');
		$this->load->view('rodape');
    }
    
}