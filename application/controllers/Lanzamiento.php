<?php
class Lanzamiento extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('lanzamiento_model');
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->library('ion_auth');
        }

        public function index()
        {			
                $data['lanzamiento'] = $this->lanzamiento_model->get_lanzamiento();
				$data['title'] = 'Lista de lanzamientos';
				

    			
				
				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/index', $data);
				$this->load->view('templates/footer');

        }

        public function view($id = NULL)
        {
                $data['lanzamiento_item'] = $this->lanzamiento_model->get_lanzamiento($id);
		        if (empty($data['lanzamiento_item']))
				{
						show_404();
				}

				$data['title'] = $data['lanzamiento_item']['nombre'];

				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/view', $data);
				$this->load->view('templates/footer');
        }
		
		public function create()
		{
			if (!$this->ion_auth->logged_in())
			{
				// redirect them to the login page
				redirect('auth/login', 'refresh');
			}
			else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
			{
				// redirect them to the home page because they must be an administrator to view this
				return show_error('You must be an administrator to view this page.');
			}
			else
			{						
				$this->load->helper('form');
				$this->load->library('form_validation');

				$data['title'] = 'Crear un nuevo Lanzamiento';
				$data['formatos'] = $this->lanzamiento_model->get_formatos();



				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('referencia', 'Referencia', '');
				$this->form_validation->set_rules('formato', 'Formato', '');
				$this->form_validation->set_rules('anho', 'Año', '');
				$this->form_validation->set_rules('tracklist', 'Tracklist', '');
				$this->form_validation->set_rules('creditos', 'Creditos', '');
				$this->form_validation->set_rules('notas', 'Notas', '');
				$this->form_validation->set_rules('link', 'Link', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('lanzamiento/create');
					$this->load->view('templates/footer');

				}
				else
				{
					$id = $this->lanzamiento_model->set_lanzamiento();
					//$this->load->view('lanzamiento/' + $id);
					
					
					$this->view($id);
					
				}
			}
		}
		
		public function edit($id)
		{
			if (!$this->ion_auth->logged_in())
			{
				// redirect them to the login page
				redirect('auth/login', 'refresh');
			}
			else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
			{
				// redirect them to the home page because they must be an administrator to view this
				return show_error('You must be an administrator to view this page.');
			}
			else
			{			
		
				$data['lanzamiento_item'] = $this->lanzamiento_model->get_lanzamiento($id);
				
				$this->load->helper('form');
				$this->load->library('form_validation');

				$data['title'] = 'Editar un nuevo Lanzamiento';
				$data['formatos'] = $this->lanzamiento_model->get_formatos();
				
				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('referencia', 'Referencia', '');
				$this->form_validation->set_rules('formato', 'Formato', '');
				$this->form_validation->set_rules('anho', 'Año', '');
				$this->form_validation->set_rules('tracklist', 'Tracklist', '');
				$this->form_validation->set_rules('creditos', 'Creditos', '');
				$this->form_validation->set_rules('notas', 'Notas', '');
				$this->form_validation->set_rules('link', 'Link', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('lanzamiento/edit');
					$this->load->view('templates/footer');

				}
				else
				{
					$id = $this->lanzamiento_model->edit_lanzamiento();				
					$this->view($id);
					
				}
			}
		}

		public function delete($id)
		{
			if (!$this->ion_auth->logged_in())
			{
				// redirect them to the login page
				redirect('auth/login', 'refresh');
			}
			else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
			{
				// redirect them to the home page because they must be an administrator to view this
				return show_error('You must be an administrator to view this page.');
			}
			else
			{
				$this->lanzamiento_model->delete_lanzamiento($id);
				$this->index();
			}		
		}		
		
}