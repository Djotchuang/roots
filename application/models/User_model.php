<?php
class User_model extends CI_Model
{
	public function register($enc_password)
	{
		// User data array
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $enc_password,
			'country' => $this->input->post('country'),
		);

		// Insert user
		return $this->db->insert('users', $data);
	}

	// Log user in
	public function login($username, $password)
	{
		// Validate
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$result = $this->db->get('users');

		if ($result->num_rows() == 1) {
			return $result->row(0)->id;
		} else {
			return false;
		}
	}

	// Change Password
	public function change_password($email, $token)
	{
		$this->db->query("update users set password='" . $token . "' where email='" . $email . "'");
	}

	public function update_password($newpassword, $token)
	{
		$this->db->query("update users set password='" . $newpassword . "' where password='" . $token . "'");
	}

	// Check username exists
	public function check_username_exists($username)
	{
		$query = $this->db->get_where('users', array('username' => $username));
		if (empty($query->row_array())) {
			return true;
		} else {
			return false;
		}
	}

	// Check email exists
	public function check_email_exists($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		if (empty($query->row_array())) {
			return true;
		} else {
			return false;
		}
	}

	public function get_profile_data($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function update($enc_password, $id)
	{
		$email = $this->input->post('email');
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $email,
			'username' => $this->input->post('username'),
			'occupation' => $this->input->post('occupation'),
			'password' => $enc_password,
			'country' => $this->input->post('country'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'state' => $this->input->post('state'),
			'timezone' => $this->input->post('timezone'),
			'aboutme' => $this->input->post('aboutme'),
			'hobbies' => $this->input->post('hobbies')
		);

		$this->db->where('id', $id);
		$query = $this->db->update('users', $data);
		return $query;
	}

	public function avatar($id, $image)
	{
		$data = array(
			'avatar' => $image
		);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function fetch_data($val)
	{
		if ($this->db->get('users')) {
			$this->db->like('username', $val);
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			echo 'No Result';
		}
	}


	public function get_country($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->result_array();
	}
	 public function get_people_nearby($country)
	{
		$this->db->join('posts', 'posts.pid = users.id', 'left');
		$this->db->where('country', $country);
		$query = $this->db->limit(10,1)->get('users');
		return $query->result_array();
	}
	
	public function insert_user_activity ($activity) {

		$data = array(
		   'user_id' => $this->session->userdata('user_id'),
		   'ip_address' => $_SERVER['REMOTE_ADDR'],
		   'user_agent' => $this->input->user_agent(),
		   'activity' => $activity
		);
		$this->db->insert('activity', $data);
	}

	public function get_recent_activity($id) {
		$this->db->order_by('activity.a_id', 'DESC');
		$this->db->join('users', 'users.id = activity.user_id');
		$this->db->where('activity.user_id', $id);
		$query = $this->db->get('activity');
		return $query->result_array();
	}
	public function get_id ($id) 
	{
		$data = array(
			'id' => $id
		);
		$query = $this->db->get_where('users', $data);
		return $query->row_array();
	}
}
