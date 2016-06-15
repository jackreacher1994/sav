<div class="container">
	<h3><?php echo $title;?></h3>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<div class="row">
	<div class="col-md-12">
		
	</div>
	<form method="post" action="<?php echo site_url('quiz/submit_assign_user_for_quiz');?>">
	<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th><center><?php echo $this->lang->line('email');?></center></th>
 				<th><center>Full name</center></th>
 				<th><center>Group </center></th>
 				<th><center>Status </center></th>
 				<th><center><?php echo $this->lang->line('action');?> </center></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $key => $val){
 				?>
 				<tr>
 					<td><center><?php echo $val['email'];?></center></td>
 					<td><center><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></center></td>
 					<td><center><?php echo $val['group_name'];?> </center></td>
 					<td><center><?php echo $val['name_status'];?><center> </td>
 					<td><center><input type="checkbox"  name="uids[]" value="<?php echo $val['uid'];?>"></center></td>
 				</tr>
 				<?php 
 			}
 			?>
		</tbody>
	</table>
	<input type="hidden"  name = "quid" value="<?php echo $quid;?>" />
	<button class="btn btn-success" type="submit">Assign</button>
	</form>	
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
	</script>
</div>