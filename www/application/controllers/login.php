<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	private $TAMANHO_NOVA_SENHA = 8;
	private $usuario;

	public function __construct(){
		parent::__construct();	
		$this->load->library('session');
				
		$usuario = unserialize($this->session->userdata("usuario_logado"));	
	} 

	public function index()	{		
		
		if( $this->usuario != null ){
			redirect("curadoria");
		}

		$this->load->helper("form");
		
		$this->load->view('topo');
		$this->load->view('login/formulario');
		$this->load->view('rodape');
	}
	
	public function autentica(){
		
		$this->load->library(array('form_validation', 'encrypt'));
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('senha', 'senha', 'required|min_length[6]');
						
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('topo');
			$this->load->view('login/formulario');
			$this->load->view('rodape');
		}
		else
		{			
			$email = $this->input->post("email");
			$senha = $this->input->post("senha");
			
			
			if(iniciar_sessao($email, $senha)){				
				redirect("curadoria");
			} else {				
				$data["erro"] = "Invalid Username or password";	
				$this->load->view('topo');
				$this->load->view('login/formulario', $data);
				$this->load->view('rodape');
			}
		}		
	}

	public function esqueci_minha_senha(){
		$this->load->helper("form");
		
		$this->load->view('topo');
		$this->load->view('login/esqueci_minha_senha');
		$this->load->view('rodape');
	}

	public function recuperar_senha(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('topo');
			$this->load->view('login/esqueci_minha_senha');
			$this->load->view('rodape');
		} else {
			$email = $email = $this->input->post("email");
			$this->load->database();
			$this->load->model("usuario");
			$usuarioInstance = $this->db->get_where("usuario", array("email" => $email))->row(0, "Usuario");

			if($usuarioInstance){
				$this->load->library('encrypt');
				$novaSenha = $this->_gerarNovaSenha($this->TAMANHO_NOVA_SENHA);
				$usuarioInstance->senha = $this->encrypt->encode($novaSenha);				
				$this->_mandaEmail($usuarioInstance, $novaSenha);
				$this->db->where('id', $usuarioInstance->id);
				$this->db->update("usuario", $usuarioInstance);
				$data["email"] = $usuarioInstance->email;
				$this->load->view('topo');
				$this->load->view('login/senha_enviada', $data);
				$this->load->view('rodape');
			} else {
				$data["erro"] = "Email n&atilde;o cadastrado";	
				$this->load->view('topo');
				$this->load->view('login/esqueci_minha_senha', $data);
				$this->load->view('rodape');
			}			
		}
	}

	public function _gerarNovaSenha($tamanho){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $novaSenha = '';
	    for ($i = 0; $i < $tamanho; $i++) {
	        $novaSenha .= $chars[rand(0, strlen($chars) - 1)];
	    }
	    return $novaSenha;
	}

	public function _enviarSenhaPorEmail($usuarioInstance, $novaSenha){
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'rsilva@ramonsilva.net',
		    'smtp_pass' => 'ramonsilvanet',
		    'mailtype'  => 'text', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('rsilva@ramonsilva.net', 'Ramon Silva');
		$this->email->to($usuarioInstance->email); 
		$this->email->subject('[No reply] - Imagenet Curation');
		$mensagem = 'Sua nova senha foi gerada em nosso site em ' . date("d/m/Y h:i:s") . ".";
		$mensagem += "\n\rSua senha antiga nÃ£o Ã© mais vÃ¡lida.";
		$mensagem += "\n\rSenha : " . $novaSenha;
		$mensagem =+ "\n\rIP: " . $this->input->ip_address();
		$this->email->message($mensagem);	

		$this->email->send();

		echo $this->email->print_debugger();
	}

	public function _mandaEmail($usuarioInstance, $novaSenha){
		$this->load->helper('email');
		$mensagem = 'Sua nova senha foi gerada em nosso site em ' . date("d/m/Y h:i:s") . ".";
		$mensagem += "\nYour old password is no longer valid.";
		$mensagem += "\nPassword : " . $novaSenha;
		$mensagem =+ "\nIP: " . $this->input->ip_address();
		send_email($usuarioInstance->email, '[No Reply] - Imagenet Curation', $mensagem);
	}

	public function ver_senha(){
		$this->load->library('encrypt');
		echo $this->encrypt->encode("123456");
	}
}