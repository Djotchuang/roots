<?php
class country_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_countries()
	{
		$this->db->order_by('cname');
		$query = $this->db->get('countries');
		return $query->result_array();
	}

	public function create_country()
	{
		$data = array(
			'cname' => $this->input->post('name'),
			'user_id' => $this->session->userdata('user_id')
		);

		return $this->db->insert('countries', $data);
	}

	public function get_country($id)
	{
		$query = $this->db->get_where('countries', array('c_id' => $id));
		return $query->row();
	}

	public function delete_country($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('countries');
		return true;
	}
}
