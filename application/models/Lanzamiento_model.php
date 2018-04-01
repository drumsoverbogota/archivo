<?php
class Lanzamiento_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
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
				'tracklist' => nl2br($this->input->post('tracklist')),
				'creditos' => nl2br($this->input->post('creditos')),
				'notas' => nl2br($this->input->post('notas'))			
			);

			$this->db->insert('lanzamiento', $data);
			return $this->db->insert_id();
		}		
}