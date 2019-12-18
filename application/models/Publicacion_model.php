<?php
class Publicacion_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


        public function search_publicacion($match = '')
        {
        	$this->db->where('visible', 1); 
        	$this->db->group_start();
        	$this->db->or_like('nombre', $match); 
        	$this->db->or_like('fecha', $match);
        	$this->db->or_like('notas', $match); 
        	$this->db->or_like('indice_referencia', $match);
        	
        	$this->db->group_end();
        	$query = $this->db->get('publicacion');
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
				$this->db->update('publicacion', $data);
        	}
        }


		public function get_publicacion($nombrecorto = FALSE, $visible = 'false', $lista = 'false')
		{
				if ($nombrecorto === FALSE)
				{	
					if ($lista === 'false') {
						$this->db->order_by('nombre', 'ASC');
						$this->db->order_by('numero', 'ASC');
					}
					else{
						$this->db->order_by('indice_referencia', 'ASC');
					}
					if($visible == 'false'){
						$query = $this->db->get_where('publicacion', array('visible' => 1));
					}
					else{
						$query = $this->db->get('publicacion');
					}
					return $query->result_array();					
				}
				$query = $this->db->get_where('publicacion', array('nombrecorto' => $nombrecorto));
				return $query->row_array();						
				
				
		}
		public function set_publicacion()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');
			
			$visible = 0;
			if ($this->input->post('visible') == 'on'){
				$visible = 1;
			}			
		
			$nombre = $this->input->post('nombre');
			$numero = $this->input->post('numero');
			$corto = strtolower(preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ', '-', $nombre)));	
			$corto = $corto.$numero;

			$data = array(
				'nombre' => $this->input->post('nombre'),
				'nombrecorto' => $corto,
				'fecha' => $this->input->post('fecha'),
				'numero' => $this->input->post('numero'),
				'notas' => $this->input->post('notas'),
				'link' => $this->input->post('link'),
				'indice_referencia' => $this->input->post('indice_referencia'),
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha_modificacion' => date('Y-m-d H:i:s'),
				'visible' => $visible,
			);

			$this->db->insert('publicacion', $data);
			$id = $this->db->insert_id();
			$query = $this->db->get_where('publicacion', array('id' => $id));
			return $query->row()->nombrecorto;

		}		
		
		public function edit_publicacion()
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
				'fecha' => $this->input->post('fecha'),
				'numero' => $this->input->post('numero'),
				'notas' => $this->input->post('notas'),
				'link' => $this->input->post('link'),
				'indice_referencia' => $this->input->post('indice_referencia'),
				'fecha_modificacion' => date('Y-m-d H:i:s'),
				'visible' => $visible,				
			);

			$this->db->where('nombrecorto', $nombrecorto);
			$this->db->update('publicacion', $data);
			return $this->input->post('nombrecorto');
		}						

		public function delete_publicacion($nombrecorto)
		{
			$this->db->delete('publicacion', array('nombrecorto' => $nombrecorto));
		}		
}