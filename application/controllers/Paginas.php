<?php
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

				$data['title'] = ucfirst($page); // Capitalize the first letter

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
		        if ($peticion == "")
		        {
		        	$data['peticion'] = "";
		        }
		        else{
		        	$data['peticion'] = $peticion;
		        	$data['banda'] = $this->banda_model->search_banda($peticion);
		        	$data['lanzamiento'] = $this->lanzamiento_model->search_lanzamiento($peticion);
		        }


		        
				$this->load->view('templates/header', $data);
				$this->load->view('paginas/buscar', $data);
				$this->load->view('templates/footer', $data);			        

		}

		public function send($value='')
		{
	        $this->load->library('form_validation');
	        // field name, error message, validation rules
	        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');     
	        $this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email');
	        $this->form_validation->set_rules('comment', 'Comentario', 'trim|required');
	                   
	        if($this->form_validation->run() == FALSE) {
	          	$this->index();
	        } else {        
	            $name = $this->input->post('name');
	            $email = $this->input->post('email');
	            $comment = $this->input->post('comment');            
	            if(!empty($email)) {
	                // send mail
	                $config = array (
	                  'mailtype' => 'html',
	                  'charset'  => 'utf-8',
	                  'priority' => '1'
	                );
	                $message='';
	                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">'.$comment.'</p>';   
	                $delimeter = $name."<br>".$contact_no;
	                $dataMail = array('topMsg'=>'Hi Team', 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> $delimeter);
	 
	                $this->email->initialize($config);
	                $this->email->from($email, $name);
	                $this->email->to(TO_MAIL);
	                $this->email->subject('Contact Form');
	                $message = $this->load->view('mailTemplate/contactForm', $dataMail, TRUE);
	                $this->email->message($message);
	                $this->email->send();
	 
	                // confirm mail
	                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Thank you for contacting us.</p>';                 
	                $dataMail = array('topMsg'=>'Hi '.$name, 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> 'Team TechArise');
	 
	                $this->email->initialize($config);
	                $this->email->from(TO_MAIL, FROM_TEXT);
	                $this->email->to($email);
	                $this->email->subject('Contact Form Confimation');
	                $message = $this->load->view('mailTemplate/contactForm', $dataMail, TRUE);
	                $this->email->message($message);
	                $this->email->send();                
	            }
	            $this->session->set_flashdata('msg', 'Thank you for your message. It has been sent.');
	            redirect('paginas/');
	        }
		}
}
