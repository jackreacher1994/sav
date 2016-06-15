<div class="container">
	<h3><?php echo $title;?></h3>
	<div class="row">
		<div class="col-lg-6">
			<form method="post" action="<?php echo site_url('quiz/assign_user_for_quiz/'.$quid);?>">
	<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>
	 
	  
    </div><!-- /input-group -->
	 </form>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<?php 
			if($this->session->flashdata('message')){
				echo $this->session->flashdata('message');	
			}
			?>
		
		<form method="post" action="<?php echo site_url('quiz/submit_assign_user_for_quiz');?>">
			<table class="table table-bordered">

					<tr>
						<th><center><?php echo $this->lang->line('email');?></center></th>
						<th><center>Full name</center></th>
						<th><center>Group </center></th>
						<th><center>Status </center></th>
						<th><center><?php echo $this->lang->line('action');?> </center></th>
					</tr>
				
			
					<?php foreach($result as $key => $val){
						?>
						<tr>
							<td><center><?php echo $val['email'];?></center></td>
							<td><center><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></center></td>
							<td><center><?php echo $val['group_name'];?> </center></td>
							<td><center><?php echo $val['name_status'];?><center> </td>
							<td><center><input type="checkbox"  id="squaredTwo" name="uids[]" value="<?php echo $val['uid'];?>"></center></td>
						</tr>
						<?php 
					}
					?>
				
			</table>
			<input type="hidden"  name = "quid" value="<?php echo $quid;?>" />
			<button class="btn btn-success" type="submit">Assign</button>
		</form>	
	</div>
</div>
</div>