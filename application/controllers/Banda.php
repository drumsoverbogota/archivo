<?php
class Banda extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
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
		
        public function upload()		
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
				$data['error'] = '';
				$this->load->view('templates/header', $data);
				$this->load->view('banda/upload_form');
				$this->load->view('templates/footer');		
              
			}
        }		
		
		
		public function do_upload()
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
				$data['title'] = 'Editar un nuevo Lanzamiento';
                $config['upload_path']          = './images/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
				echo 'perro';
                if ( ! $this->upload->do_upload('userfile'))
                {
						
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('banda/upload_form', $error);
						echo 'gonorrea';
                }
                else
                {
						
                        $data = array('upload_data' => $this->upload->data());
                        $this->index();
						echo 'carechimba';
                }
			}		
		}		
		
}