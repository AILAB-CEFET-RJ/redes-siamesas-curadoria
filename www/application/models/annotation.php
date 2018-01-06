<?php

class Annotation extends CI_Model {		
	var $img_id;
	var $wnid;				
	var $url;
	var $filename;
	var $attr;
	var $md5;
	var $is_valid;
	var $dataset_source;

	var $b_box;
	var $synset;
	var $img_match;

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


	public function synset(){
		if($this->synset != null){
			return $this->synset;
		} else {
			$this->load->model("synset");
			if($this->wnid <> ""){	
				$this->synset = $this->db->get_where("synset",array("wnid" => $this->wnid))->row(0, "synset");	

				if(!empty($this->synset)){
					return $this->synset;
				}	
			}
		}

		$this->synset = new Synset();
		return $this->synset;
	}


	public function image_match(){
		if($this->img_match != null){
			return $this->img_match;
		} else {
			$this->load->model("imagematch");
			if($this->wnid <> ""){	

				if($this->dataset_source == "imagenet"){
					$this->synset = $this->db->get_where("img_match", array("imagenet_img_id" => $this->img_id))->result(0, "imagematch");	
				} else {
					$this->synset = $this->db->get_where("img_match",array("vqa_img_id" => $this->img_id))->result(0, "imagematch");	
				}

				if(!empty($this->synset)){
					return $this->synset;
				}	
			}
		}

		$this->synset = new Synset();
		return $this->synset;
	}
}
?>