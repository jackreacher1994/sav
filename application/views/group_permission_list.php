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
 			<div id="message"></div>

 			<form method="post" action="<?php echo site_url('permission/insert_group_permission/');?>">

 				<table class="table table-bordered">
 					<tr>
 						<th>Group_Permission</th>
 						<th>Description</th>
 						<th><?php echo $this->lang->line('action');?> </th>
 					</tr>
 					<?php 
 					if(count($group_permission_list)==0){
 						?>
 						<tr>
 							<td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
 						</tr>	


 						<?php
 					}

 					foreach($group_permission_list as $key => $val){
 						?>
 						<tr>
 							<td><input type="text"   class="form-control"  value="<?php echo $val['group_permission_name'];?>" onBlur="updatepermission(this.value,'<?php echo $val['gpid'];?>');" ></td>

 							<td><input type="text"   class="form-control"  value="<?php echo $val['description'];?>" onBlur="updatepermission(this.value,'<?php echo $val['gpid'];?>');" ></td>
<td>
	<a href="javascript:remove_entry('permission/remove_group_permission/<?php echo $val['gpid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
</td>
</tr>

<?php 
}
?>
<tr>
	<td>

		<input type="text"   class="form-control"   name="group_permission_name" value="" placeholder="Permission name"  required ></td>
	<td>

		<input type="text"   class="form-control"   name="description" value="" placeholder="description"  required ></td>
	<td>
		<button class="btn btn-default" type="submit"><?php echo $this->lang->line('add_new');?></button>

	</td>
</tr>
</table>
</form>
</div>

</div>



</div>