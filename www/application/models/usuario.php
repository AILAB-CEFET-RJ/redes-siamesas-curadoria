<?php

class Usuario extends CI_Model {
		
	var $id;
	var $nome;
	var $email;
	var $senha;
	var $data_ultimo_login;
	var $admin;		
	var $qtd_pares_curados;


	public function pares_curados(){
		if($this->qtd_pares_curados == null){
			$query = $this->db->query("select count(1) as qtde from question_curation where usuario_id = $this->id");
			$this->qtd_pares_curados = $query->first_row()->qtde;
		} 	
		return $this->qtd_pares_curados;	
	}

}
?>