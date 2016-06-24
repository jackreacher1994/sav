<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("user_model");
		$this->load->model("quiz_model");
		$this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			$this->session->set_userdata('last_page', current_url());
			redirect('login');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('login');
		}
		
	}

	public function index($limit ='0',$gid ='0',$sid = '0')
	{
		$this->load->helper('form');
		$logged_in=$this->session->userdata('logged_in');

		if($logged_in['su'] !='1' && $logged_in['su'] !='2' && $logged_in['su']!='3'){
			exit($this->lang->line('permission_denied'));
		}

		//fetching user group;
		$data['group_list']=$this->user_model->group_list();

		if($logged_in['su'] =='2' || $logged_in['su'] =='3'){
			$gid = $logged_in['gid'];
			$data['result']=$this->user_model->user_list_su_2($limit,$gid,$sid);
			//$gid = $logged_in['gid'];
		}

		//$data['status_list']=$this->user_model->status_list();
		$data['su'] = $logged_in['su'];
		$data['limit']=$limit;
		$data['gid']=$gid;
		$data['sid']=$sid;
		$data['title']=$this->lang->line('list_users');
		
		// fetching user list
		if($logged_in['su'] =='1'){
			$data['result']=$this->user_model->user_list($limit,$gid,$sid);
		}
		
		
		//var_dump($data);
		$this->load->view('header',$data);
		$this->load->view('user_list',$data);
		$this->load->view('footer',$data);
	}
	
	function pre_user_list($limit='0',$gid='0',$sid='0'){
		$gid=$this->input->post('gid');
		$sid=$this->input->post('sid');
		redirect('user/index/'.$limit.'/'.$gid.'/'.$sid);
	}

	public function new_user()
	{
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] != '2' && $logged_in['su'] != '3'){
			exit($this->lang->line('permission_denied'));
		}

		$data['logged_in'] =  $logged_in;
		$data['title']=$this->lang->line('add_new').' '.$this->lang->line('user');
		// fetching group list
		if( $logged_in['su'] == '2' || $logged_in['su'] == '3'){
			$data['parent_list']=$this->user_model->parent_list_user($logged_in['gid']);
		}
		else
		{
			$data['parent_list']=$this->user_model->parent_list();
		}
		
		
		$this->load->view('header',$data);
		$this->load->view('new_user',$data);
		$this->load->view('footer',$data);
	}
	
	public function insert_user()
	{

		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] != '2' && $logged_in['su'] != '3'){
			exit($this->lang->line('permission_denied'));
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[savsoft_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
			redirect('user/new_user/');
		}
		else
		{
			$uid = $this->user_model->insert_user();
			if($uid){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('insert_user') . ' ' . $uid);
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

			}
			redirect('user/new_user/');
		} 


	}

	public function remove_user($uid){

		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1'  && $logged_in['su'] != '2' && $logged_in['su'] != '3'){
			exit($this->lang->line('permission_denied'));
		}
		if($uid=='1'){
			exit($this->lang->line('permission_denied'));
		}

		if($this->user_model->remove_user($uid)){
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('remove_user') . ' ' . $uid);
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

		}
		
		redirect('user');


	}

	public function edit_user($uid)
	{
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1'  && $logged_in['su'] != '2' && $logged_in['su'] != '3'){
			$uid=$logged_in['uid'];
		}

		$data['uid']=$uid;
		$data['title']=$this->lang->line('edit').' '.$this->lang->line('user');
		$data['logged_in'] =  $logged_in;
		// fetching user
		$data['result']=$this->user_model->get_user($uid);
		$this->load->model("payment_model");
		$data['payment_history']=$this->payment_model->get_payment_history($uid);
		// fetching group list
		if( $logged_in['su'] == '2' || $logged_in['su'] == '3'){
			$data['parent_list']=$this->user_model->parent_list_user($logged_in['gid']);
		}
		else
		{
			$data['parent_list']=$this->user_model->parent_list();
		}
		$this->load->view('header',$data);
		if($logged_in['su']=='1' || $logged_in['su']=='2'){
			$this->load->view('edit_user',$data);
		}else{
			$this->load->view('myaccount',$data);

		}
		$this->load->view('footer',$data);
	}

	public function update_user($uid)
	{
		
		
		$logged_in=$this->session->userdata('logged_in');

		if($logged_in['su']!='1'  && $logged_in['su'] != '2' && $logged_in['su'] != '3'){
			$uid=$logged_in['uid'];
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
			redirect('user/edit_user/'.$uid);
		}
		else
		{
			if($this->user_model->update_user($uid)){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('update_user') . ' ' . $uid);
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");

			}
			redirect('user/edit_user/'.$uid);
		}       

	}
	
	public function group_list(){
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su'] !='1' && $logged_in['su'] !='2' && $logged_in['su']!='3' ){
			exit($this->lang->line('permission_denied'));
		}
		if( $logged_in['su'] =='2' || $logged_in['su'] =='3'){
			$data['group_list']=$this->user_model->group_list_user($logged_in['gid']);
		}
		else{
			$data['group_list']=$this->user_model->group_list($logged_in);
		}
		
		
		$data['parent_list'] = $this->user_model->parent_list();

		$data['title']=$this->lang->line('group_list');
		$this->load->view('header',$data);
		$this->load->view('group_list',$data);
		$this->load->view('footer',$data);		
	}
	
	
	public function insert_group()
	{
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su']!='3' ){
			exit($this->lang->line('permission_denied'));
		}

		$gid = $this->user_model->insert_group();
		if($gid){
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('insert_group') . ' ' . $gid);
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

		}
		redirect('user/group_list/');

	}
	
	public function update_group($gid)
	{
		
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1'  && $logged_in['su'] != '2' && $logged_in['su'] != '3'){
			exit($this->lang->line('permission_denied'));
		}

		if($this->user_model->update_group($gid)){
			echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('update_group') . ' ' . $gid);
		}else{
			echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";

		}


	}
	
	
	function get_expiry($gid){
		
		echo $this->user_model->get_expiry($gid);
		
	}
	
	
	
	
	public function remove_group($gid){

		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
		} 

		if($this->user_model->remove_group($gid)){
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('remove_group') . ' ' . $gid);
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

		}
		redirect('user/group_list');


	}

	function logout(){
		$logged_in=$this->session->userdata('logged_in');
		
		//echo $this->session->userdata('logged_in')['uid'];//die();
		$this->quiz_model->close_result($this->session->userdata('logged_in')['uid']);

		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('last_page');
		log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' ' . $this->lang->line('logged_out'));

		redirect('login');
		
	}
}
