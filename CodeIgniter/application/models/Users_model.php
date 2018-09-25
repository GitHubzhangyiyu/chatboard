<?php
class Users_model extends CI_Model{
	public function __construct()
	{
		$this->load->database();
	}
	public function set_users()
	{
		$data = array(
		    'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'pass' => sha1($this->input->post('pass'))
		);
		return $this->db->insert('users', $data);
	}
	public function get_users($email, $pass)//登录时验证用户
	{
		$query = $this->db->get_where('users', array('email' => $email, 'pass' => sha1($pass)));
		return $query->row_array();
	}
	public function find_users($username)//根据用户名找用户
	{
		$query = $this->db->get_where('users', array('username' => $username));
		
		return $query->row_array();
	}
	public function get_all_users()//管理用户时显示所有用户
	{
		$query = $this->db->get_where('users', array('permission' => 0));
		return $query->result_array();
	}
	public function delete_users($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->delete('users');
	}
}