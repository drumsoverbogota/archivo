<?php
class Bandalanzamiento_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		
		public function get_lanzamiento_bandaid($id)
		{
				$query = $this->db->query("SELECT `lanzamiento_id` FROM `banda_lanzamiento` WHERE `banda_id` = ".$id);
				return $query->result();
		}		
		
		public function set_lanzamiento()
		{
			$this->load->helper('url');
			$lanzamientos = $this->input->post('lanzamientos');
			
			for($i=0 ; $i < count($lanzamientos) ; $i++){
				$data = array(
					'banda_id' => $this->input->post('banda'),				
					'lanzamiento_id' => $lanzamientos[$i],
				);

				$this->db->insert('banda_lanzamiento', $data);
			}			

			
		}		
}