 <div class="container">

   
 <h3><?php echo $title;?></h3>
   
 

  <div class="row">
     <form method="post" action="<?php echo site_url('user/insert_user/');?>">
	
<div class="col-md-8">
<br> 
 <div class="login-panel panel panel-default">
		<div class="panel-body"> 
	
	
	
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		
		
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label> 
					<input type="email" id="inputEmail" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
			</div>
			<div class="form-group">	  
					<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
					<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="<?php echo $this->lang->line('password');?>" required >
			 </div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('first_name');?></label> 
					<input type="text"  name="first_name"  class="form-control" placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
			</div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label> 
					<input type="text"   name="last_name"  class="form-control" placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
			</div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label> 
					<input type="text" name="contact_no"  class="form-control" placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
			</div>
				<div class="form-group" id="selectGroup">
					<label   ><?php echo $this->lang->line('select_group');?></label> 
					<select class="form-control" name="gid" id="gid" onChange="getexpiry();">
					<?php 
					foreach($parent_list as $parent){
						?>
						<option value="<?php echo $parent['gid'];?>"><?php echo $parent['group_name'];?></option>
						<?php
						if($this->user_model->num_child($parent['gid'])) {
							$child_list = $this->user_model->child_list($parent['gid']);
							foreach ($child_list as $child) {
								?>
								<option value="<?php echo $child['gid']; ?>">
									<?php echo '&nbsp;&nbsp;&nbsp;'.$child['group_name']; ?></option>
								<?php
							}
						}
					}
					?>
					</select>
			</div>
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('subscription_expired');?></label> 
					<input type="text" name="subscription_expired"  id="subscription_expired" class="form-control" placeholder="<?php echo $this->lang->line('subscription_expired');?>"    autofocus>
			</div>

				<div class="form-group">	 
					<label   ><?php echo $this->lang->line('account_type');?></label> 
					<select class="form-control" name="su" id="su" onchange="change_account_type(this.value)">
					<?php
						if($logged_in['su'] == 1){ ?>
							<option value="1"><?php echo $this->lang->line('super_administrator');?></option>
							<?php } 
					?>
						
						<option value="2"><?php echo $this->lang->line('group_administrator');?></option>
						<option value="3"><?php echo $this->lang->line('administrator');?></option>
						<option value="0"><?php echo $this->lang->line('user');?></option>
					</select>
			</div>
			<div class="form-group">	 
					<label   >Status</label> 
					<select class="form-control" name="sid">
						<option value="1">Active</option>
						<option value="2">Inactive></option>
					</select>
			</div>
 
	<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
 
		</div>
</div>
 
 
 
 
</div>
      </form>
</div>

 



</div>
<script>
	$(document).ready(function(){
		var su = $("#su").val();
		if(su == 1){
			$("#selectGroup").hide();
		} else if(su == 2) {
			$("#selectGroup").show();
		} else if(su == 3) {
			$("#selectGroup").hide();
		} else {
			$("#selectGroup").show();
		}
	});
getexpiry();
</script>