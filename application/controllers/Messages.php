<?php 
 class Messages extends CI_Controller {
  public function send_message(){
    if($this->input->post('reciever_name')){
        $message= $this->input->post('message');
        $reciever_name= $this->input->post('reciever_name');
        $sender_id = $this->session->user_data('user_id');   
      $this->message_model->insert_message($message, $reciever_name, $sender_id);
    }
  }
}