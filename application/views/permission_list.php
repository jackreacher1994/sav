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

 			<form method="post" action="<?php echo site_url('permission/insert_permission/');?>">

 				<table class="table table-bordered">
 					<tr>
 						<th>Permission</th>
 						<th>Group_Permission</th>
 						<th>Description</th>
 						<th><?php echo $this->lang->line('action');?> </th>
 					</tr>
 					<?php 
 					if(count($permission_list)==0){
 						?>
 						<tr>
 							<td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
 						</tr>	


 						<?php
 					}

 					foreach($permission_list as $key => $val){
 						?>
 						<tr>
 							<td><input type="text"   class="form-control"  value="<?php echo $val['permission_name'];?>" onBlur="updatepermission(this.value,'<?php echo $val['pid'];?>');" ></td>
 		<?php
 			$this->db->select('savsoft_group_permission.group_permission_name');
 			$this->db->join('savsoft_group_permission', 'savsoft_group_permission.gpid ='.$val['gpid']);
 			$this->db->limit(1);
 			$query=$this->db->get('savsoft_permission');
 			$permission_parent_name = $query->row_array();

 		?>
 <td><?php echo $permission_parent_name['group_permission_name'];?>
</td>
<td><?php echo $val['description'];?></td>
<td>
	<a href="javascript:remove_entry('permission/remove_permission/<?php echo $val['pid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
</td>
</tr>

<?php 
}
?>
<tr>
	<td>

		<input type="text"   class="form-control"   name="permission_name" value="" placeholder="Permission name"  required ></td>
		<td><select name="gpid">
			<option value="0">Select Group Permission</option>
			<?php
			foreach ($permission_group as $key => $val) { 	
				?>

				<option value="<?php echo $val['gpid'];?>" <?php if($val['gpid'] == $sid){ echo 'selected';} ?> ><?php echo $val['group_permission_name'];?></option>
				<?php 
			}
			?>
		</select>
	</td>
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