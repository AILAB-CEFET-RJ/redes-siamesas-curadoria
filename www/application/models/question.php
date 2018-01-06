<?php

class Question extends CI_Model {		
	var $id;
	var $img_id;
	var $statement;
	var $answer;
	var $curation;

	var $annotation;

	public function annotation(){
		if($this->annotation != null){
			return $this->annotation;
		} else {
			$this->load->model("annotation");
			if($this->img_id <> ""){	
				$this->annotation = $this->db->get_where("annotation",array("img_id" => $this->img_id))->row(0, "annotation");	

				if(!empty($this->annotation)){
					return $this->annotation;
				}	
			}
		}

		$this->annotation = new Annotation();
		return $this->annotation;
	}
}
?>