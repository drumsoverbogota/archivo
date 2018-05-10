<?php
class Paginas extends CI_Controller {
	
        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
				$this->load->helper('url');
				$this->load->library('ion_auth');
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

				$data['title'] = 'admin'; // Capitalize the first letter

				$this->load->view('templates/header', $data);
				$this->load->view('paginas/admin', $data);
				$this->load->view('templates/footer', $data);
		}		
}