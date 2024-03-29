<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('date.timezone','Asia/Shanghai');//时区设置
class Register extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('Login_model');
		$this->load->library('form_validation');
	}
	
	public function index() {
		//判断是否登陆
		if($this->Login_model->is_logged_in()) {
			//已登陆跳转
			redirect('Admin/index');
		} else {
			//未登录跳转
			#$data['yzm'] = $this->Login_model->get_checkword();
			$data['login_error'] = "";
			$this->load->view('register',$data);
		}
	}

	public function register() {
		//如果登陆则跳转
		if($this->Login_model->is_logged_in()){
			redirect('Admin/index');
		}
		$data['login_error'] = '';
		//设置表单字段过滤规则
		$this->form_validation->set_rules('username','用户名','required',array('required'=>'用户名不能为空'));
		$this->form_validation->set_rules('password','密码','required',array('required'=>'密码不能为空'));
		//$this->form_validation->set_rules('checknum','验证码','required',array('required'=>'验证码不能为空'));
		//判断过滤结果是否成功
		if($this->form_validation->run()) {
			//获取用户输入信息
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//$checknum = $this->input->post('checknum');
			if($this->Login_model->get_by_username($username)) {
				$data['login_error'] = '登录失败:无效的用户名或密码!'; 
			} else {
				$this->Login_model->add_user($username, $password);
				$data['tips'] = '注册成功！';
				redirect('login/index');
			}
			//验证码输入判断
		}
		//过滤失败重新加载视图
		//$data['yzm'] = $this->Login_model->get_checkword();
		$this->load->view('register',$data);
	}
	
}

?>
