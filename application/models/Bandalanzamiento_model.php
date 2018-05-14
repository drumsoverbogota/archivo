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
		
		public function get_banda_lanzamientoid_array($id)
		{
				$query = $this->db->query("SELECT `banda_id` FROM `banda_lanzamiento` WHERE `lanzamiento_id` = ".$id);
				$banda_lanzamientoid = $query->result();
				
				$result = [];
				
				foreach ($banda_lanzamientoid as $row)
				{
					array_push($result , $row->banda_id);
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
		
		public function set_banda($id)
		{
			$this->load->helper('url');
			$nuevo_ban = [];
			if(!empty($this->input->post('bandas'))){
				$nuevo_ban = $this->input->post('bandas');
			}			
			$viejo_ban = $this->get_banda_lanzamientoid_array($id);
			
			
			$quitar = array_values(array_diff($viejo_ban, $nuevo_ban));
			$agregar = array_values(array_diff($nuevo_ban, $viejo_ban));
			

			for($i=0 ; $i < count($agregar) ; $i++){
				$data = array(
					'banda_id' =>  $agregar[$i],				
					'lanzamiento_id' =>$id,
				);
				$this->db->insert('banda_lanzamiento', $data);
			}			
			
			print_r($agregar);
			print_r($quitar);
			for($i=0 ; $i < count($quitar) ; $i++){
				$data = array(
					'banda_id' =>  $quitar[$i],				
					'lanzamiento_id' =>$id,
				);				
				$this->db->delete('banda_lanzamiento', $data);
			}			
			
		}		
}