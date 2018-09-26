<?php
class Entrada_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_entrada($id = FALSE)
		{
				$query = $this->db->get_where('entrada', array('id' => $id));
				return $query->row_array();
		}

		public function get_noticias($limit = 10, $page = 1)
		{
				$this->db->order_by('fecha', 'DESC');
				$this->db->limit($limit, ($page-1)*$limit);
				$query = $this->db->get_where('entrada', array('tipo' => 'noticia'));
				//echo $this->db->last_query();
				return $query->result_array();
		}

		public function set_entrada()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');
	
			$data = array(
				'titulo' => $this->input->post('titulo'),					
				'contenido' => $this->input->post('contenido'),				
				'resumen' => $this->input->post('resumen'),
				'tipo' => $this->input->post('tipo'),				
				'fecha' => date('Y-m-d H:i:s')
			);

			$this->db->insert('entrada', $data);
			return $this->db->insert_id();
		}		
		
		public function edit_entrada()
		{
			$this->load->helper('url');
			date_default_timezone_set('America/Bogota');

			$id = $this->input->post('id');	
			$data = array(
				'titulo' => $this->input->post('titulo'),					
				'contenido' => $this->input->post('contenido'),				
				'resumen' => $this->input->post('resumen'),
				'tipo' => $this->input->post('tipo'),				
				'fecha' => date('Y-m-d H:i:s')
			);
			$this->db->where('id', $id);
			$this->db->update('entrada', $entrada);
			return $this->input->post('id');
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