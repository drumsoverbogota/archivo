<?php
class Banda_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function search_banda($match = '')
        {
        	$this->db->group_start();
        	$this->db->or_like('nombre', $match); 
        	$this->db->or_like('otros', $match); 
        	$this->db->or_like('integrantes', $match); 
        	$this->db->or_like('comentarios', $match); 
        	$this->db->group_end();
        	$query = $this->db->get('banda');
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
				$this->db->update('banda', $data);
        	}
        }

        public function get_lanzamientos_bandaid($nombrecorto)
        {        	
        	$query = $this->db->query("SELECT `lanzamiento`.`id`, `lanzamiento`.`nombre`, `lanzamiento`.`nombrecorto` ,`lanzamiento`.`anho`
        		, `lanzamiento`.`disponible`
				FROM `lanzamiento`
				INNER JOIN `banda_lanzamiento` ON `lanzamiento`.`id` = `banda_lanzamiento`.`lanzamiento_id` 
				INNER JOIN `banda` ON `banda_lanzamiento`.`banda_id` = `banda`.`id`
				WHERE `banda`.`nombrecorto` =".$this->db->escape($nombrecorto)." ORDER BY `lanzamiento`.`anho`");
        	return $query->result_array();
        }

		public function get_banda($nombrecorto = FALSE)
		{
				if ($nombrecorto === FALSE)
				{
						$this->db->order_by('nombre', 'ASC');
						$query = $this->db->get('banda');
						return $query->result_array();
				}

				$query = $this->db->get_where('banda', array('nombrecorto' => $nombrecorto));
				return $query->row_array();
		}
		public function set_banda()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');

			$extranjera = 0;
			if ($this->input->post('extranjera') == 'on'){
				$extranjera = 1;
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
				$query = $this->db->get_where('banda', array('nombrecorto' => $corto));

			} while ($query->row_array());

			$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),	
				'nombrecorto' => $corto,			
				'otros' => $this->input->post('otros'),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios'),
				'extranjera' => $extranjera,
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$this->db->insert('banda', $data);
			$id = $this->db->insert_id();
			$query = $this->db->get_where('banda', array('id' => $id));
			return $query->row()->nombrecorto;
		}		
		
		public function edit_banda()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');

			$extranjera = 0;
			if ($this->input->post('extranjera') == 'on'){
				$extranjera = 1;
			}			
			$nombrecorto = $this->input->post('nombrecorto');	
			$data = array(
				'nombre' => $this->input->post('nombre'),				
				'otros' => $this->input->post('otros'),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios'),
				'extranjera' => $extranjera,
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);
			$this->db->where('nombrecorto', $nombrecorto);
			$this->db->update('banda', $data);
			return $this->input->post('nombrecorto');
		}				
		
		public function delete_banda($nombrecorto)
		{
			$this->db->delete('banda', array('nombrecorto' => $nombrecorto));
		}
		
		public function set_image($id, $link){
			$data = $this->db->get_where('banda', array('id' => $id))->row_array();
			$data['imagen'] = $link;
			$this->db->replace('table', $data);
		}			
}