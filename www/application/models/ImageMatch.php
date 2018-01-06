
<?php

class ImageMatch extends CI_Model {		

	var $vqa_img_id;
	var $imagenet_img_id;
	var $curation;


	var $vqa_img;
	var $imagenet_img;

	public function vqa_image(){
		if($this->vqa_img != null){
			return $this->vqa_img;
		} else {
			$this->load->model("Annotation");	
			if($this->vqa_img_id <> ""){				
				$this->vqa_img = $this->db->get_where("Annotation",array("img_id" => $this->vqa_img_id))->row(0, "Annotation");				
				
				if(!empty($this->vqa_img)){
					return $this->vqa_img;
				}	
			}
			
			$this->vqa_img = new Annotation();		
			return $this->vqa_img;
		}	
	}


	public function set_vqa_image($vqa_img){
		if(get_class($vqa_img) == "Annotation"){
			this->vqa_img = $vqa_img;
		} else {
			throw new Exception("O paramtro deve ser do tipo Annotation", 1);	
		}
	}

	public function imagenet_image(){
		if($this->imagenet_img != null){
			return $this->imagenet_img;
		} else {
			$this->load->model("Annotation");	
			if($this->imagenet_img_id <> ""){				
				$this->imagenet_img = $this->db->get_where("Annotation",array("img_id" => $this->imagenet_img_id))->row(0, "Annotation");				
				
				if(!empty($this->imagenet_img)){
					return $this->imagenet_img;
				}	
			}
			
			$this->imagenet_img = new Annotation();		
			return $this->imagenet_img;
		}	
	}

	public function set_imagenet_image($imagenet_img){
		if(get_class($imagenet_img) == "Annotation"){
			this->imagenet_img = $imagenet_img;
		} else {
			throw new Exception("O paramtro deve ser do tipo Annotation", 1);	
		}
	}

}