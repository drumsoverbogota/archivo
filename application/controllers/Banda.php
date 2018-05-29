<?php
class Banda extends CI_Controller {
		
		public function clean($string) {
		   
		   return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
		}		


        public function __construct()
        {
                parent::__construct();
                $this->load->model('bandalanzamiento_model');
                $this->load->model('banda_model');
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->helper(array('form', 'url'));
				$this->load->library('ion_auth');
				
        }

        public function index($extranjera = 'false')
        {
                $data['banda'] = $this->banda_model->get_banda();
				$data['title'] = 'Lista de bandas';
				$data['extranjera'] = 'false';
				if ($extranjera == 'true'){
					$data['extranjera'] = 'true';
				}

				$this->load->view('templates/header', $data);
				$this->load->view('banda/index', $data);
				$this->load->view('templates/footer');				
        }

        public function view($id = NULL)
        {
                $data['banda_item'] = $this->banda_model->get_banda($id);
		        if (empty($data['banda_item']))
				{
						show_404();
				}

				$data['lanzamiento'] = $this->banda_model->get_lanzamientos_bandaid($id);

				$data['title'] = $data['banda_item']['nombre'];

				$this->load->view('templates/header', $data);
				$this->load->view('banda/view', $data);
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

				$data['title'] = 'Crear una nueva banda';

				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('otros', 'Otros nombres', '');
				$this->form_validation->set_rules('integrantes', 'Integrantes', '');
				$this->form_validation->set_rules('comentarios', 'Comentarios', '');
				$this->form_validation->set_rules('extranjera', 'Comentarios', '');

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('banda/create');
					$this->load->view('templates/footer');

				}
				else
				{
					$id = $this->banda_model->set_banda();				
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
		
				$data['banda_item'] = $this->banda_model->get_banda($id);
				
				$this->load->helper('form');
				$this->load->library('form_validation');

				$data['title'] = 'Editar Banda';

				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('otros', 'Otros nombres', '');
				$this->form_validation->set_rules('integrantes', 'Integrantes', '');
				$this->form_validation->set_rules('comentarios', 'Comentarios', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('banda/edit');
					$this->load->view('templates/footer');

				}
				else
				{
					$id = $this->banda_model->edit_banda();				
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
				$this->banda_model->delete_banda($id);
				$this->index();
			}		
		}
		
        public function upload($id)		
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
				$data['title'] = 'Subir imagen de banda';
				$data['id'] = $id;
				$data['error'] = '';
				$this->load->view('templates/header', $data);
				$this->load->view('banda/upload_form');
				$this->load->view('templates/footer');		
              
			}
        }		
		
		
		public function do_upload($id)
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
				if($id != NULL){
					$data['title'] = 'Editar un nuevo Lanzamiento';
				
					$banda = $this->banda_model->get_banda($id);
					
					//Configuraciones de la subida
					$config['upload_path']		= './images/';
					$config['allowed_types']	= 'gif|jpg|png';
					$config['max_size']			= 2048;
					$config['file_name']		= strtolower(preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ', '-', $banda['id'].$banda['nombre'].'image')));
					$config['overwrite'] = TRUE;
					//$config[''] = ; 

					$data['id'] = $id;

					$this->load->library('upload', $config);
				
					if ( ! $this->upload->do_upload('userfile'))
					{						
						$error = array('error' => $this->upload->display_errors());
						$this->load->view('templates/header', $data);
						$this->load->view('banda/upload_form', $error);
						$this->load->view('templates/footer');	
					}
					else
					{						
						$data = array('upload_data' => $this->upload->data());
						$this->banda_model->update_image($id, $data['upload_data']['file_name']);					
						$this->view($id);
					}					
				
				}
			}		
		}		
}