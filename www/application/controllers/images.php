<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Controller {


	public function __construct(){
		parent::__construct();	
		$this->load->helper("autentica");			
		$this->dados["usuario"] = verifica_sessao();		
	} 

	public function index(){
		show_404("images");
	}

	public function draw($filename, $x1, $x2, $y1, $y2){
		
		$this->load->helper("image");
		
		$img = ImageCreateFromJPEG( "imagenet/n01322604_10013.jpg" );
		$color = imagecolorallocate($img, 0, 0, 0);
		imagestring( $img, 5, 126, 22,"Ramon", $color );


	}

}


?>