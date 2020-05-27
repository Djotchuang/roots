<?php
	class Countries extends CI_Controller{
		public function index(){
			$data['title'] = 'Countries';

			$data['countries'] = $this->country_model->get_countries();

			$this->load->view('templates/header');
			$this->load->view('countries/index', $data);
			$this->load->view('templates/footer');
		}

		public function create(){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			
			$data['title'] = 'Create country';

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('countries/create', $data);
				$this->load->view('templates/footer');
			} else {
				$this->country_model->create_country();

				// Set message
				$this->session->set_flashdata('country_created', 'Your country has been created');

				redirect('countries');
			}
		}

		public function posts($id){
			$data['title'] = $this->country_model->get_country($id)->cname;

			$data['posts'] = $this->post_model->get_posts_by_country($id);

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		public function delete($id){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->country_model->delete_country($id);

			// Set message
			$this->session->set_flashdata('country_deleted', 'Your country has been deleted');

			redirect('countries');
		}
	}