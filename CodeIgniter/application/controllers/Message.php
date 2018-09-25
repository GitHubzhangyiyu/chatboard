<?php
class Message extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
		$this->load->model('users_model');
        $this->load->model('messages_model');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url_helper');
    }
	public function index()
	{
		if(!isset($_SESSION['user_id']))
		{
			$data['title'] = '登录';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		}
		else
		{
		    $data['messages'] = $this->messages_model->get_index_ms();
		    $this->load->view('templates/header');
		    $this->load->view('message/index', $data);
		    $this->load->view('templates/footer');
		}
	}
	public function personal()
	{
		if(!isset($_SESSION['user_id']))
		{
			$data['title'] = '登录';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		}
		else
		{
		    $root_mid = $this->messages_model->get_root_mid($_SESSION['user_id']);
			$number = 0;
			foreach ($root_mid as $root_mid_item)
			{
				$data['messages'][$number] = $this->messages_model->get_personal($root_mid_item['root_mid']);
				$number++;
			}
		    $this->load->view('templates/header');
			if(!isset($data))
			{
				$this->load->view('message/personal_none.php');
			}
			else
			{
				$this->load->view('message/personal.php', $data);
			}
		    $this->load->view('templates/footer');
		}
	}
	public function reply($root_mid, $from_uid)
	{
		$this->load->library('form_validation');
		$data['title'] = '回复留言';
		$data['rmid'] = $root_mid;
		$data['fuid'] = $from_uid;
		$this->form_validation->set_rules('text', '留言内容', 'required|htmlspecialchars|trim');
		if(!isset($_SESSION['user_id']))
		{
			$data['title'] = '登录';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		}
		elseif($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('message/reply', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->messages_model->set_messages($from_uid, $root_mid);
			$this->load->view('templates/header');
			$this->load->view('message/success', $data);
			$this->load->view('templates/footer');
		}	
	}
	public function create()
	{
		$this->load->library('form_validation');
		$data['title'] = '新增留言';
		$this->form_validation->set_rules('to_username', 'To:', 'required');
		$this->form_validation->set_rules('text', '留言内容', 'required|htmlspecialchars|trim');
		if(!isset($_SESSION['user_id']))
		{
			$data['title'] = '登录';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		}
		elseif($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('message/create');
			$this->load->view('templates/footer');
		}
		else 
		{
			if($this->input->post('to_username') == '0')
			{
				$data['to_un'] = "公共留言板";
				$this->messages_model->set_messages(0, 0);
                $this->load->view('templates/header');
			    $this->load->view('message/success', $data);
			    $this->load->view('templates/footer');
			}
			else
			{
				$data['users'] = $this->users_model->find_users($this->input->post('to_username'));
				if ($data['users'] == NULL)
				{
					$data['error'] = "用户名不存在";
					$this->load->view('templates/header', $data);
			        $this->load->view('message/create', $data);
			        $this->load->view('templates/footer');
				}
				else
				{
					$data['to_un'] = $this->input->post('to_username');
					$data['messages'] = $this->messages_model->get_max_mid();
					$user_id = $data['users']['user_id'];
					$this->messages_model->set_messages($user_id, $data['messages']['message_id']+1);
					$this->load->view('templates/header');
			        $this->load->view('message/success', $data);
			        $this->load->view('templates/footer');
				}
            }
        }
    }
	public function delete($message_id = NULL)
	{
		$data['title'] = '新增留言';
		if(!isset($_SESSION['user_id']))
		{
			$data['title'] = '登录';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		}
		elseif($message_id === NULL)
		{
			$data['messages'] = $this->messages_model->get_ones_messages($_SESSION['user_id']);
		    $this->load->view('templates/header');
		    $this->load->view('message/delete', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->messages_model->delete_messages($message_id);
			$data['messages'] = $this->messages_model->get_ones_messages($_SESSION['user_id']);
			$this->load->view('templates/header');
		    $this->load->view('message/delete', $data);
		    $this->load->view('templates/footer');
		}
	}
}	