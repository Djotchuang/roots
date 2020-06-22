<?php
class Messages extends CI_Controller
{
  public function send_message() 
  {
      $message = $_POST['message'];
      $reciever_id = $_POST['recieverId'];
      $this->session->set_userdata('reciever_id', $reciever_id);
      $sender_id = $this->session->userdata('user_id');
      if($reciever_id == $sender_id) {
      $message_status = 'left';
      }
      else 
      {
        $message_status = 'right';
      }
      $this->message_model->insert_message($message, $reciever_id, $sender_id, $message_status);
      $this->session->set_userdata('message_notification', 'You have recieved a message from');
      $text = $this->session->userdata('message_notification');
      $data = $this->user_model->get_id($sender_id);
      $sender_name =  $data['username'];
      
      $this->message_model->insert_notification($sender_id, $reciever_id, $text, $sender_name);
  }

  public function get_user_id () 
  {
    $id = $this->session->userdata('user_id');
    $data = $this->user_model->get_id($id);
    foreach($data as $row) 
    {
      $id =  $row['id'];
    }
    $this->session->set_userdata('id', $id);
  }
  public function send_reverse_message() 
  {
    $message = $_POST['message'];
    $sender_id = $_POST['recieverId'];
    $this->session->set_userdata('reciever_id', $sender_id);
    $reciever_id = $this->session->userdata('user_id');
    $message_status = 'left';
    $this->message_model->insert_message($message, $sender_id, $reciever_id, $message_status);
    $this->session->set_userdata('message_notification', 'You have recieved a message from');
    $text = $this->session->userdata('message_notification');
    $data = $this->user_model->get_id($sender_id);
    $sender_name =  $data['username'];
    
    $this->message_model->insert_notification($sender_id, $reciever_id, $text, $sender_name);
  }

  public function get_messages ($reciever_id) 
  {
    $sender_id = $this->session->userdata('user_id');
    $data = $this->user_model->get_id($reciever_id);
    $messages = $this->message_model->get_messages($reciever_id, $sender_id);
    $avatar =  $data['avatar'];
    foreach($messages as $message) 
    {
      $message_dir = '';
      if($sender_id == $message['sender_id'])
      {
        $message_dir = 'right';
      }
      else{
        $message_dir = 'left';
      }

      if($message_dir == 'left') 
      {
      $output = '<div class="media media-chat"> <img class="chatbox-avatar" src="' . $avatar . '" alt="...">';
      $output .= '<div class="media-body">';
      $output .= '<p>'. $message['msg_content'] . '</p>';
      $output .= '<p class="meta">' . $message['msg_date'] . '</p>';
      $output .= '</div>';
      $output .= '</div>';
      }
      else 
      {
        $output = '<div class="media media-chat media-chat-reverse">';
        $output .= '<div class="media-body">';
        $output .= '<p>'. $message['msg_content'] . '</p>';
        $output .= '<p class="meta">' . $message['msg_date'] . '</p>';
        $output .= '</div>';
        $output .= '</div>';
      }
      echo $output;
    }
  }
  function delete_notification ($id)
  {
    $this->message_model->delete_notification($id);
  }
}
