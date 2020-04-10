<?php

/**
 * @package Paginas :  Correo
 *
 * @author El Muladar
 *
 * @email  sergiomanceranom@hotmail.com
 *   
 * Description of Contact Controller
 */



class Paginas extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->library('ion_auth');
                $this->load->library('email');
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->helper(array('form', 'url'));
				$this->load->model('banda_model');
				$this->load->model('lanzamiento_model');
				$this->load->model('publicacion_model');
				$this->load->model('entrada_model');
				$this->load->config('variables');
        }

        public function index()
        {
				$this->view();
        }		


        public function view($page = 'home')
        {

				if ( ! file_exists(APPPATH.'views/paginas/'.$page.'.php'))
				{
						// Whoops, we don't have a page for that!		
						show_404();
				}

				$data['title'] = ucfirst($page);
				if ($page == 'home') {
					$data['noticias'] = $this->entrada_model->get_noticias(10, 1);
				}
				if ($page == 'blog') {
					$data['blog'] = $this->entrada_model->get_blogs(10, 1);
					$data['descripcion']	= 'Acá se pueden ver todos las entradas del blog.';
				}		
				if ($page == 'lista') {
					$data['lanzamiento']	= $this->lanzamiento_model->get_all_lanzamientos('indice_referencia', 'ASC');
					$data['publicacion']	= $this->publicacion_model->get_publicacion(FALSE, 'true', 'true');
					$data['descripcion']	= 'Lista total del archivo';
				}	
				if ($page == 'contact') {
					$data['public_key'] = $this->config->item('public_key');
				}
					
				$this->load->view('templates/header', $data);
				$this->load->view('paginas/'.$page, $data);				
				$this->load->view('templates/footer', $data);
		}
		
		
        public function admin()
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

				$data['title'] = 'admin';

				$this->load->view('templates/header', $data);
				$this->load->view('paginas/admin', $data);
				$this->load->view('templates/footer', $data);
		}		

		public function buscar()
		{
				$peticion = $this->input->get('peticion');				
				$data['title'] = 'Busqueda';
				$data['descripcion'] = 'Acá se puede hacer las busquedas en el Blog.';
		        if ($peticion == "")
		        {
		        	$data['peticion'] = "";
		        }
		        else{
		        	$data['peticion'] = $peticion;
		        	$data['banda'] = $this->banda_model->search_banda($peticion);
		        	$data['lanzamiento'] = $this->lanzamiento_model->search_lanzamiento($peticion);
		        	$data['publicacion'] = $this->publicacion_model->search_publicacion($peticion);
		        }


		        
				$this->load->view('templates/header', $data);
				$this->load->view('paginas/buscar', $data);
				$this->load->view('templates/footer', $data);			        

		}

		public function send()
		{

	        $this->load->library('form_validation');
	        // field name, error message, validation rules
	        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');     
	        $this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email');
	        $this->form_validation->set_rules('comment', 'Comentario', 'trim|required');

	        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	        $recaptcha_response = $this->input->post('recaptcha_response');
	        $recaptcha_secret = $this->config->item('secret_key');
	        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	        $recaptcha = json_decode($recaptcha);
	                   
	        if($this->form_validation->run() == FALSE and $recaptcha->success <= 0.5) {
	          	$this->index();
	        } else {        

	            $name = $this->input->post('name');
	            $email = $this->input->post('email');
	            $comment = $this->input->post('comment');


				$TO_MAIL = $this->config->item('to_mail');
				$FROM_TEXT = "El Muladar";
	            $USER = $this->config->item('user');
	            $PASS = $this->config->item('pass');
	            $PROTOCOL = $this->config->item('protocol');
	            $HOST = $this->config->item('host');
	            $PORT = $this->config->item('port');



	            if(!empty($email)) {
	                // send mail
	                $config = array (
						'mailtype' => 'html',
						'charset'  => 'utf-8',
						'priority' => '1',

						'protocol' => $PROTOCOL,
						'smtp_host' => $HOST,
						'smtp_port' => $PORT,
						'smtp_user' => $USER,
						'smtp_pass' => $PASS,
	                );
	                $message='';
	                $bodyMsg = $comment;   
	                $delimeter = $name."<br>";
	                $dataMail = array('topMsg'=>'Hola, hay un nuevo mensaje de '.$name, 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'¡Gracias!,', 'delimeter'=> $delimeter);
	 
	                $this->email->initialize($config);
	                $this->email->set_newline("\r\n");
	                $this->email->from($email, $name);
	                $this->email->to($TO_MAIL);
	                $this->email->subject('Nuevo mensaje de '.$name);
	                $message = $this->load->view('paginas/contactForm', $dataMail, TRUE);
	                $this->email->message($message);
	                $this->email->send();
	                
	                // confirm mail
	                $bodyMsg = 'Esto es una respuesta automática, cuando podamos responderemos el mensaje (si es necesario).';                 
	                $dataMail = array('topMsg'=>'Hola '.$name, 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'¡Gracias por escribir!,', 'delimeter'=> 'El Muladar');
	 
	                $this->email->initialize($config);
	                $this->email->from($TO_MAIL, $FROM_TEXT);
	                $this->email->to($email);
	                $this->email->subject('Respuesta automática de confirmación del El Muladar');
	                $message = $this->load->view('paginas/contactForm', $dataMail, TRUE);
	                $this->email->message($message);
	                $this->email->send();                
	            }
	            
	            redirect('paginas/contact');
	        }
		}
}
