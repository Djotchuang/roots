<?php
class Users extends CI_Controller
{
    // Register user
    public function register()
    {
        $data['title'] = 'Sign Up';
        $data['tribe'] = $this->input->post('tribe');
        $data['country'] = $this->input->post('country');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            // Encrypt password
            $enc_password = md5($this->input->post('password'));

            $this->user_model->register($enc_password);

            // Set message
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');

            redirect('posts');
        }
    }

    // Log in user
    public function login()
    {
        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {

            // Get username
            $username = $this->input->post('username');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));

            // Login user
            $user_id = $this->user_model->login($username, $password);

            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                );

                $this->session->set_userdata($user_data);

                // Set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                redirect('posts');
            } else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');

                redirect('users/login');
            }
        }
    }

    // Reset Password
    public function reset_password()
    {
        $data['title'] = 'Reset Password';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('users/reset_password', $data);
            $this->load->view('templates/footer');
        } else {

            // Get email
            $email = $this->input->post('email');

            $result = $this->user_model->check_email_exists($email);

            if (!$result) {
                $token = rand(1000, 9999);
                $result = $this->user_model->change_password($email, $token);

                $message = "Please follow the link below <br> <a href='" . base_url('users/change_password?token=') . $token . "'> Reset Password</a> to reset your password.";

                $this->send_mail($email, $message, 'Reset Password Link', 'users/redirect');
            } else {
                $this->session->set_flashdata('message', 'Email not registered');
                redirect('users/reset_password');
            }
        }
    }

    public function change_password()
    {
        $data['title'] = 'Change Password';
        $token = $this->input->get('token');
        $_SESSION['token'] = $token;

        $this->load->view('templates/header');
        $this->load->view('users/change_password', $data);
        $this->load->view('templates/footer');
    }

    public function update_password()
    {
        $newpassword = md5($this->input->post('newpassword'));
        $password2 = md5($this->input->post('password2'));
        $token = $_SESSION['token'];

        if ($newpassword == $password2) {
            $result = $this->user_model->update_password($newpassword, $token);
            $this->session->set_flashdata('reset password', 'Password Changed Successfully');
            redirect('users/login');
        }

        $this->session->set_flashdata('failed to reset', 'Failed to reset password, please try again');
        redirect('users/reset_password');
    }

    // Log user out
    public function logout()
    {
        // Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        // Set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');

        redirect('users/login');
    }

    // Check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    //User profile
    public function profile()
    {
        $id = $this->session->userdata('user_id');
        $data['profiles'] = $this->user_model->get_profile_data($id);
        $this->load->view('templates/header');
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $enc_password = md5($this->input->post('password'));

        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        if ($this->form_validation->run() === false) {

            $id = $this->session->userdata('user_id');
            $data['profiles'] = $this->user_model->get_profile_data($id);
            $this->load->view('templates/header');
            $this->load->view('users/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->session->userdata('user_id');
            $this->user_model->update($enc_password, $id);

            $this->session->set_flashdata('profile_updated', 'Your profile has been successfully updated');
            redirect('users/profile');
        }
    }
    public function fetch()
    {
        $val = $this->input->post('search');
        $data['search'] = $this->user_model->fetch_data($val);
        $data['title'] = 'Showing search results';
        $this->load->view('templates/header');
        $this->load->view('pages/search_result', $data);
        $this->load->view('templates/footer');
    }
    public function fetch_user($id)
    {
        $data['profiles'] = $this->user_model->get_profile_data($id);
        $this->load->view('templates/header');
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer');
    }
    public function upload()
    {
        $image = $_POST['image'];

        /* list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        $imageName = time().'.png';
        file_put_contents('upload/'.$imageName, $data);
        $image_file = addslashes(file_get_contents($imageName)); */
        $id = $this->session->userdata('user_id');
        if ($this->user_model->avatar($id, $image)) {
            $this->session->set_flashdata('avatar', 'Image Uploaded successfully');
        } else {
            $this->session->set_flashdata('avatar_error', 'Error uploading Image');
            redirect('users/profile');
        }
    }

    function send_mail($email, $message, $subject = 'Change Your Password', $redirect_path)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'email',
            'smtp_pass' => 'email password',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('djotchuangtamo@gmail.com', 'admin');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_newline("\r\n");

        $result = $this->email->send();

        if (!($result)) {
            show_error($this->email->print_debugger());
        } else {
            $this->load->view('templates/header');
            $this->load->view($redirect_path);
            $this->load->view('templates/footer');
        }
    }

    // Get users with the same country
    public function nearby()
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $user_id = $this->session->user_data('user_id');
        $user_data = $this->user_model->get_profile_data('user_id');
        $data['nearby_users'] = $this->user_model->get_nearby($user_data['country']);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }
}
