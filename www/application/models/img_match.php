<?php

class Img_match extends CI_Model 
{		
	var $vqa_img_id;
	var $imagenet_img_id;

	public function get_register_for_curation($usuario_id){
		$this->load->database();
		
		$offset = $this->get_random_offset();

		// recupero um par de imagens que não foi curado por qualquer usuario
		$query = $this->db->query("SELECT 
										i.vqa_img_id, i.imagenet_img_id 
									FROM
										img_match i
									INNER JOIN
										question q
									ON
										i.vqa_img_id = q.img_id
									LEFT JOIN 
										user_curation uc
									ON 
										uc.`vqa_img_id` = i.`vqa_img_id`
									AND 
										uc.`imagenet_img_id` = i.`imagenet_img_id` 
									WHERE 
										q.answer_type = 'yes/no'
									AND
										uc.`vqa_img_id` IS NULL 
									LIMIT 1 OFFSET $offset");
		
		if($query->num_rows() != 0){
			return $query->row();
		}
		
		// se não há par não curado por qualquer usuário, retorna um par ainda não finalizado para o usuário logado
		$query = $this->db->query("SELECT 
										i.*
									FROM
										img_match i
									INNER JOIN
										question q
									ON
										i.vqa_img_id = q.img_id
									LEFT JOIN 
										user_curation uc
									ON 
										uc.`vqa_img_id` = i.`vqa_img_id`
									AND 
										uc.`imagenet_img_id` = i.`imagenet_img_id` 
									WHERE 
										((uc.`usuario_id` = {$usuario_id} AND uc.`curation` = 0)
										OR
										(uc.`usuario_id` IS NULL AND uc.`curation` IS NULL))
									AND 
										q.answer_type = 'yes/no'
									LIMIT 1 OFFSET $offset");
		
		if($query->num_rows() != 0){
			return $query->row();
		}
		// se não existe mais pares para curadoria para o usuario logado retorna false
		return false;
	}

	function get_random_offset(){
		$query = $this->db->query("SELECT ROUND(RAND() * (SELECT COUNT(1) FROM annotation)) as offset");		
		return $query->first_row()->offset;
	}

}
?>