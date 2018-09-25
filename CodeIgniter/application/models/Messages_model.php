<?php
class Messages_model extends CI_Model{
	public function __construct()
	{
		$this->load->database();
	}
	public function set_messages($user_id, $root_mid)
	{
		$data = array(
			'from_uid' => $_SESSION['user_id'],
            'to_uid' => $user_id,
            'root_mid' => $root_mid,
			'text' => $this->input->post('text')
		);
		return $this->db->insert('messages', $data);
	}
	public function get_max_mid()
	{
		$this->db->select_max('message_id');
		$query = $this->db->get('messages');
		return $query->row_array();
	}
	public function get_index_ms()//获取公共留言板留言
	{
		$query = $this->db->query("SELECT * FROM users,messages WHERE users.user_id = messages.from_uid AND messages.root_mid = 0 AND messages.status = 1 ORDER BY addtime ASC LIMIT 100");
		return $query->result_array();
	}
	public function get_root_mid($user_id)//获取私人留言的分组
	{
		$root_mid = $this->db->query("SELECT DISTINCT root_mid FROM messages WHERE (from_uid=$user_id OR to_uid=$user_id) AND to_uid != 0 AND messages.status = 1");
		return $root_mid->result_array();
	}
	public function get_personal($root_mid)//获取私人留言
	{
		$query = $this->db->query("SELECT * FROM users,messages WHERE users.user_id = messages.from_uid AND messages.root_mid = $root_mid AND messages.status = 1 ORDER BY addtime ASC LIMIT 100");
		return $query->result_array();
	}
	public function get_ones_messages($user_id)//获取某用户发送的所有留言
	{
		$query = $this->db->query("SELECT * FROM messages WHERE from_uid = $user_id AND status = 1 ORDER BY addtime DESC LIMIT 100");
		return $query->result_array();
	}
	public function delete_messages($message_id)
	{
		$this->status = 0;
		return $this->db->update('messages', $this, array('message_id' => $message_id));
	}
}