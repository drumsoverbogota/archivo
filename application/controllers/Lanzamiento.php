<?php
class Lanzamiento extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('lanzamiento_model');
                $this->load->helper('url_helper');
				$this->load->helper('url');
        }

        public function index()
        {
                $data['lanzamiento'] = $this->lanzamiento_model->get_lanzamiento();
				$data['title'] = 'Lista de lanzamientos';

				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/index', $data);
				$this->load->view('templates/footer');				
        }

        public function view($id = NULL)
        {
                $data['lanzamiento_item'] = $this->lanzamiento_model->get_lanzamiento($id);
		        if (empty($data['lanzamiento_item']))
				{
						show_404();
				}

				$data['title'] = $data['lanzamiento_item']['nombre'];

				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/view', $data);
				$this->load->view('templates/footer');
        }
		
		public function create()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['title'] = 'Crear un nuevo Lanzamiento';

			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('formato', 'Formato', 'required');
			$this->form_validation->set_rules('anho', 'Año', 'required');
			$this->form_validation->set_rules('creditos', 'Creditos', 'required');
			$this->form_validation->set_rules('notas', 'Notas', 'required');
			

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('lanzamiento/create');
				$this->load->view('templates/footer');

			}
			else
			{
				$this->news_model->set_news();
				$this->load->view('lanzamiento/success');
			}
		}		
}