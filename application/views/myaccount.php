 <div class="container">

   
 <h3><?php echo $title;?></h3>
   
 

  <div class="row">
     <form method="post" action="<?php echo site_url('user/update_user/'.$uid);?>">
	
<div class="col-md-8">
<br> 
 <div class="login-panel panel panel-default">
		<div class="panel-body"> 
	
	
	
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		
				<div class="form-group" style="display: none;">
				<?php echo $this->lang->line('group_name');?>: <?php echo $result['group_name'];?>
				</div>
				
				
				<div class="form-group">	 
					<label for="inputEmail"><?php echo $this->lang->line('email_address');?></label>
					<input type="email" id="inputEmail" name="email" value="<?php echo $result['email'];?>" readonly=readonly class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>">
			</div>
			<div class="form-group">	  
					<label for="inputPassword"><?php echo $this->lang->line('password');?></label>
					<input type="password" id="inputPassword" name="password"   value=""  class="form-control" placeholder="<?php echo $this->lang->line('password');?>"   >
			 </div>
				<div class="form-group">	 
					<label for="inputEmail"><?php echo $this->lang->line('first_name');?></label>
					<input type="text"  name="first_name"  class="form-control"  value="<?php echo $result['first_name'];?>"  placeholder="<?php echo $this->lang->line('first_name');?>" >
			</div>
				<div class="form-group">	 
					<label for="inputEmail"><?php echo $this->lang->line('last_name');?></label>
					<input type="text"   name="last_name"  class="form-control"  value="<?php echo $result['last_name'];?>"  placeholder="<?php echo $this->lang->line('last_name');?>" >
			</div>
				<div class="form-group">	 
					<label for="inputEmail"><?php echo $this->lang->line('contact_no');?></label>
					<input type="text" name="contact_no"  class="form-control"  value="<?php echo $result['contact_no'];?>"  placeholder="<?php echo $this->lang->line('contact_no');?>" >
			</div>

			<div class="form-group">
				<label   ><?php echo $this->lang->line('group');?></label>
				<input type="text" value="<?php echo $result['group_name'];?>" readonly=readonly class="form-control">
				<input type="hidden" name="gid" value="<?php echo $result['gid'];?>" >
			</div>

			<div class="form-group">
				<label   ><?php echo $this->lang->line('account_type');?></label>
				<input type="text" value="<?php if($result['su']==0) { echo $this->lang->line('examinator'); } ?>" readonly=readonly class="form-control">
				<input type="hidden" name="su" value="<?php echo $result['su'];?>" >
			</div>

			<div class="form-group">
				<label   ><?php echo $this->lang->line('status');?></label>
				<input type="text" value="<?php if($result['sid']==1) { echo $this->lang->line('active'); } else { echo $this->lang->line('inactive'); }?>" readonly=readonly class="form-control">
				<input type="hidden" name="sid" value="<?php echo $result['sid'];?>" ">
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