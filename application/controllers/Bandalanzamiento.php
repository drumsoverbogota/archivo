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


		public function asignar_banda()
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
				$data['asignados'] = $this->bandalanzamiento_model->get_lanzamiento_bandaid_array($data['banda_id']);	
				$data['title'] = 'Asigne el disco';		
				
				$this->load->view('templates/header', $data);
				$this->load->view('bandalanzamiento/lanzamientos', $data);
				$this->load->view('templates/footer');
			}
		}		
		public function create_banda()
		{
			if(!empty($this->input->post('banda'))){				
				$this->bandalanzamiento_model->set_lanzamiento($this->input->post('banda'));				
			}
			$this->asignar_banda();
		}			
}