 <div class="container">


 	<h3><?php echo $title;?></h3>
 	<div class="row">

 		<div class="col-lg-6">
  <form method="post" action="<?php echo site_url('permission/user_assign_permission/');?>">
 			<div class="input-group">
 				<input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
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
 	

 		<table class="table table-bordered">
 			<tr>
 				<th><?php echo $this->lang->line('email');?></th>
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
 					<td>
 						<a href="<?php echo site_url('permission/assign_permission/'.$val['uid']);?>" class="btn btn-success">Assign Permission</a>
 					</td>
 				</tr>

 				<?php 
 			}
 			?>
 		</table>
 	</div>

 </div>







</div>