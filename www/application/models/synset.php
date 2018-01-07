<?php

class Synset extends CI_Model {		

	var $wnid;
	var $words;

	var $qtde;

	public function qtd_imagens(){
		return $this->qtde;
	}

}