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
				$this->load->library('ion_auth');
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
				$data['asignados'] = [];
				$bandalanzamiento = $this->bandalanzamiento_model->get_lanzamiento_bandaid_array($data['banda_id']);
				for($i=0 ; $i < count($bandalanzamiento) ; $i++){
					array_push($data['asignados'] , $bandalanzamiento[$i][0]);
				}
				
				$data['title'] = 'Asigne el disco';		
				
				$this->load->view('templates/header', $data);
				$this->load->view('bandalanzamiento/banda_lanzamientos', $data);
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

		public function asignar_lanzamiento()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			if (empty($this->input->post('lanzamiento_id'))){
				
				$data['lanzamiento'] = $this->lanzamiento_model->get_lanzamiento();
				$data['title'] = 'Escoga el lanzamiento';		
				$this->load->view('templates/header', $data);
				$this->load->view('bandalanzamiento/lanzamiento', $data);
				$this->load->view('templates/footer');	
			}
			else{ 	
				$data['lanzamiento_id'] = $this->input->post('lanzamiento_id');
				$data['banda'] = $this->banda_model->get_banda();
				$data['asignados'] = [];
				$lanzamientobandas = $this->bandalanzamiento_model->get_banda_lanzamientoid_array($data['lanzamiento_id']);	
				$data['title'] = 'Asigne la banda';		

				for($i=0 ; $i < count($lanzamientobandas) ; $i++){
					array_push($data['asignados'] , $lanzamientobandas[$i][0]);
				}				
				
				$this->load->view('templates/header', $data);
				$this->load->view('bandalanzamiento/lanzamiento_bandas', $data);
				$this->load->view('templates/footer');
			}
		}		
		
		public function create_lanzamiento()
		{
			if(!empty($this->input->post('lanzamiento'))){				
				$this->bandalanzamiento_model->set_banda($this->input->post('lanzamiento'));				
			}
			$this->asignar_lanzamiento();
		}				
		
}