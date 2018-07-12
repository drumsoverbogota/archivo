<?php
class Lanzamiento_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function update_image($id = NULL, $imagen = NULL)
        {
        	if($id == NULL){
        		return FALSE;
        	}
        	else{
        		$data = array(
			        'imagen'  => $imagen
				);

				$this->db->where('id', $id);
				$this->db->update('lanzamiento', $data);
        	}
        }

        public function get_formatos()
        {
        	$query = $this->db->query("SHOW COLUMNS FROM lanzamiento WHERE Field = 'formato'");
        	$formatos_array = $query->row( 0 )->Type;
			preg_match("/^enum\(\'(.*)\'\)$/", $formatos_array, $matches);
			$enum = explode("','", $matches[1]);        	
			return $enum;
        }

        public function get_bandas_lanzamientoid($id)
        {        	
        	$query = $this->db->query("SELECT `banda`.`id`, `banda`.`nombre`
				FROM `banda`
				INNER JOIN `banda_lanzamiento` ON `banda`.`id` = `banda_lanzamiento`.`banda_id` 
				INNER JOIN `lanzamiento` ON `banda_lanzamiento`.`lanzamiento_id` = `lanzamiento`.`id`
				WHERE `lanzamiento`.`id` = ".$id);
        	return $query->result_array();
        }

        public function get_lanzamientos($limit = 10, $page = 1)
        {
			/*
			SELECT `lanzamiento`.*, group_concat(DISTINCT `banda`.`nombre` ORDER BY `banda`.`nombre` DESC SEPARATOR ', ')
			FROM `lanzamiento`
			INNER JOIN `banda_lanzamiento` ON `lanzamiento`.`id` = `banda_lanzamiento`.`lanzamiento_id` 
			INNER JOIN `banda` ON `banda_lanzamiento`.`banda_id` = `banda`.`id`  
			GROUP BY `lanzamiento`.`id`
			*/

        	$query = $this->db->query('SELECT `lanzamiento`.*, group_concat(DISTINCT `banda`.`nombre` ORDER BY `banda`.`nombre` DESC SEPARATOR \'\n \') AS `bandas`
			FROM `lanzamiento`
			LEFT JOIN `banda_lanzamiento` ON `lanzamiento`.`id` = `banda_lanzamiento`.`lanzamiento_id` 
			LEFT JOIN `banda` ON `banda_lanzamiento`.`banda_id` = `banda`.`id`  
            WHERE `lanzamiento`.`visible` = 1			
			GROUP BY `lanzamiento`.`id` ORDER BY `lanzamiento`.`nombre`
        		LIMIT '.$limit.' OFFSET '.(($page-1)*$limit));
			return $query->result_array();
        }
		
		public function get_lanzamiento($id = FALSE)
		{
				if ($id === FALSE)
				{
						$query = $this->db->get('lanzamiento');
						return $query->result_array();
				}

				$query = $this->db->get_where('lanzamiento', array('id' => $id));
				return $query->row_array();
		}
		public function set_lanzamiento()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');
			
			$visible = 0;
			if ($this->input->post('visible') == 'on'){
				$visible = 1;
			}			

			$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),				
				'referencia' => $this->input->post('referencia'),
				'formato' => $this->input->post('formato'),
				'anho' => $this->input->post('anho'),
				'tracklist' => $this->input->post('tracklist'),
				'creditos' => $this->input->post('creditos'),
				'notas' => $this->input->post('notas'),
				'link' => $this->input->post('link'),
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha_modificacion' => date('Y-m-d H:i:s'),
				'visible' => $visible,
			);

			$this->db->insert('lanzamiento', $data);
			return $this->db->insert_id();
		}		
		
		public function edit_lanzamiento()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');

			$visible = 0;
			if ($this->input->post('visible') == 'on'){
				$visible = 1;
			}				
			
			$id = $this->input->post('id');
			$data = array(									
				'nombre' => $this->input->post('nombre'),				
				'referencia' => $this->input->post('referencia'),
				'formato' => $this->input->post('formato'),
				'anho' => $this->input->post('anho'),
				'tracklist' => $this->input->post('tracklist'),
				'creditos' => $this->input->post('creditos'),
				'notas' => $this->input->post('notas'),
				'link' => $this->input->post('link'),
				'fecha_modificacion' => date('Y-m-d H:i:s'),
				'visible' => $visible,
			);

			$this->db->where('id', $id);
			$this->db->update('lanzamiento', $data);
			return $this->input->post('id');
		}						

		public function delete_lanzamiento($id)
		{
			$this->db->delete('lanzamiento', array('id' => $id));
		}		
}