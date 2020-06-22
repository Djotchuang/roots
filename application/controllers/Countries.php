<?php
class Countries extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Countries';

		$data['countries'] = $this->country_model->get_countries();

		$this->load->view('templates/header');
		$this->load->view('countries/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		// Check login
		if (!$this->session->userdata('logged_in')) {
			redirect('users/login');
		}

		$data['title'] = 'Add a Country';

		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() === FALSE) {
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

	public function posts($id)
	{
		$data['title'] = $this->country_model->get_country($id)->cname;
        $user_id = $this->session->userdata('user_id');
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

		$this->country_model->delete_country($id);

		// Set message
		$this->session->set_flashdata('country_deleted', 'Your country has been deleted');

		redirect('countries');
	}
}
