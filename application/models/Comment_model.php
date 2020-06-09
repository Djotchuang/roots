<?php
	class Comment_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_comment($post_id){
			$data = array(
				'post_id' => $post_id,
				'user_id' => $this->session->userdata('user_id'),
				'body' => $this->input->post('body')
			);

			return $this->db->insert('comments', $data);
		}

		public function get_comments($post_id){
			$this->db->order_by('comments.id', 'DESC');
			$this->db->join('users', 'users.id = comments.user_id');
			$query = $this->db->get_where('comments', array('post_id' => $post_id));
			return $query->result_array();
		}
        public function get_comments_count($id) {
			$this->db->join('posts', 'posts.pid = comments.post_id');
			$this->db->where('post_id', $id);
			if ($this->db->count_all('comments') == '') {
				return 'no comments';
			}
			elseif($this->db->count_all('comments') == 1){
				return '1 comment';
			}
			else{
			return $this->db->count_all('comments') . ' Comments ';
			}
		}
		public function get_single_comments_count($post_id) {
			$this->db->join('posts', 'posts.pid = comments.post_id');
			$this->db->where('post_id', $post_id);
			if ($this->db->count_all('comments') == '') {
				return 'no Comments';
			}
			elseif($this->db->count_all('comments') == 1){
				return '1 Comment';
			}
			else{
			return $this->db->count_all('comments') . ' Comments';
			}
		}
	}
	