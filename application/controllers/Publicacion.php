<?php
class Publicacion extends CI_Controller {

		public function clean($string) {
		   
		   return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
		}		


        public function __construct()
        {
                parent::__construct();
                $this->load->model('publicacion_model');
                $this->load->model('log_model');
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->helper(array('form', 'url'));
				$this->load->library('ion_auth');
        }

        public function index($visible = 'false')
        {			

                $data['publicacion']	= $this->publicacion_model->get_publicacion(FALSE, $visible);
				$data['total']			= count($this->publicacion_model->get_publicacion(FALSE, $visible)); 
				$data['title'] 			= 'Lista de Fanzines y otras publicaciones';
				$data['descripcion']	= 'Acá se pueden ver todos las publicaciones que están en el archivo.';
				
				$this->load->view('templates/header', $data);
				$this->load->view('publicacion/index', $data);
				$this->load->view('templates/footer');

        }

        public function view($nombrecorto = NULL)
        {
                $data['publicacion_item'] = $this->publicacion_model->get_publicacion($nombrecorto);
		        if (empty($data['publicacion_item']))
				{
						show_404();
				}
				$data['title'] = $data['publicacion_item']['nombre'];
				$data['imagen'] = $data['publicacion_item']['imagen'];
				$data['descripcion'] = $data['publicacion_item']['notas'];				
				$this->load->view('templates/header', $data);
				$this->load->view('publicacion/view', $data);
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

				$data['title'] = 'Crear una nueva Publicacion';

				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('fecha', 'Fecha', '');
				$this->form_validation->set_rules('numero', 'Numero', '');
				$this->form_validation->set_rules('notas', 'Notas', '');
				$this->form_validation->set_rules('link', 'Link', '');
				$this->form_validation->set_rules('visible', 'Visible', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('publicacion/create');
					$this->load->view('templates/footer');

				}
				else
				{
					$row = $this->publicacion_model->set_publicacion();	

					$this->view($row);					
				}
			}
		}
		
		public function edit($nombrecorto)
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
		
				$data['publicacion_item'] = $this->publicacion_model->get_publicacion($nombrecorto);
				
				$this->load->helper('form');
				$this->load->library('form_validation');

				$data['title'] = 'Editar una publicacion';
				
				$this->form_validation->set_rules('nombre', 'Nombre', 'required');
				$this->form_validation->set_rules('fecha', 'Fecha', '');
				$this->form_validation->set_rules('numero', 'Numero', '');
				$this->form_validation->set_rules('notas', 'Notas', '');
				$this->form_validation->set_rules('link', 'Link', '');
				$this->form_validation->set_rules('visible', 'Visible', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('publicacion/edit');
					$this->load->view('templates/footer');

				}
				else
				{
					
					$nombrecorto = $this->publicacion_model->edit_publicacion();				
					$this->view($nombrecorto);
					
				}
			}
		}

		public function delete($nombrecorto)
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
				$this->publicacion_model->delete_publicacion($nombrecorto);
				$this->index();
			}		
		}		

		
        public function upload($nombrecorto)		
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
				$data['title'] = 'Subir imagen de publicacion';
				$data['nombrecorto'] = $nombrecorto;
				$data['error'] = '';
				$this->load->view('templates/header', $data);
				$this->load->view('publicacion/upload_form');
				$this->load->view('templates/footer');		
              
			}
        }				
		

		
		public function do_upload($nombrecorto)
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
				if($nombrecorto != NULL){
					$data['title'] = 'Editar una publicación';
				
					$publicacion = $this->publicacion_model->get_publicacion($nombrecorto);
					$file_name = strtolower(preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ', '-', $publicacion['id'].$publicacion['nombre'].$publicacion['numero'].'image')));
					//Configuraciones de la subida
					$config['upload_path']		= './images/';
					$config['allowed_types']	= 'gif|jpg|png';
					$config['width']			= 400;
					$config['mantain_ration']	= TRUE;
					$config['file_name']		= $file_name;
					$config['overwrite'] = TRUE;
					//$config[''] = ; 

					$data['nombrecorto'] = $nombrecorto;

					$this->load->library('upload', $config);
				
					if ( ! $this->upload->do_upload('userfile'))
					{						
						$error = array('error' => $this->upload->display_errors());
						$this->load->view('templates/header', $data);
						$this->load->view('publicacion/upload_form', $error);
						$this->load->view('templates/footer');	
					}
					else
					{						
						$data = array('upload_data' => $this->upload->data());



						$image_data = $this->upload->data();

						preg_match('/(.*)\.(.*)/',$image_data['full_path'], $match);
						$path = $match[1];
						$extension = $match[2];
						
						#crear thumbnail
						
	                    $config['image_library'] = 'gd2';
	                    $config['source_image'] = $image_data['full_path']; //get original image
	                    $config['new_image'] = $path.'_small.'.$extension;
	                    $config['maintain_ratio'] = TRUE;
	                    $config['width'] = 200;
	                    $this->load->library('image_lib', $config);
	                    if (!$this->image_lib->resize()) {
							$error = array('error' => $this->upload->display_errors());
							$this->load->view('templates/header', $data);
							$this->load->view('publicacion/upload_form', $error);
							$this->load->view('templates/footer');	
                    	}

                    	$this->image_lib->clear();
						
						#achicar imagen
	                    $config_a['image_library'] = 'gd2';
	                    $config_a['source_image'] = $image_data['full_path']; //get original image
	                    $config_a['maintain_ratio'] = TRUE;
	                    $config_a['width'] = 800;
	                    $this->image_lib->initialize($config_a);
	                    if (!$this->image_lib->resize()) {
							$error = array('error' => $this->upload->display_errors());
							$this->load->view('templates/header', $data);
							$this->load->view('publicacion/upload_form', $error);
							$this->load->view('templates/footer');	
                    	}
						$this->image_lib->clear();

						$this->publicacion_model->update_image($nombrecorto, $data['upload_data']['file_name']);			
						$this->view($nombrecorto);
					}					
				
				}
			}		
		}

		public function link($link)
		{	
			$http_referer = 'NA';
			if (array_key_exists('HTTP_REFERER',$_SERVER)) {
				$http_referer = $_SERVER['HTTP_REFERER'];
			}          
			$url = prep_url(base64_decode($link));
			$this->log_model->set_log_visitas($url, $http_referer);
			redirect($url);
		}				
}