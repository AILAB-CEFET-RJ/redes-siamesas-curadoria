<?php

class Annotation extends CI_Model {		
	var $img_id;
	var $wnid;				
	var $url;
	var $filename;
	var $attr;
	var $md5;
	var $is_valid;

	var $b_box;

	public function bound_box(){
		if($this->b_box != null){
			return $this->b_box;
		} else {
			$this->load->model("bound_box");	
			if($this->img_id <> ""){				
				$this->b_box = $this->db->get_where("bound_box",array("img_id" => $this->img_id))->row(0, "bound_box");				
				
				if(!empty($this->b_box)){
					return $this->b_box;
				}	
			}
			
			$this->b_box = new bound_box();		
			return $this->b_box;
		}	
	}

}
?>