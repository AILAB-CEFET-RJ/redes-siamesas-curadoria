<?php

class Synset extends CI_Model {		

	var $wnid;
	var $words;

	var $qtd_imagens = -1;

	public function qtd_imagens(){
		if($this->qtd_imagens != -1){
			return $this->qtd_imagens;
		} else {
			$this->load->model("annotation");	
			
			if($this->wnid <> ""){
				$this->db->where("wnid", $this->wnid);
				$this->qtd_imagens = $this->db->count_all_results("annotation");	
				return $this->qtd_imagens;
			}
							
			return 0;
		}	
	}

}