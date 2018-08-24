<?php
class Lanzamiento_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


        public function search_lanzamiento($match = '')
        {
        	$this->db->where('visible', 1); 
        	$this->db->group_start();
        	$this->db->or_like('nombre', $match); 
        	$this->db->or_like('referencia', $match); 
        	$this->db->or_like('anho', $match); 
        	$this->db->or_like('tracklist', $match); 
        	$this->db->or_like('creditos', $match); 
        	$this->db->or_like('notas', $match); 
        	
        	$this->db->group_end();
        	$query = $this->db->get('lanzamiento');
        	//echo $this->db->last_query();
        	return $query->result_array();

        }

        public function update_image($nombrecorto = NULL, $imagen = NULL)
        {
        	if($nombrecorto == NULL){
        		return FALSE;
        	}
        	else{
        		$data = array(
			        'imagen'  => $imagen
				);

				$this->db->where('nombrecorto', $nombrecorto);
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

        public function get_bandas_lanzamientoid($nombrecorto)
        {        	
        	$query = $this->db->query("SELECT `banda`.`id`, `banda`.`nombre`, `banda`.`nombrecorto`
				FROM `banda`
				INNER JOIN `banda_lanzamiento` ON `banda`.`id` = `banda_lanzamiento`.`banda_id` 
				INNER JOIN `lanzamiento` ON `banda_lanzamiento`.`lanzamiento_id` = `lanzamiento`.`id`
				WHERE `lanzamiento`.`nombrecorto` = '".$nombrecorto."'");
        	return $query->result_array();
        }

        public function get_lanzamientos($limit = 10, $page = 1, $visible = 'false')
        {
			/*
			SELECT `lanzamiento`.*, group_concat(DISTINCT `banda`.`nombre` ORDER BY `banda`.`nombre` DESC SEPARATOR ', ')
			FROM `lanzamiento`
			INNER JOIN `banda_lanzamiento` ON `lanzamiento`.`id` = `banda_lanzamiento`.`lanzamiento_id` 
			INNER JOIN `banda` ON `banda_lanzamiento`.`banda_id` = `banda`.`id`  
			GROUP BY `lanzamiento`.`id`
			*/

			if($visible == 'false'){
	        	$query = $this->db->query('SELECT `lanzamiento`.*, group_concat(DISTINCT `banda`.`nombre` ORDER BY `banda`.`nombre` DESC SEPARATOR \'\n \') AS `bandas`
				FROM `lanzamiento`
				LEFT JOIN `banda_lanzamiento` ON `lanzamiento`.`id` = `banda_lanzamiento`.`lanzamiento_id` 
				LEFT JOIN `banda` ON `banda_lanzamiento`.`banda_id` = `banda`.`id`  
	            WHERE `lanzamiento`.`visible` = 1			
				GROUP BY `lanzamiento`.`id` ORDER BY `lanzamiento`.`nombre`
	        		LIMIT '.$limit.' OFFSET '.(($page-1)*$limit));				
			}
			else{
	        	$query = $this->db->query('SELECT `lanzamiento`.*, group_concat(DISTINCT `banda`.`nombre` ORDER BY `banda`.`nombre` DESC SEPARATOR \'\n \') AS `bandas`
				FROM `lanzamiento`
				LEFT JOIN `banda_lanzamiento` ON `lanzamiento`.`id` = `banda_lanzamiento`.`lanzamiento_id` 
				LEFT JOIN `banda` ON `banda_lanzamiento`.`banda_id` = `banda`.`id`  
				GROUP BY `lanzamiento`.`id` ORDER BY `lanzamiento`.`nombre`
	        		LIMIT '.$limit.' OFFSET '.(($page-1)*$limit));				

			}
			return $query->result_array();
        }
		
		public function get_lanzamiento($nombrecorto = FALSE, $visible = 'false')
		{
				if ($nombrecorto === FALSE)
				{	
					if($visible == 'false'){
						$query = $this->db->get_where('lanzamiento', array('visible' => 1));
						return $query->result_array();
					}
					else{
						$query = $this->db->get('lanzamiento');
						return $query->result_array();						
					}
				}
				$query = $this->db->get_where('lanzamiento', array('nombrecorto' => $nombrecorto));
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


			$iteracion = 0;
			$nombre = $this->input->post('nombre');
			do {
				$corto = strtolower(preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ', '-', $nombre)));	
				$corto = substr($corto, 0, 27);
				if($iteracion > 0){
					$corto = $corto.$iteracion;
				}
				$iteracion = $iteracion + 1;
				$query = $this->db->get_where('lanzamiento', array('nombrecorto' => $corto));

			} while (!empty($query->row_array()));

			$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),
				'nombrecorto' => $corto,
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
			$id = $this->db->insert_id();
			$query = $this->db->get_where('lanzamiento', array('id' => $id));
			return $query->row()->nombrecorto;

		}		
		
		public function edit_lanzamiento()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');

			$visible = 0;
			if ($this->input->post('visible') == 'on'){
				$visible = 1;
			}				
			
			$nombrecorto = $this->input->post('nombrecorto');
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

			$this->db->where('nombrecorto', $nombrecorto);
			$this->db->update('lanzamiento', $data);
			return $this->input->post('nombrecorto');
		}						

		public function delete_lanzamiento($nombrecorto)
		{
			$this->db->delete('lanzamiento', array('nombrecorto' => $nombrecorto));
		}		
}