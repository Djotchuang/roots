<?php
class Post_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_posts($slug = false, $limit = false, $offset = false)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($slug === false) {
            $this->db->order_by('posts.pid', 'DESC');
            $this->db->join('countries', 'countries.c_id = posts.country_id');
            $this->db->join('users', 'users.id = posts.user_id');
            $this->db->join('categories', 'categories.ca_id = posts.category_id', 'left');
            $query = $this->db->get('posts');
            return $query->result_array();
        }

        $this->db->order_by('posts.pid', 'DESC');
        $this->db->join('countries', 'countries.c_id = posts.country_id');
        $this->db->join('categories', 'categories.ca_id = posts.category_id', 'left');
        $this->db->join('users', 'users.id = posts.user_id');
        $query = $this->db->get_where('posts', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_recent_post()
    {
        $this->db->order_by('posts.pid', 'DESC');
        $this->db->limit(5, 1);
        $query = $this->db->get('posts');
        return $query->result_array();
    }

    public function create_post($post_image)
    {
        $url = url_title($this->input->post('title'));

        function generate_string($input, $strength = 16)
        {
            $input_length = strlen($input);
            $random_string = '';
            for ($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            return $random_string;
        }

        $slug = generate_string($url, 100);
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'country_id' => $this->input->post('country_id'),
            'category_id' => $this->input->post('category_id'),
            'user_id' => $this->session->userdata('user_id'),
            'post_image' => $post_image,
        );

        return $this->db->insert('posts', $data);
    }

    public function delete_post($id)
    {
        $image_file_name = $this->db->select('post_image')->get_where('posts', array('pid' => $id))->row()->post_image;
        $cwd = getcwd(); // save the current working directory
        $image_file_path = $cwd . "\\assets\\images\\posts\\";
        chdir($image_file_path);
        unlink($image_file_name);
        chdir($cwd); // Restore the previous working directory
        $this->db->where('pid', $id);
        $this->db->delete('posts');
        return true;
    }

    public function update_post()
    {
        $slug = url_title($this->input->post('title'));

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'country_id' => $this->input->post('country_id'),
            'category_id' => $this->input->post('category_id'),
        );

        $this->db->where('pid', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }

    public function get_countries()
    {
        $this->db->order_by('cname');
        $query = $this->db->get('countries');
        return $query->result_array();
    }

    public function get_categories()
    {
        $this->db->order_by('ca_name');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_posts_by_country($country_id)
    {
        $this->db->order_by('posts.pid', 'DESC');
        $this->db->join('countries', 'countries.c_id = posts.country_id');
        $this->db->join('users', 'users.id = posts.user_id');
        $query = $this->db->get_where('posts', array('country_id' => $country_id));
        return $query->result_array();
    }
    public function get_posts_by_category($category_id)
    {
        $this->db->order_by('posts.pid', 'DESC');
        $this->db->join('categories', 'categories.ca_id = posts.category_id');
        $this->db->join('users', 'users.id = posts.user_id');
        $query = $this->db->get_where('posts', array('category_id' => $category_id));
        return $query->result_array();
    }
    public function get_activities($slug = false, $id)
    {
        if ($slug === false) {
            $this->db->order_by('posts.pid', 'DESC');
            $this->db->join('users', 'users.id = posts.user_id');
            $query = $this->db->get('posts');
            return $query->result_array();
        }
    }
    public function fetch_data($val)
    {
        if ($this->db->get('posts')) {
            $this->db->like('title', $val);
            $query = $this->db->get('posts');
            return $query->result_array();
        } else {
            echo 'No Result';
        }
    }
    public function likes($post_id, $user_id)
    {
        $data = array(
            'likes' => 'yes',
            'like_post_id' => $post_id,
            'like_user_id' => $user_id
        );
        $this->db->insert('post_likes', $data);
    }
    public function dislikes($post_id, $user_id)
    {
        $data = array(
            'likes' => 'no',
        );
        $array = array(
            'like_post_id' => $post_id,
            'like_user_id' => $user_id
        );
        $this->db->where($array);
        $query = $this->db->get('post_likes');
        if ($query->num_rows() > 0) {
            $this->db->update('post_likes', $data);
        }
    }
    public function get_likes($post_id)
    {
        $data = array(
            'likes' => 'yes',
            'like_post_id' => $post_id
        );
        $this->db->where($data);
        $query = $this->db->get('post_likes');

        return $query->num_rows();
    }
    public function get_dislikes($post_id)
    {
        $data = array(
            'likes' => 'no',
            'like_post_id' => $post_id
        );
        $this->db->where($data);
        $query = $this->db->get('post_likes');

        return $query->num_rows();
    }
    public function pin_post($post_id, $user_id, $slug, $title)
    {
        $data = array(
            'pin_post_id' => $post_id,
            'pin_user_id' => $user_id,
            'pin_slug' => $slug,
            'pin_title' => $title
        );
        $this->db->insert('pin_post', $data);
    }
    public function get_pin_post($slug)
    {
        $query = $this->db->get_where('posts', array(
            'slug' => $slug
        ));
        return $query->result_array();
    }
    public function get_pin_post_data($user_id)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get_where('pin_post', array(
            'pin_user_id' => $user_id
        ));
        return $query->result_array();
    }
    function delete_pin_post($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pin_post');
    }
}
