<?php

class Message_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert_message($message, $reciever_id, $sender_id, $message_status)
    {
        $data = array(
            'sender_id' => $sender_id,
            'reciever_id' => $reciever_id,
            'msg_content' => $message,
            'msg_status' => $message_status,
        );
        $this->db->insert('messages', $data);
    }
    public function get_messages ($r_id, $s_id)
    {
      $this->db->order_by('msg_id', 'ASC');
      $data = array(
        'reciever_id' => $r_id,
        'sender_id' => $s_id
      );
      $result = array(
        'reciever_id' => $s_id,
        'sender_id' => $r_id
      );
      $this->db->where($data);
      $this->db->or_where($result);
      $query = $this->db->get('messages');
      return $query->result_array();
    }
    public function insert_notification ($sender_id, $reciever_id, $message, $sender_name)
    {
      $data = 
      array (
        'sender_id' => $sender_id,
        'reciever_id' => $reciever_id,
        'message' => $message,
        'sender_name' => $sender_name
      );
      $this->db->insert('notification', $data);
    }
    public function get_notification ()
    {
      $this->db->order_by('n_id', 'DESC');
      $query = $this->db->get('notification');
      return $query->result_array();
    }
    function delete_notification ($id)
    {
        $this->db->where('n_id', $id);
        $this->db->delete('notification');
    }
}
