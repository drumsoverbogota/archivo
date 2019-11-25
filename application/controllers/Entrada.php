<?php
class Entrada extends CI_Controller {
		
        public function __construct()
        {
                parent::__construct();                          
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->helper(array('form', 'url'));
				$this->load->library('ion_auth');
				$this->load->model('entrada_model');
				
        }

        public function view($id = NULL)
        {
                $data['entrada_item'] = $this->entrada_model->get_entrada($id);
		        if (empty($data['entrada_item']))
				{
						show_404();
				}

				$data['title'] = $data['entrada_item']['titulo'];
				$data['descripcion'] = $data['entrada_item']['resumen'];

				$this->load->view('templates/header', $data);
				$this->load->view('entrada/view', $data);
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

				$data['title'] = 'Crear una nueva entrada';

				$this->form_validation->set_rules('titulo', 'Titulo', 'required');
				$this->form_validation->set_rules('resumen', 'Resumen', '');
				$this->form_validation->set_rules('contenido', 'Contenido', '');
				$this->form_validation->set_rules('tipo', 'Tipo', '');

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('entrada/create');
					$this->load->view('templates/footer');

				}
				else
				{
					$id = $this->entrada_model->set_entrada();				
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
		
				$data['entrada_item'] = $this->entrada_model->get_entrada($id);
				
				
				$this->load->helper('form');
				$this->load->library('form_validation');

				$data['title'] = 'Editar Entrada';

				$this->form_validation->set_rules('titulo', 'Titulo', 'required');
				$this->form_validation->set_rules('resumen', 'Resumen', '');
				$this->form_validation->set_rules('contenido', 'Contenido', '');
				$this->form_validation->set_rules('tipo', 'Tipo', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('entrada/edit');
					$this->load->view('templates/footer');

				}
				else
				{
					$id = $this->entrada_model->edit_entrada();				
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

				$this->entrada_model->delete_entrada($id);

				redirect('paginas');
			}		
		}
}