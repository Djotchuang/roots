<?php
class Comments extends CI_Controller
{
	public function create($post_id)
	{
		$slug = $this->input->post('slug');
		$data['post'] = $this->post_model->get_posts($slug);
		$this->form_validation->set_rules('body', 'Body', 'required');


		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		} else {
			$this->comment_model->create_comment($post_id);
			$this->load->helper('timeelapsed_helper');
			$this->session->set_userdata('comment_created', 'added a comment');
            $comment_created = $this->session->userdata('comment_created');
            $this->user_model->insert_user_activity($comment_created);
			redirect('posts/'.$slug);
		}
	}
	public function index_create($post_id)
	{
		$slug = $this->input->post('slug');
		$data['post'] = $this->post_model->get_posts($slug);
		$this->form_validation->set_rules('body', 'Body', 'required');


		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		} else {
			$this->comment_model->create_comment($post_id);
			$this->load->helper('timeelapsed_helper');
			$this->session->set_userdata('comment_created', 'added a comment');
            $comment_created = $this->session->userdata('comment_created');
            $this->user_model->insert_user_activity($comment_created);
			redirect('posts/#post-'.$post_id);
		}
	}
	public function get_comments()
	{
		$id = $_POST["id"];
		$result = $this->comment_model->get_comments($id);
		foreach ($result as $row) {
			$avatar = $row['avatar'];
			$name = $row['username'];
			$comment = $row['body'];
	
		$output = '<div class="comment-info">';
		$output .= '<img src="'. $avatar . '" class="comment-avatar avatar-image" alt="user profile image">';
		$output .= '<span>';
		$output .= '<h6>' . $name . '&nbsp;</h6>';
		$output .= '<p>'. $comment .'</p>';
		$output .= '</span>';
		$output .= '</div>';
		
		echo $output;
		}
	}
	public function get_comments_count ($id) {
		$result = $this->comment_model->count($id);
		echo $result;
	}
}


								
									
