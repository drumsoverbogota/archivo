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

			//$slug = url_title($this->input->post('title'), 'dash', TRUE);

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
			);

			$this->db->insert('lanzamiento', $data);
			return $this->db->insert_id();
		}		
		
		public function edit_lanzamiento()
		{
			$this->load->helper('url');

			//$slug = url_title($this->input->post('title'), 'dash', TRUE);

			$data = array(
				//'slug' => $slug,
				'id' => $this->input->post('id'),		
				'nombre' => $this->input->post('nombre'),				
				'referencia' => $this->input->post('referencia'),
				'formato' => $this->input->post('formato'),
				'anho' => $this->input->post('anho'),
				'tracklist' => $this->input->post('tracklist'),
				'creditos' => $this->input->post('creditos'),
				'notas' => $this->input->post('notas'),
				'link' => $this->input->post('link'),
			);

			$this->db->replace('lanzamiento', $data);
			return $this->input->post('id');
		}						

		public function delete_lanzamiento($id)
		{
			$this->db->delete('lanzamiento', array('id' => $id));
		}		
}