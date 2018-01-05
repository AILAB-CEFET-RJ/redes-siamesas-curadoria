<?php

class Img_match extends CI_Model {		
	var $vqa_img_id;
	var $imagenet_img_id;
	var $curation;

	var $annotation_vqa;
	var $annotation_imagenet;

	public function annotation_vqa(){
		if($this->annotation_vqa != null){
			return $this->annotation_vqa;
		} else {
			$this->load->model("annotation");	
			if($this->vqa_img_id <> ""){				
				$this->annotation_vqa = $this->db->get_where("annotation",array("img_id" => $this->img_id))->row(0, "annotation");				
				
				if(!empty($this->annotation_vqa)){
					return $this->annotation_vqa;
				}	
			}
			
			$this->annotation_vqa = new Annotation();		
			return $this->annotation_vqa;
		}	
	}


	public function annotation_imagenet(){
		if($this->annotation_imagenet != null){
			return $this->annotation_imagenet;
		} else {
			$this->load->model("annotation");
			if($this->imagenet_img_id <> ""){	
				$this->annotation_imagenet = $this->db->get_where("annotation",array("img_id" => $this->imagenet_img_id))->row(0, "annotation");	

				if(!empty($this->annotation_imagenet)){
					return $this->annotation_imagenet;
				}	
			}
		}

		$this->annotation_imagenet = new Annotation();
		return $this->annotation_imagenet;
	}
}
?>