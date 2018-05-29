<?php
class Banda_model extends CI_Model {

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
				$this->db->update('banda', $data);
        	}
        }

		public function get_banda($id = FALSE)
		{
				if ($id === FALSE)
				{
						$this->db->order_by('nombre', 'ASC');
						$query = $this->db->get('banda');
						return $query->result_array();
				}

				$query = $this->db->get_where('banda', array('id' => $id));
				return $query->row_array();
		}
		public function set_banda()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');
			//$slug = url_title($this->input->post('title'), 'dash', TRUE);

			/*$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),				
				'otros' => nl2br($this->input->post('otros')),				
				'integrantes' => nl2br($this->input->post('integrantes')),
				'comentarios' => nl2br($this->input->post('comentarios'))				
			);*/

			$extranjera = 0;
			if ($this->input->post('extranjera') == 'on'){
				$extranjera = 1;
			}
			
			$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),				
				'otros' => $this->input->post('otros'),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios'),
				'extranjera' => $extranjera,
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);

			$this->db->insert('banda', $data);
			return $this->db->insert_id();
		}		
		
		public function edit_banda()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');

			$extranjera = 0;
			if ($this->input->post('extranjera') == 'on'){
				$extranjera = 1;
			}			
			$id = $this->input->post('id');	
			$data = array(
				'nombre' => $this->input->post('nombre'),				
				'otros' => $this->input->post('otros'),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios'),
				'extranjera' => $extranjera,
				'fecha_modificacion' => date('Y-m-d H:i:s')
			);
			$this->db->where('id', $id);
			$this->db->update('banda', $data);
			return $this->input->post('id');
		}				
		
		public function delete_banda($id)
		{
			$this->db->delete('banda', array('id' => $id));
		}
		
		public function set_image($id, $link){
			$data = $this->db->get_where('banda', array('id' => $id))->row_array();
			$data['imagen'] = $link;
			$this->db->replace('table', $data);
		}			
}