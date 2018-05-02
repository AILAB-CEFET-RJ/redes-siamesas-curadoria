<?php

class User_curation extends CI_Model 
{		
	var $vqa_img_id;
	var $imagenet_img_id;
	var $usuario_id;
	var $curation;

	public function conclude($vqa_img_id, $imagenet_img_id, $usuario_id){
		$this->load->database();
		$query = $this->db->query("UPDATE user_curation SET curation = 1 WHERE vqa_img_id = '$vqa_img_id' AND imagenet_img_id = '$imagenet_img_id' AND usuario_id = '$usuario_id' ");		
	}	
}
?>