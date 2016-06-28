<?php 
Class Permission_model extends CI_Model{

// group_permission_list

	function group_permission_list(){
		$this->db->where('parent_id','0');
		$this->db->order_by('id','desc');
		$query=$this->db->get('savsoft_permission');
		return $query->result_array();
	}

	function check_permission($uid){
			$this->db->select('pid');
		$this->db->where('uid',$uid);
		$query = $this->db->get('savsoft_users');
		$result= $query->row_array();
		$array_pid = explode(',', $result['pid']);
	
		return $array_pid ;
	}
	function insert_group_permission(){

		$userdata=array(
			'group_permission_name'=>$this->input->post('group_permission_name'),
			'description' => $this->input->post('description')
			);
		
		if($this->db->insert('savsoft_group_permission',$userdata)){
			
			//return true;
			return $this->db->insert_id();
		}else{
			
			return false;
		}

	}

	function update_group_permission($gpid){

		$userdata=array(
			'group_permission_name'=>$this->input->post('group_permission_name'),
			'description' => $this->input->post('description')
			);

		$this->db->where('gpid',$gpid);
		if($this->db->update('savsoft_group_permission',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}



	function remove_group_permission($gpid){

		$this->db->where('gpid',$gpid);
		if($this->db->delete('savsoft_group_permission')){
			return true;
		}else{

			return false;
		}


	}

	public function submit_assign_user_for_group_permission($uid){

		$userdata=array(	 
			'gpid'=> $this->input->post('gpid'),
			'pid' => '0'
			);

		$this->db->where('uid',$uid);
		$this->db->update('savsoft_users',$userdata);

		return $uid;
	}







	// permission
	function permission_list(){
		$this->db->where('parent_id != ','0');
		$this->db->order_by('id','desc');
		$query=$this->db->get('savsoft_permission');
		return $query->result_array();

	}

	function permission_list_2(){
		$this->db->where('parent_id != ','0');
		$this->db->where('id != ','21');
		$this->db->order_by('id','desc');
		$query=$this->db->get('savsoft_permission');
		return $query->result_array();

	}

	function permission_parent_list(){
		$this->db->where('parent_id',0);
		$this->db->order_by('pid','desc');
		$query=$this->db->get('savsoft_permission');
		return $query->result_array();

	}

	function insert_permission(){

		$userdata=array(
			'permission_name'=> $this->input->post('permission_name'),
			'parent_id' => $this->input->post('parent_id'),
			'description' => $this->input->post('description')
			);
		
		if($this->db->insert('savsoft_permission',$userdata)){
			
			//return true;
			return $this->db->insert_id();
		}else{
			
			return false;
		}

	}
	function update_permission($pid){

		$userdata=array(
			'permission_name'=>$this->input->post('permission_name'),
			'description' => $this->input->post('description')
			);

		$this->db->where('id',$pid);
		if($this->db->update('savsoft_permission',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}



	function remove_permission($pid){

		$this->db->where('id',$pid);
		if($this->db->delete('savsoft_permission')){
			return true;
		}else{

			return false;
		}


	}

	function submit_assign_permission($uid){

		$userdata=array(	 
			 'pid'=>implode(',',$this->input->post('pids'))
			);

		$this->db->where('uid',$uid);
		$this->db->update('savsoft_users',$userdata);

		return $uid;
	}

}
?>