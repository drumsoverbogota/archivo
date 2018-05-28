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

			//$slug = url_title($this->input->post('title'), 'dash', TRUE);

			/*$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),				
				'otros' => nl2br($this->input->post('otros')),				
				'integrantes' => nl2br($this->input->post('integrantes')),
				'comentarios' => nl2br($this->input->post('comentarios'))				
			);*/

			$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),				
				'otros' => $this->input->post('otros'),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios')				
			);

			$this->db->insert('banda', $data);
			return $this->db->insert_id();
		}		
		
		public function edit_banda()
		{
			$this->load->helper('url');

			//$slug = url_title($this->input->post('title'), 'dash', TRUE);

			$data = array(
				//'slug' => $slug,
				'id' => $this->input->post('id'),		
				'nombre' => $this->input->post('nombre'),				
				'otros' => $this->input->post('otros'),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios')				
			);

			$this->db->replace('banda', $data);
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