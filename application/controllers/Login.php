<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model("user_model");
		$this->lang->load('basic', $this->config->item('language'));
		if($this->db->database ==''){
			redirect('install');	
		}	
	}

	public function index()
	{
	
		if($this->session->userdata('logged_in')){
			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']=='1' || $logged_in['su']=='2' || $logged_in['su']=='3'){

				redirect('dashboard');

			}else{
				redirect('quiz');	
			}
			
		}

		$data['title']=$this->lang->line('login');
		$this->load->view('header',$data);
		$this->load->view('login',$data);
		$this->load->view('footer',$data);
		
	}
	


	public function registration()
	
	{
		$data['title']=$this->lang->line('register_new_account');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('register',$data);
		$this->load->view('footer',$data);
	}

	
	public function verifylogin(){
		
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		if($this->user_model->login($username,$password)){
			
			// row exist fetch userdata
			$user=$this->user_model->login($username,$password);

			// validate if user assigned to paid group
			if($user['price'] > '0'){
				
				// user assigned to paid group now validate expiry date.
				if($user['subscription_expired'] <= time()){
					// eubscription expired, redirect to payment page
					
					redirect('payment_gateway/subscription_expired/'.$user['uid']);
					
				}
				
			}
			if($user['sid'] == 2){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>Tài khoản của bạn đã bị vô hiệu hóa </div>");
				redirect('login');
			}
			$user['base_url']=base_url();
			// creating login cookie
			$this->session->set_userdata('logged_in', $user);
			log_message('ved', $this->lang->line('user') . ' ' . $user['uid'] . ' ' . $this->lang->line('logged_in'));
			// redirect to dashboard
			if($user['su']=='1' || $user['su']=='2' || $user['su']=='3'){
				if($this->session->userdata('last_page'))
				{
					redirect($this->session->userdata('last_page'));
				}
				else{
					redirect('dashboard');
				}
				
			}else{
				if($this->session->userdata('last_page'))
				{
					redirect($this->session->userdata('last_page'));
				}
				else{
					redirect('quiz');	}
				}
			}else{

			// invalid login
				$this->session->set_flashdata('message', $this->lang->line('invalid_login'));
				redirect('login');
			}



		}




		
		function verify($vcode){

			if($this->user_model->verify_code($vcode)){
				$data['title']=$this->lang->line('email_verified');
				$this->load->view('header',$data);
				$this->load->view('verify_code',$data);
				$this->load->view('footer',$data);

			}else{
				$data['title']=$this->lang->line('invalid_link');
				$this->load->view('header',$data);
				$this->load->view('verify_code',$data);
				$this->load->view('footer',$data);

			}
		}




		function forgot(){
			if($this->input->post('email')){
				$user_email=$this->input->post('email');
				if($this->user_model->reset_password($user_email)){
					$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('password_updated')." </div>");

				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('email_doesnot_exist')." </div>");

				}
				redirect('login/forgot');
			}
			

			$data['title']=$this->lang->line('forgot_password');
			$this->load->view('header',$data);
			$this->load->view('forgot_password',$data);
			$this->load->view('footer',$data);


		}


		public function insert_user()
		{



			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[savsoft_users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
				redirect('login/registration/');
			}
			else
			{
				if($this->user_model->insert_user_2()){
					if($this->config->item('verify_email')){
						$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('account_registered_email_sent')." </div>");
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('account_registered')." </div>");
					}
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

				}
				redirect('login/registration/');
			}       

		}




		function verify_result($rid){

			$this->load->model("result_model");

			$data['result']=$this->result_model->get_result($rid);
			if($data['result']['gen_certificate']=='0'){
				exit();
			}


			$certificate_text=$data['result']['certificate_text'];
			$certificate_text=str_replace('{email}',$data['result']['email'],$certificate_text);
			$certificate_text=str_replace('{first_name}',$data['result']['first_name'],$certificate_text);
			$certificate_text=str_replace('{last_name}',$data['result']['last_name'],$certificate_text);
			$certificate_text=str_replace('{percentage_obtained}',$data['result']['percentage_obtained'],$certificate_text);
			$certificate_text=str_replace('{score_obtained}',$data['result']['score_obtained'],$certificate_text);
			$certificate_text=str_replace('{quiz_name}',$data['result']['quiz_name'],$certificate_text);
			$certificate_text=str_replace('{status}',$data['result']['result_status'],$certificate_text);
			$certificate_text=str_replace('{result_id}',$data['result']['rid'],$certificate_text);
			$certificate_text=str_replace('{generated_date}',date('Y-m-d',$data['result']['end_time']),$certificate_text);

			$data['certificate_text']=$certificate_text;
			$this->load->view('view_certificate_2',$data);


		}

		public function social($provider_name)
		{
			$this->load->library('oauth/OAuth2');
			$this->load->config('social', TRUE);

			$provider = $this->oauth2->provider($provider_name, array(
				'id' => $this->config->item($provider_name.'_id', 'social'),
				'secret' => $this->config->item($provider_name.'_secret', 'social'),
				));


			if ( ! $this->input->get('code'))
			{
				$provider->authorize();
			}
			else
			{
				try
				{
					$token = $provider->access($this->input->get('code'));

					$user = $provider->get_user_info($token);
				//print_r($user); die;

					if($this->user_model->checkGoogleId($user['uid'])){
						exit('Da co trong db.');
					} else {
						$userdata=array(
							'email'=>$user['email'],
							'password'=>md5('123456'),
							'first_name'=>$user['first_name'],
							'last_name'=>$user['last_name'],
							'google_id'=>$user['uid'],
							'sid'=>0,
							'gid'=>0,
							'su'=>0,
							);

						if($this->user_model->insert_user3($userdata))
							exit('Chua co trong db. Da them.');
					}
				}

				catch (OAuth2_Exception $e)
				{
					show_error($e);
				}

			}
		}

	}
