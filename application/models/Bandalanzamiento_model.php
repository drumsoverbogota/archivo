<?php
class Bandalanzamiento_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		public function get_lanzamiento_bandaid_array($id)
		{
				$query = $this->db->query("SELECT `lanzamiento_id` FROM `banda_lanzamiento` WHERE `banda_id` = ".$id);
				$lanzamiento_bandaid = $query->result();
				
				$result = [];
				
				foreach ($lanzamiento_bandaid as $row)
				{
					array_push($result , $row->lanzamiento_id);
				}				
				return $result;
		}				
		
		public function get_lanzamiento_bandaid($id)
		{
				$query = $this->db->query("SELECT `lanzamiento_id` FROM `banda_lanzamiento` WHERE `banda_id` = ".$id);
				return $query->result();
		}		
		
		public function set_lanzamiento($id)
		{
			$this->load->helper('url');
			$nuevo_lan = [];
			if(!empty($this->input->post('lanzamientos'))){
				$nuevo_lan = $this->input->post('lanzamientos');
			}			
			$viejo_lan = $this->get_lanzamiento_bandaid_array($id);
			
			
			$quitar = array_values(array_diff($viejo_lan, $nuevo_lan));
			$agregar = array_values(array_diff($nuevo_lan, $viejo_lan));
			
			/*
			echo 'Viejo';
			print_r($viejo_lan);
			echo '<br>Nuevo';
			print_r($nuevo_lan);
			echo '<br>quitar';
			print_r($quitar);
			echo '<br>agregar';
			print_r($agregar);
			*/	
			
			for($i=0 ; $i < count($agregar) ; $i++){
				$data = array(
					'banda_id' => $id,				
					'lanzamiento_id' => $agregar[$i],
				);
				$this->db->insert('banda_lanzamiento', $data);
			}			
			
			for($i=0 ; $i < count($quitar) ; $i++){
				$data = array(
					'banda_id' => $id,				
					'lanzamiento_id' => $quitar[$i],
				);				
				$this->db->delete('banda_lanzamiento', $data);
			}			
			
		}		
}