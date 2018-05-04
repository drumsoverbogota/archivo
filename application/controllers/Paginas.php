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
}