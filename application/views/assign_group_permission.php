 <div class="container">


 	<h3><?php echo $title;?></h3>



 <div class="row">

 	<div class="col-md-12">
 		<br> 
 		<?php 
 		if($this->session->flashdata('message')){
 			echo $this->session->flashdata('message');	
 		}
 		?>
 	
<form method="post" action="<?php echo site_url('permission/submit_assign_user_for_group_permission');?>">
 		<table class="table table-bordered">
 			<?php 
 			if(count($result)==0){
 				?>
 				<tr>
 					<td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
 				</tr>	


 				<?php
 			}

 			
 			
 			?>

 			<?php foreach($result as $key => $val){
 				?>
 				<tr>
 					<td><?php echo $val['group_permission_name'];?></td>
 					<?php
 						if($check_gpid['gpid'] == $val['gpid']){ ?>
 							<td><input type="checkbox" name="gpid" value="<?php echo $val['gpid'];?>" checked/></td>
 						<?php } else { ?>
 							<td><input type="checkbox" name="gpid" value="<?php echo $val['gpid'];?>"/></td>
 						<?php }
 					?>
 					
 				</tr>

 				<?php 
 			}
 			?>
 			
 		</table>
 		<input type="hidden"  name = "uid" value="<?php echo $uid;?>" />
 		<button type="submit" class="btn btn-success">Assign Group Permission</button>
 		</form>
 	</div>

 </div>







</div>