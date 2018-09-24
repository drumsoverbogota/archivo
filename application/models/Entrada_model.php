<?php
class Entrada_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_entrada($nombrecorto = FALSE)
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
	
			$data = array(
				//'slug' => $slug,
				'titulo' => $this->input->post('titulo'),					
				'contenido' => $this->input->post('contenido'),				
				'resumen' => $this->input->post('resumen'),
				'tipo' => $this->input->post('tipo'),				
				'fecha' => date('Y-m-d H:i:s')
			);

			$this->db->insert('entrada', $data);
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