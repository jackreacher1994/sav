 <div class="container">


 	<h3><?php echo $title;?></h3>
 	<div class="row">

 		<div class="col-lg-6">
 			<form method="post" action="<?php echo site_url('user/index/');?>">
 				<div class="input-group">
 					<input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search_key');?>...">
 					<span class="input-group-btn">
 						<button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
 					</span>


 				</div><!-- /input-group -->
 			</form>
 		</div><!-- /.col-lg-6 -->
 	</div><!-- /.row -->


 	<div class="row">

 		<div class="col-md-12">
 			<br> 
 			<?php 
 			if($this->session->flashdata('message')){
 				echo $this->session->flashdata('message');	
 			}
 			?>
 			<div class="form-group">
 				<form method="post" action="<?php echo site_url('user/pre_user_list/'.$limit.'/'.$gid.'/'.$sid);?>">
 					<select   name="gid">
 						
 						<option value="0"><?php echo $this->lang->line('group');?></option>
 						<?php 	
 						foreach($group_list as $key => $val){

 							if($su != 1 ){ 
 								?>
 								<option  value="<?php echo $val['gid'];?>" <?php if($val['gid'] == $gid){ echo 'selected';} ?> ><?php echo $val['group_name'];?></option>
 								<?php 
 							} else {
 								?>
 								<option  value="<?php echo $val['gid'];?>" <?php if($val['gid'] == $gid){ echo 'selected';} ?> ><?php echo $val['group_name'];?></option>
 								<?php }
 							}
 							?>
 						</select>
 						<select   name="sid">
 							<option value="0"><?php echo $this->lang->line('status');?></option>
 							<option value="1"><?php echo $this->lang->line('active');?></option>
 							<option value="2"><?php echo $this->lang->line('inactive');?></option>
 						</select>

 						<button class="btn btn-default" type="submit"><?php echo $this->lang->line('filter');?></button>
 					</form>
 				</div>	

 				<table class="table table-bordered">
 					<tr>
 						<th><?php echo $this->lang->line('email');?></th>
 						<th><?php echo $this->lang->line('full_name');?></th>
 						<th><?php echo $this->lang->line('group');?></th>
 						<th><?php echo $this->lang->line('status');?></th>
 						<th><?php echo $this->lang->line('action');?> </th>
 					</tr>
 					<?php 
 					if(count($result)==0){
 						?>
 						<tr>
 							<td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
 						</tr>	


 						<?php
 					}
 					foreach($result as $key => $val){
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

 							<td>
 								<a href="<?php echo site_url('user/edit_user/'.$val['uid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
 								<a href="javascript:remove_entry('user/remove_user/<?php echo $val['uid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

 							</td>
 						</tr>

 						<?php 
 					}
 					?>
 				</table>
 			</div>

 		</div>


 		<?php
 		if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

 		<a href="<?php echo site_url('user/index/'.$back);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
 		&nbsp;&nbsp;
 		<?php
 		$next=$limit+($this->config->item('number_of_rows'));  ?>

 		<a href="<?php echo site_url('user/index/'.$next);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>





 	</div>