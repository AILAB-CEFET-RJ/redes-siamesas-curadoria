<?php

class Question extends CI_Model {		
	var $id;
	var $img_id;
	var $statement;
	var $answer;

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

	public function get_question_for_curation($img_id_vqa, $img_id_imagenet, $usuario_id){
		$this->load->database();
		$query = $this->db->query("SELECT 
										q.question_id, q.statement, q.answer, qc.*
									FROM 
										question q
									LEFT JOIN
										question_curation qc
									ON
										q.question_id = qc.question_id
									WHERE
										q.answer_type = 'yes/no'
									AND
										q.img_id = '$img_id_vqa'
									AND
										(
											qc.question_id is null
										OR 
											(qc.question_id is not null AND qc.usuario_id <> '$usuario_id' AND qc.imagenet_img_id <> '$img_id_imagenet')
										)
									ORDER BY 
										RAND() LIMIT 1");
		
		if($query->num_rows() == 0){
			return false;
		}
		
		return $query->row();
	}

	public function get_new_question($img_id_vqa, $img_id_imagenet, $old_question_id, $usuario_id){
		$this->load->database();
		$query = $this->db->query("SELECT * FROM question q WHERE  q.answer_type = 'yes/no' and q.img_id = '$img_id_vqa' AND q.id <> '$old_question_id' AND q.id NOT IN (SELECT q1.question_id FROM question_curation q1 WHERE q1.vqa_img_id = '$img_id_vqa' AND q1.imagenet_img_id = '$img_id_imagenet' AND q1.usuario_id = '$usuario_id') ORDER BY RAND() LIMIT 1");
		
		if($query->num_rows() == 0){
			return false;
		}
		
		return $query->row();
	}
}
?>
