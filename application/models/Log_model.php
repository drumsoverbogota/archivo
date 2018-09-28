<?php
class Log_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function set_log_visitas($url, $http_referer = 'NA')
		{

			$this->db->where('url',$url);	
			$query = $this->db->get('log_conteo_visitas');
			$row = $query->first_row();
			if ( $row ) 
			{
				$data = array(
					
					'conteo' => $row->conteo+1
				);
				$this->db->where('url', $url);
				$this->db->update('log_conteo_visitas',$data);
			} else {

				$data = array(
					'url' => $url
				);
				$this->db->insert('log_conteo_visitas',$data);
			}

			$data = array(
				'url' => $url,
				'http_referer' => $http_referer
			);
			$this->db->insert('log_visitas',$data);

			return;
		}		

		public function test(){
			echo "sirve";
		}

}