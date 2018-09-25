<?php
class Auth extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
		$this->load->model('messages_model');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url_helper');
    }
	public function register()
	{
		$this->load->library('form_validation');
		
		$data['title'] = '注册';
		
		$this->form_validation->set_rules(
            'username', '用户名',
            'required|min_length[2]|max_length[12]|is_unique[users.username]'
        );
        $this->form_validation->set_rules('pass', '密码', 'required');
        $this->form_validation->set_rules('passconf', '确认密码', 'required|matches[pass]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]'
		);
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header',$data);
			$this->load->view('auth/register');
		    $this->load->view('templates/footer');
		}
		else
		{
			$this->users_model->set_users();
			$this->load->view('templates/header');
			$this->load->view('auth/success');
		    $this->load->view('templates/footer');
		}
	}
	public function login()
	{
		$this->load->helper('url');
		$data['title'] = '登录';
		$data['error'] = '信息有误';
		$data['users'] = $this->users_model->get_users($this->input->post('email'), $this->input->post('pass'));
		if($data['users'] == NULL)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('templates/footer');
		}
		else 
		{
			$logindata = array(
			    'user_id' => $data['users']['user_id'],
			    'username' => $data['users']['username'],
				'permission' => $data['users']['permission'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($logindata);
            redirect('/message/index', 'refresh');			
		}
	}
	public function logout()
	{
		$data['title'] = '登录';
		$this->load->view('templates/header');
		$this->load->view('auth/login', $data);
		$this->load->view('templates/footer');
		$_SESSION = array();
		session_destroy();
	}
    public function viewusers($user_id = NULL)
    {
        $data['title'] = '管理用户';
		if($_SESSION['permission'] != 1)
		{
			$data['title'] = '登录';
			$this->load->view('templates/header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		}
		elseif($user_id === NULL)
		{
		    $data['users'] = $this->users_model->get_all_users();
			$this->load->view('templates/header');
		    $this->load->view('auth/viewusers', $data);
		    $this->load->view('templates/footer');
		}
		else
		{
			$message_id = $this->messages_model->get_ones_messages($user_id);
			foreach ($message_id as $message_id_item)
			{
				$this->messages_model->delete_messages($message_id_item['message_id']);
			}
			$this->users_model->delete_users($user_id);
			$data['users'] = $this->users_model->get_all_users();
			$this->load->view('templates/header');
		    $this->load->view('auth/viewusers', $data);
		    $this->load->view('templates/footer');
		}
    }		
}