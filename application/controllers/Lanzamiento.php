<?php
class Lanzamiento extends CI_Controller {

		public function clean($string) {
		   
		   return preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.
		}		


        public function __construct()
        {
                parent::__construct();
                $this->load->model('lanzamiento_model');
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->helper(array('form', 'url'));
				$this->load->library('ion_auth');
        }

        public function index($visible = 'false')
        {			
        		
        		
        		$limite = $this->input->get('numero');
        		if(!$limite){
        			$limite = 10;
        		}

        		$pagina = $this->input->get('pagina');
        		if(!$pagina){
        			$pagina = 1;
        		}

        		$ordenar = $this->input->get('ordenar');
        		if(!$ordenar){
        			$ordenar = 'nombre';
        		}

        		$visible = $this->input->get('visible');
        		if(!$visible){
        			$visible = 'false';
        		}
        		$asc = '';
        		$ascendente = $this->input->get('ascendente');
        		if(!$ascendente){
        			$asc = 'ASC';
        		}else{
        			if ($ascendente == 'ascendente') {
        				$asc = 'ASC';
        			}
        			else{
        				$asc = 'DESC';	
        			}
        		}

                $data['lanzamiento']	= $this->lanzamiento_model->get_lanzamientos($limite, $pagina, $visible, $ordenar, $asc);

				$data['total']			= count($this->lanzamiento_model->get_lanzamiento(FALSE, $visible)); 
				$data['title'] 			= 'Lista de lanzamientos';
				$data['limite']			= $limite;
				$data['pagina']			= $pagina;
				$data['visible']		= $visible;
				$data['ordenar']		= $ordenar;
				$data['ascendente']		= $ascendente;
				
				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/index', $data);
				$this->load->view('templates/footer');

        }

        public function view($nombrecorto = NULL)
        {
                $data['lanzamiento_item'] = $this->lanzamiento_model->get_lanzamiento($nombrecorto);
		        if (empty($data['lanzamiento_item']))
				{
						show_404();
				}

				$data['title'] = $data['lanzamiento_item']['nombre'];
				$data['banda'] = $this->lanzamiento_model->get_bandas_lanzamientoid($nombrecorto);
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
				$this->form_validation->set_rules('visible', 'Visible', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('lanzamiento/create');
					$this->load->view('templates/footer');

				}
				else
				{
					$row = $this->lanzamiento_model->set_lanzamiento();	

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
		
				$data['lanzamiento_item'] = $this->lanzamiento_model->get_lanzamiento($nombrecorto);
				
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
				$this->form_validation->set_rules('visible', 'Visible', '');
				

				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('lanzamiento/edit');
					$this->load->view('templates/footer');

				}
				else
				{
					
					$nombrecorto = $this->lanzamiento_model->edit_lanzamiento();				
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
				$this->lanzamiento_model->delete_lanzamiento($nombrecorto);
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
				$data['title'] = 'Subir imagen de lanzamiento';
				$data['nombrecorto'] = $nombrecorto;
				$data['error'] = '';
				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/upload_form');
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
					$data['title'] = 'Editar una nuevo lanzamiento';
				
					$lanzamiento = $this->lanzamiento_model->get_lanzamiento($nombrecorto);
					$file_name = strtolower(preg_replace('/[^A-Za-z0-9]/', '',str_replace(' ', '-', $lanzamiento['id'].$lanzamiento['nombre'].'image')));
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
						$this->load->view('lanzamiento/upload_form', $error);
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
							$this->load->view('lanzamiento/upload_form', $error);
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
							$this->load->view('lanzamiento/upload_form', $error);
							$this->load->view('templates/footer');	
                    	}
						$this->image_lib->clear();

						$this->lanzamiento_model->update_image($nombrecorto, $data['upload_data']['file_name']);			
						$this->view($nombrecorto);
					}					
				
				}
			}		
		}				
}