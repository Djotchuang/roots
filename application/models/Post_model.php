<?php
	class Post_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				$this->db->limit($limit, $offset);
			}
			if($slug === FALSE){
				$this->db->order_by('posts.pid', 'DESC');
				$this->db->join('countries', 'countries.id = posts.country_id');
				$this->db->join('users', 'users.id = posts.user_id');
				$query = $this->db->get('posts');
				return $query->result_array();
			}

			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function create_post($post_image){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'country_id' => $this->input->post('country_id'),
				'user_id' => $this->session->userdata('user_id'),
				'post_image' => $post_image
			);

			return $this->db->insert('posts', $data);
		}

		public function delete_post($id){
			$image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
			$cwd = getcwd(); // save the current working directory
			$image_file_path = $cwd."\\assets\\images\\posts\\";
			chdir($image_file_path);
			unlink($image_file_name);
			chdir($cwd); // Restore the previous working directory
			$this->db->where('id', $id);
			$this->db->delete('posts');
			return true;
		}

		public function update_post(){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'country_id' => $this->input->post('country_id')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function get_countries(){
			$this->db->order_by('cname');
			$query = $this->db->get('countries');
			return $query->result_array();
		}

		public function get_posts_by_country($country_id){
			$this->db->order_by('posts.pid', 'DESC');
			$this->db->join('countries', 'countries.id = posts.country_id');
			$this->db->join('users', 'users.id = posts.user_id');
			$query = $this->db->get_where('posts', array('country_id' => $country_id));
			return $query->result_array();
		}
	}