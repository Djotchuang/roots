<?php
class Posts extends CI_Controller
{
    public function index($offset = 0)
    {
        // Pagination Config
        $config['base_url'] = base_url() . 'posts/index/';
        $config['total_rows'] = $this->db->count_all('posts');
        $config['per_page'] = 20;
        $config['uri_segment'] = 20;
        $config['attributes'] = array('class' => 'pagination-link');

        // Init Pagination
        $this->pagination->initialize($config);

        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Latest Posts';
        $data['posts'] = $this->post_model->get_posts(false, $config['per_page'], $offset);
        $data['profiles'] = $this->user_model->get_profile_data($user_id);
        $data['latests'] = $this->post_model->get_recent_post();
        $results = $this->user_model->get_country($user_id);
        $data['pinposts'] = $this->post_model->get_pin_post_data($user_id);
        foreach ($results as $result) {
            $country = $result['country'];
        }
        if ($this->session->userdata('logged_in')) {
            $data['peoples'] = $this->user_model->get_people_nearby($country);
        }
        $this->load->helper('timeelapsed_helper');
        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = null)
    {
        $data['post'] = $this->post_model->get_posts($slug);
        $results = $this->post_model->get_posts($slug);
        $post_id = $results['pid'];
        $user_id = $this->session->userdata('user_id');
        $data['profiles'] = $this->user_model->get_profile_data($user_id);
        $user_id = $this->session->userdata('user_id');
        $results = $this->user_model->get_country($user_id);
        foreach ($results as $result) {
            $country = $result['country'];
        }

        $data['peoples'] = $this->user_model->get_people_nearby($country);
        $data['comments'] = $this->comment_model->get_comments($post_id);
        $data['counts'] = $this->comment_model->get_comments_count($post_id);
        $data['latests'] = $this->post_model->get_recent_post();

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'];

        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Create Post';

        $data['countries'] = $this->post_model->get_countries();
        $data['categories'] = $this->post_model->get_categories();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
        // $this->form_validation->set_rules('category', 'Category', 'required');
        // $this->form_validation->set_rules('country', 'Country', 'required');


        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        } else {
            // Upload Image
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);

            if ($_FILES['userfile']['name'] != '' && !$this->upload->do_upload()) {
                // $errors = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('upload_error', 'Failed to upload! 
                This may be an internet error or your file size and/or dimensions. Please choose another file and try again.');
                redirect('posts/create');
            } else {

                $data = array('upload_data' => $this->upload->data());
                $string = $_FILES['userfile']['name'];
                $trimmed = trim($string);
                $post_image = str_replace(' ', '_', $trimmed);

                $config['image_library'] = 'gd2';
                $config['source_image'] = '../images/post/' . $post_image;
                $config['create_thumb'] = true;
                $config['maintain_ratio'] = true;
                $config['width'] = 300;
                $config['height'] = 250;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
            }


            $this->post_model->create_post($post_image);
            $this->session->set_userdata('post_created', 'created a post');
            $post_created = $this->session->userdata('post_created');
            $this->user_model->insert_user_activity($post_created);

            $this->session->set_flashdata('post_created', 'Your post has been created');
            $this->load->helper('timeelapsed_helper');
            redirect('posts');
        }
    }
    public function delete($id)
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post_model->delete_post($id);

        $this->session->set_userdata('post_deleted', 'deleted a post');
        $post_deleted = $this->session->userdata('post_deleted');
        $this->user_model->insert_user_activity($post_deleted);

        // Set message
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted');
        $this->load->helper('timeelapsed_helper');
        redirect('posts');
    }

    public function edit($slug)
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['post'] = $this->post_model->get_posts($slug);

        // Check user
        if ($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['id']) {
            $this->load->helper('timeelapsed_helper');
            redirect('posts');
        }

        $data['countries'] = $this->post_model->get_countries();

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = 'Edit Post';

        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post_model->update_post();

        $this->session->set_userdata('post_updated', 'updated a post');
        $post_updated = $this->session->userdata('post_updated');
        $this->user_model->insert_user_activity($post_updated);

        // Set message
        $this->session->set_flashdata('post_updated', 'Your post has been updated');
        $this->load->helper('timeelapsed_helper');
        redirect('posts');
    }

    public function fetch()
    {
        $val = $this->input->post('post_search');
        $result = $this->post_model->fetch_data($val);
        foreach ($result as $row) {
            $id = $row['pid'];
        }
        $data['counts'] = $this->comment_model->get_comments_count($id);
        $data['search'] = $this->post_model->fetch_data($val);
        $data['title'] = 'Showing search results...';
        $this->load->view('templates/header');
        $this->load->view('pages/post_search_result', $data);
        $this->load->view('templates/footer');
    }
    public function likes()
    {
        $post_id = $_POST['postId'];
        $user_id = $_POST['userId'];
        $this->post_model->likes($post_id, $user_id);
        $likes = $this->post_model->get_likes($post_id);
        echo $likes;
    }
    public function get_likes($post_id)
    {
        $likes = $this->post_model->get_likes($post_id);
        echo $likes;
    }
    public function dislikes()
    {
        $post_id = $_POST['postId'];
        $user_id = $_POST['userId'];
        $this->post_model->dislikes($post_id, $user_id);
        $dislikes = $this->post_model->get_dislikes($post_id);
        echo $dislikes;
    }
    public function get_dislikes($post_id)
    {
        $likes = $this->post_model->get_dislikes($post_id);
        echo $likes;
    }
    public function get_pin_post($post_id)
    {
        $slug = $_POST['postSlug'];
        $title = $_POST['postTitle'];
        $user_id = $this->session->userdata('user_id');
        $this->post_model->pin_post($post_id, $user_id, $slug, $title);
        $pinposts = $this->post_model->get_pin_post($slug);
        foreach ($pinposts as $pinpost) {
            $data['title'] = ucfirst($pinpost['title']);
            $data['slug'] = site_url('/posts/' . $pinpost['slug']);
            $data['id'] = $pinpost['pid'];
            echo json_encode($data);
        }
    }
    function delete_pin_post($id)
    {
        $this->post_model->delete_pin_post($id);
        $this->db->where('id', $id);
        $this->db->delete('pin_post');
    }
}
