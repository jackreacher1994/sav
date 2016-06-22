<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Permission extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("permission_model");
		$this->load->model("user_model");
		$this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('login');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('login');
		}
	}


//permission
	public function permission_list(){
	 	// fetching group list
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su'] !='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3'){
			exit($this->lang->line('permission_denied'));
		}
		$data['permission_list']=$this->permission_model->permission_list();
		$data['permission_group']= $this->permission_model->group_permission_list();
		$data['title']='List Permission';
		$this->load->view('header',$data);
		$this->load->view('permission_list',$data);
		$this->load->view('footer',$data);
	}

	public function insert_permission(){
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3' ){
			exit($this->lang->line('permission_denied'));
		}
		$pid = $this->permission_model->insert_permission();
		if($pid){
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' insert permission ' . $pid);
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

		}
		redirect('permission/permission_list/');
	}

	public function update_permission($pid)
	{
		
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3'){
			exit($this->lang->line('permission_denied'));
		}

		if($this->permission_model->update_permission($pid)){
			echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' update permission ' . $pid);
		}else{
			echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";

		}


	}
	public function remove_permission($pid){

		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3'){
			exit($this->lang->line('permission_denied'));
		} 

		if($this->permission_model->remove_permission($pid)){
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
			log_message('ved', $this->lang->line('user') . ' ' . $logged_in['uid'] . ' remove permission ' . $pid);		
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

		}
		redirect('permission/permission_list');


	}

	public function user_assign_permission(){
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3'){
			exit($this->lang->line('permission_denied'));
		} 
		$data['title']='Assign User Permission';
		if($logged_in['su'] == 2 || $logged_in['su'] == 3){
			$data['result']=$this->user_model->user_list_3();
		}
		else {
			$data['result']=$this->user_model->user_list_2();
		}

		
		$this->load->view('header',$data);
		$this->load->view('user_list_assign.php',$data);
		$this->load->view('footer',$data);
	}

	public function assign_permission($uid){

		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3'){
			exit($this->lang->line('permission_denied'));
		} 
		$data['title']='Assign Permission';
		$data['check_pid'] = $this->permission_model->check_permission($uid);

		$data['uid'] = $uid;
		$data['group_permission_list']=$this->permission_model->group_permission_list();
		$data['result']=$this->permission_model->permission_list();
		
		
		$this->load->view('header',$data);
		$this->load->view('assign_permission.php',$data);
		$this->load->view('footer',$data);
	}

	public function submit_assign_permission(){
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1' && $logged_in['su'] !='2' && $logged_in['su'] !='3'){
			exit($this->lang->line('permission_denied'));
		} 
		//$quid =$this->input->post('quid');
		$uid =$this->input->post('uid');

		if($this->permission_model->submit_assign_permission($uid)){

			$this->session->set_flashdata('message', "<div class='alert alert-success'>Assign Sucsessfully </div>");
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>Assign Unsucsessfully </div>");

		}
		redirect('/permission/user_assign_permission');
	}
}
?>