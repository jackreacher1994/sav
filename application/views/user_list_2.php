<div class="container">
	<h3><?php echo $title;?></h3>
	<div class="row">
		<div class="col-lg-6">
			<form method="post" action="<?php echo site_url('quiz/assign_user_for_quiz/'.$quid);?>">
	<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search_key');?>...">
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
						<th><?php echo $this->lang->line('email');?></th>
						<th><?php echo $this->lang->line('full_name');?></th>
						<th><?php echo $this->lang->line('group');?></th>
						<th><?php echo $this->lang->line('status');?></th>
						<th><?php echo $this->lang->line('action');?> </th>
					</tr>
				
			
					<?php foreach($result as $key => $val){
						?>
						<tr>
							<td><?php echo $val['email'];?></td>
							<td><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
							<td><?php echo $val['group_name'];?> </td>
							<?php
							if($val['sid'] == 1){
								?>
								<td><?php echo $this->lang->line('active');?></td>
								<?php
							} else { ?>
								<td><?php echo $this->lang->line('inactive');?></td>
							<?php	}
							?>
							<td><input type="checkbox"  id="squaredTwo" name="uids[]" value="<?php echo $val['uid'];?>"></td>
						</tr>
						<?php 
					}
					?>
				
			</table>
			<input type="hidden"  name = "quid" value="<?php echo $quid;?>" />
			<button class="btn btn-success" type="submit"><?php echo $this->lang->line('submit');?></button>
		</form>	
	</div>
</div>
</div>