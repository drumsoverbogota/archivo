<?php
class Bandalanzamiento extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('lanzamiento_model');
				$this->load->model('banda_model');
				$this->load->model('bandalanzamiento_model');
                $this->load->helper('url_helper');
				$this->load->helper('url');
        }


		public function asignar()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			if (empty($this->input->post('banda_id'))){
				
				$data['banda'] = $this->banda_model->get_banda();
				$data['title'] = 'Escoga la banda';		
				$this->load->view('templates/header', $data);
				$this->load->view('bandalanzamiento/banda', $data);
				$this->load->view('templates/footer');	
			}
			else{ 	
				$data['banda_id'] = $this->input->post('banda_id');
				$data['lanzamiento'] = $this->lanzamiento_model->get_lanzamiento();
				
				
				$lanzamiento_bandaid = $this->bandalanzamiento_model->get_lanzamiento_bandaid($data['banda_id']);
				
				$data['asignados'] = [];
				
				
				foreach ($lanzamiento_bandaid as $row)
				{
					array_push($data['asignados'] , $row->lanzamiento_id);
				}
				
				

											
				
				$data['title'] = 'Asigne el disco';		
				$this->load->view('templates/header', $data);
				$this->load->view('bandalanzamiento/lanzamientos', $data);
				$this->load->view('templates/footer');
			}
		}		
		public function create()
		{
			if(!empty($this->input->post('banda')) and !empty($this->input->post('lanzamientos'))){				
				$this->bandalanzamiento_model->set_lanzamiento();	
				
			}
			$this->asignar();
		}			
}