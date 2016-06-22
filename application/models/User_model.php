<?php
Class User_model extends CI_Model
{
	function login($username, $password)
	{

		if($password!=$this->config->item('master_password')){
			$this -> db -> where('savsoft_users.password', MD5($password));
		}
		$this -> db -> where('savsoft_users.email', $username);
		$this -> db -> where('savsoft_users.verify_code', '0');
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this->db->limit(1);
		$query = $this -> db -> get('savsoft_users');

		if($query -> num_rows() == 1)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}


	function admin_login()
	{

		$this -> db -> where('uid', '1');
		$query = $this -> db -> get('savsoft_users');


		if($query -> num_rows() == 1)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	function num_users(){

		$query=$this->db->get('savsoft_users');
		return $query->num_rows();
	}

	function num_users_by_group($gid){
		$this->db->where('gid',$gid);
		$query=$this->db->get('savsoft_users');
		return $query->num_rows();
	}



	function user_list($limit,$gid='0',$sid = '0'){

		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->db->or_where('savsoft_users.email',$search);
			$this->db->or_where('savsoft_users.first_name',$search);
			$this->db->or_where('savsoft_users.last_name',$search);
			$this->db->or_where('savsoft_users.contact_no',$search);


		}
		if($gid!='0'){
			$this->db->where('savsoft_users.gid',$gid);
		}
		if($sid!='0'){
			$this->db->where('savsoft_users.sid',$sid);
		}
		//$this->db->where("savsoft_group.parent_id",$gid);
		$this->db->join('savsoft_group', 'savsoft_group.gid = savsoft_users.gid');
		//$this->db->join('savsoft_status', 'savsoft_status.sid = savsoft_users.sid');
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('savsoft_users.uid','desc');
		$query=$this->db->get('savsoft_users');

		return $query->result_array();
	}

	function user_list_su_2($limit,$gid='0',$sid){

		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->db->or_where('savsoft_users.email',$search);
			$this->db->or_where('savsoft_users.first_name',$search);
			$this->db->or_where('savsoft_users.last_name',$search);
			$this->db->or_where('savsoft_users.contact_no',$search);
		}
		if($gid!='0'){
			$this -> db -> where('savsoft_group.parent_id',$gid);
			$query = $this->db->get('savsoft_group');
			$test = $query->result_array();
			//var_dump($test);die();
			//$this->db->where('savsoft_users.gid',$gid);
			for ($i=0; $i < sizeof($test) ; $i++) { 
				$this->db->or_where('savsoft_users.gid',$test[$i]['gid']);
			}
			
			//$this->db->or_where("savsoft_group.parent_id",$gid);
		}
		if($sid!='0'){
			$this->db->where('savsoft_users.sid',$sid);
		}
		
		$this->db->join('savsoft_group', 'savsoft_group.gid = savsoft_users.gid');

		//$this->db->join('savsoft_group')->or_where('savsoft_group.parent_id',$gid);
		
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('savsoft_users.uid','desc');
		$query=$this->db->get('savsoft_users');

		return $query->result_array();
	}

	function user_list_2(){
		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->db->or_where('savsoft_users.email',$search);
			$this->db->or_where('savsoft_users.first_name',$search);
			$this->db->or_where('savsoft_users.last_name',$search);
			$this->db->or_where('savsoft_users.contact_no',$search);


		}
		$this->db->join('savsoft_group', 'savsoft_group.gid = savsoft_users.gid');
		//$this->db->join('savsoft_status', 'savsoft_status.sid = savsoft_users.sid');
		$this->db->order_by('savsoft_users.uid','desc');
		$query=$this->db->get('savsoft_users');

		return $query->result_array();
	}
     	function user_list_3(){
     	$logged_in = $this->session->userdata('logged_in');
		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->db->or_where('savsoft_users.email',$search);
			$this->db->or_where('savsoft_users.first_name',$search);
			$this->db->or_where('savsoft_users.last_name',$search);
			$this->db->or_where('savsoft_users.contact_no',$search);
		}
		$this->db->select('parent_id')->where('savsoft_group.gid',$logged_in['gid']);
		$query2=$this->db->get('savsoft_group');
		$test = $query2->row_array();
		$this->db->where('savsoft_users.uid !=', $logged_in['uid']);
		$this->db->where('parent_id',$test['parent_id']);	
		$this->db->join('savsoft_group', 'savsoft_group.gid = savsoft_users.gid');	
		$this->db->order_by('savsoft_users.uid','desc');   	
		$query=$this->db->get('savsoft_users');
		
		return $query->result_array();
	}  
        
	function group_list($logged=NULL){
 		//$this->db->join('savsoft_office','savsoft_office.id = savsoft_group.oid');
                if(empty($logged))
                {
                    $logged=$this->session->userdata('logged_in');
                }
                $result = array();
                switch($logged['su'])
                {
                    case 1:
                        $this->db->where('parent_id', '');
                        $this->db->order_by('gid','desc');
                        $this->db->get('savsoft_group');
                        break;
                    case 2:
                    	
                    case 3:
                        $group = $logged['gid'];
                        $this->db->where('parent_id', $group);
                        $this->db->order_by('gid','desc');
                        break;
                    default:
                        break;
                }
		$query=$this->db->get('savsoft_group');
                $result = $query->result_array();
		return $result;
	}

		


	function group_list_user($gid){
		$this->db->where('gid',$gid);
		$query=$this->db->get('savsoft_group');
		$result = $query->row_array();
		$this->db->where('parent_id',$result['parent_id']);
		$query2=$this->db->get('savsoft_group');
		return $query2->result_array();
	}

	function parent_list(){
		$this->db->where('parent_id',0);
		$this->db->order_by('gid','desc');
		$query=$this->db->get('savsoft_group');
		return $query->result_array();
	}

	function num_child($gid){
		return $this->db->where('parent_id',$gid)->count_all_results('savsoft_group');	
	}

	function child_list($gid){



		$this->db->where('parent_id',$gid);
		$this->db->order_by('gid','desc');
		$query=$this->db->get('savsoft_group');


		return $query->result_array();
	}


	function verify_code($vcode){
		$this->db->where('verify_code',$vcode);
		$query=$this->db->get('savsoft_users');
		if($query->num_rows()=='1'){
			$user=$query->row_array();
			$uid=$user['uid'];
			$userdata=array(
				'verify_code'=>'0'
				);
			$this->db->where('uid',$uid);
			$this->db->update('savsoft_users',$userdata);
			return true;
		}else{
			
			return false;
		}


	}


	function insert_user(){
		$logged_in=$this->session->userdata('logged_in');

		$userdata=array(
			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'contact_no'=>$this->input->post('contact_no'),
			'gid'=>$this->input->post('gid'),

			'subscription_expired'=>strtotime($this->input->post('subscription_expired')),
			'su'=>$this->input->post('su'),
			'sid'=>$this->input->post('sid'),
			
			);

		if($this->input->post('su') == 1){
			$userdata['gid'] = 0;
		}

		if($this->input->post('su') == 3){
			$userdata['gid'] = $logged_in['gid'];
		}

		if($this->db->insert('savsoft_users',$userdata)){
			
			//return true;
			return $this->db->insert_id();
		}else{
			
			return false;
		}

	}

	function insert_user_2(){

		$userdata=array(
			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'contact_no'=>$this->input->post('contact_no'),
			'gid'=>$this->input->post('gid'),
			'su'=>'0'		
			);
		$veri_code=rand('1111','9999');
		if($this->config->item('verify_email')){
			$userdata['verify_code']=$veri_code;
		}

		if($this->db->insert('savsoft_users',$userdata)){
			if($this->config->item('verify_email')){
				 // send verification link in email

				$verilink=site_url('login/verify/'.$veri_code);
				$this->load->library('email');

				if($this->config->item('protocol')=="smtp"){
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = $this->config->item('smtp_hostname');
					$config['smtp_user'] = $this->config->item('smtp_username');
					$config['smtp_pass'] = $this->config->item('smtp_password');
					$config['smtp_port'] = $this->config->item('smtp_port');
					$config['smtp_timeout'] = $this->config->item('smtp_timeout');
					$config['mailtype'] = $this->config->item('smtp_mailtype');
					$config['starttls']  = $this->config->item('starttls');
					$config['newline']  = $this->config->item('newline');

					$this->email->initialize($config);
				}
				$fromemail=$this->config->item('fromemail');
				$fromname=$this->config->item('fromname');
				$subject=$this->config->item('activation_subject');
				$message=$this->config->item('activation_message');;

				$message=str_replace('[verilink]',$verilink,$message);

				$toemail=$this->input->post('email');

				$this->email->to($toemail);
				$this->email->from($fromemail, $fromname);
				$this->email->subject($subject);
				$this->email->message($message);
				if(!$this->email->send()){
					print_r($this->email->print_debugger());
					exit;
				}


			}

			return true;
		}else{
			
			return false;
		}

	}


	function insert_user3($userdata){
		
		if($this->db->insert('savsoft_users',$userdata)){

			return true;
		}else{

			return false;
		}

	}




	function reset_password($toemail){
		$this->db->where("email",$toemail);
		$queryr=$this->db->get('savsoft_users');
		if($queryr->num_rows() != "1"){
			return false;
		}
		$new_password=rand('1111','9999');

		$this->load->library('email');

		if($this->config->item('protocol')=="smtp"){
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $this->config->item('smtp_hostname');
			$config['smtp_user'] = $this->config->item('smtp_username');
			$config['smtp_pass'] = $this->config->item('smtp_password');
			$config['smtp_port'] = $this->config->item('smtp_port');
			$config['smtp_timeout'] = $this->config->item('smtp_timeout');
			$config['mailtype'] = $this->config->item('smtp_mailtype');
			$config['starttls']  = $this->config->item('starttls');
			$config['newline']  = $this->config->item('newline');
			
			$this->email->initialize($config);
		}
		$fromemail=$this->config->item('fromemail');
		$fromname=$this->config->item('fromname');
		$subject=$this->config->item('password_subject');
		$message=$this->config->item('password_message');;

		$message=str_replace('[new_password]',$new_password,$message);
		
		

		$this->email->to($toemail);
		$this->email->from($fromemail, $fromname);
		$this->email->subject($subject);
		$this->email->message($message);
		if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
			
		}else{
			$user_detail=array(
				'password'=>md5($new_password)
				);
			$this->db->where('email', $toemail);
			$this->db->update('savsoft_users',$user_detail);
			return true;
		}

	}

	function user_list_group($id_gr){
		$this->db->select('email')->where('gid',$id_gr)->where('sid',1);
		$query=$this->db->get('savsoft_users');
		return $query->result_array();
	}

	function update_user($uid){
		$logged_in=$this->session->userdata('logged_in');


		$userdata=array(
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'contact_no'=>$this->input->post('contact_no')	
			);
		if($logged_in['su']=='1'){
			$userdata['email']=$this->input->post('email');
			$userdata['gid']=$this->input->post('gid');
			if($this->input->post('subscription_expired') !='0'){
				$userdata['subscription_expired']=strtotime($this->input->post('subscription_expired'));
			}else{
				$userdata['subscription_expired']='0';	
			}
			$userdata['su']=$this->input->post('su');
			$userdata['sid']=$this->input->post('sid');
		}

		if($this->input->post('password')!=""){
			$userdata['password']=md5($this->input->post('password'));
		}
		$this->db->where('uid',$uid);
		if($this->db->update('savsoft_users',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}

	function update_group($gid){

		$userdata=array();
		if($this->input->post('group_name')){
			$userdata['group_name']=$this->input->post('group_name');
		}
		if($this->input->post('parent_id') != null){
			$userdata['parent_id']=$this->input->post('parent_id');
		}
		if($this->input->post('price')){
			$userdata['price']=$this->input->post('price');
		}
		if($this->input->post('valid_day')){
			$userdata['valid_for_days']=$this->input->post('valid_day');
		}
		$this->db->where('gid',$gid);
		if($this->db->update('savsoft_group',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}


	function remove_user($uid){

		$this->db->where('uid',$uid);
		if($this->db->delete('savsoft_users')){
			
			return true;
		}else{
			
			return false;
		}


	}


	function remove_group($gid){
		if($this->db->where('parent_id',$gid)->count_all_results('savsoft_group')){
			return false;
		}

		$this->db->where('gid',$gid);
		if($this->db->delete('savsoft_group')){
			
			return true;
		}else{

			return false;
		}


	}



	function get_user($uid){

		$this->db->where('savsoft_users.uid',$uid);
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
		return $query->row_array();

	}



	function insert_group(){
		if($this->input->post('group_name')){
			$userdata['group_name']=$this->input->post('group_name');
		}
		if($this->input->post('parent_id') != null){
			$userdata['parent_id']=$this->input->post('parent_id');
		}
		
		if($this->db->insert('savsoft_group',$userdata)){
			
			//return true;
			return $this->db->insert_id();
		}else{
			
			return false;
		}

	}


	function get_expiry($gid){

		$this->db->where('gid',$gid);
		$query=$this->db->get('savsoft_group');
		$gr=$query->row_array();
		if($gr['valid_for_days']!='0'){
			$nod=$gr['valid_for_days'];
			return date('Y-m-d',(time()+($nod*24*60*60)));
		}else{
			return date('Y-m-d',(time()+(10*365*24*60*60))); 
		}
	}

	function get_email_user($uid){
		$this->db->select('email');
		$this->db->where('savsoft_users.uid',$uid);
		$query=$this->db->get('savsoft_users');
		return $query->row_array();
	}

	function checkGoogleId($id){
		$this->db->where('google_id',$id);
		$query=$this->db->get('savsoft_users');
		if($query->num_rows())
			return true;
		else
			return false;
	}


}












?>