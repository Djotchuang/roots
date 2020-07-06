<?php
class categories extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Categories';

		$data['categories'] = $this->category_model->get_categories();


		$this->load->view('templates/header');
		$this->load->view('categories/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		// Check login
		if (!$this->session->userdata('logged_in')) {
			redirect('users/login');
		}

		$data['title'] = 'Add a category';

		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('categories/create', $data);
			$this->load->view('templates/footer');
		} else {
			$this->category_model->create_category();

			// Set message
			$this->session->set_flashdata('category_created', 'Your category has been created');

			redirect('categories');
		}
	}

	public function posts($id)
	{
		$data['title'] = $this->category_model->get_category($id)->ca_name;
		$data['posts'] = $this->post_model->get_posts_by_category($id);
		$user_id = $this->session->userdata('user_id');
		$data['pinposts'] = $this->post_model->get_pin_post_data($user_id);
		$data['posts'] = $this->post_model->get_posts_by_country($id);
		$data['profiles'] = $this->user_model->get_profile_data($user_id);
		$data['latests'] = $this->post_model->get_recent_post();
		$results = $this->user_model->get_country($user_id);
		foreach ($results as $result) {
			$country = $result['country'];
		}
		$data['peoples'] = $this->user_model->get_people_nearby($country);
		$this->load->helper('timeelapsed_helper');
		$this->load->view('templates/header');
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id)
	{
		// Check login
		if (!$this->session->userdata('logged_in')) {
			redirect('users/login');
		}

		$this->category_model->delete_category($id);

		// Set message
		$this->session->set_flashdata('category_deleted', 'Your category has been deleted');

		redirect('categories');
	}
}
