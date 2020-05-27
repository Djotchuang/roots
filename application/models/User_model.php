<?php
	class User_model extends CI_Model{
		public function register($enc_password){
			// User data array
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_password,
				'country' => $this->input->post('country'),
				'tribe'   => $this->input->post('tribe')
			);

			// Insert user
			return $this->db->insert('users', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}
		public function get_profile_data($id){
		  $this->db->where('id', $id);
		  $query = $this->db->get('users');
		  return $query->result_array();
		}

		public function update($enc_password, $id){
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

		public function avatar($id, $image){
			$data = array(
				'avatar' => $image
			);
			$this->db->where('id', $id);
			$this->db->update('users', $data);
		}
		function fetch_data($val){
			if($this->db->get('users')){
				$this->db->like('username', $val);
				$query = $this->db->get('users');
				return $query->result_array();
			}
			else {
				echo 'No Result';
			}
		}
	}