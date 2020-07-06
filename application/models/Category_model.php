<?php
class category_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_categories()
	{
		$this->db->order_by('ca_name');
		$query = $this->db->get('categories');
		return $query->result_array();
	}

	public function create_category()
	{
		$data = array(
			'cname' => $this->input->post('name'),
			'user_id' => $this->session->userdata('user_id')
		);

		return $this->db->insert('categories', $data);
	}

	public function get_category($id)
	{
		$query = $this->db->get_where('categories', array('ca_id' => $id));
		return $query->row();
	}

	public function delete_category($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('categories');
		return true;
	}
}
