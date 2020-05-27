<?php

class Message_model extends CI_Model {
    public function __construct(){
    }
    public function insert_message($message, $reciever_name, $sender_id){
        $data = array(
            'sender_id' => $sender_id,
            'reciever_name' => $reciever_name,
            'msg_content' => $message,
            'msg_status' => 'no',
          );    
        $this->db->insert('messages', $data);
      }
}