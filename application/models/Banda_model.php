<?php
class Banda_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		public function get_banda($id = FALSE)
		{
				if ($id === FALSE)
				{
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

			$data = array(
				//'slug' => $slug,
				'nombre' => $this->input->post('nombre'),				
				'otros' => nl2br($this->input->post('otros')),				
				'integrantes' => $this->input->post('integrantes'),
				'comentarios' => $this->input->post('comentarios')				
			);

			$this->db->insert('banda', $data);
			return $this->db->insert_id();
		}		
}