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

        public function index()
        {
                $data['banda'] = $this->banda_model->get_banda();
				$data['title'] = 'Lista de bandas';

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

				$data['title'] = 'Crear un nuevo Lanzamiento';

				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('otros', 'Otros nombres', '');
				$this->form_validation->set_rules('integrantes', 'Integrantes', '');
				$this->form_validation->set_rules('comentarios', 'Comentarios', '');
				

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

				$data['title'] = 'Editar un nuevo Lanzamiento';

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
					
					
					$config['upload_path']		= './images/';
					$config['allowed_types']	= 'gif|jpg|png';
					$config['max_size']			= 1024;
					$config['file_name']			= strtolower(preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ', '-', $banda['id'].$banda['nombre'].'image')));
					

					$this->load->library('upload', $config);
				
					if ( ! $this->upload->do_upload('userfile'))
					{						
						$error = array('error' => $this->upload->display_errors());
						$this->load->view('banda/upload_form', $error);
					}
					else
					{						
						$data = array('upload_data' => $this->upload->data());
						echo print_r($data['upload_data']['file_name']);
						
						
						
						$this->view($id);
					}					
				
				}
			}		
		}		
}