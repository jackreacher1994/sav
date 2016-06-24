 <div class="container">
<?php 
$logged_in=$this->session->userdata('logged_in');
?>
   
  

<?php 
if($logged_in['su']=='1' || $logged_in['su']=='2' || $logged_in['su']=='3'){
	?>
   <div class="row">
 
  <div class="col-lg-12">
    <form method="post" action="<?php echo site_url('result/generate_report/');?>">
	<div class="input-group">
    <h3><?php echo $this->lang->line('generate_report');?> </h3> 
<select name="quid">
<option value="0"><?php echo $this->lang->line('select_quiz');?></option>
<?php 
foreach($quiz_list as $qk => $quiz){
	?>
	<option value="<?php echo $quiz['quid'];?>"><?php echo $quiz['quiz_name'];?></option>
	<?php 
}
?>
</select>
 	
<select name="gid">
<option value="0"><?php echo $this->lang->line('select_group');?></option>
<?php 
foreach($group_list as $gk => $group){
	?>
	<option value="<?php echo $group['gid'];?>"><?php echo $group['group_name'];?></option>
	<?php 
}
?>
</select>
<input type="text" name="date1" value="" placeholder="<?php echo $this->lang->line('date_from');?>">
 
 <input type="text" name="date2" value="" placeholder="<?php echo $this->lang->line('date_to');?>">

 <button class="btn btn-info" type="submit"><?php echo $this->lang->line('generate_report');?></button>	
    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<?php 
}
?>


<h3><?php echo $title;?></h3>
 
  <div class="row">
 
  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('result/index/');?>">
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
<!--		--><?php //
//		if($logged_in['su']=='1'){
//			?>
<!--				<div class='alert alert-danger'>--><?php //echo $this->lang->line('pending_message_admin');?><!--</div>		-->
<!--		--><?php //
//		}
//		?>
<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('id');?></th>
    <?php
    if($logged_in['su']=='1'){
    ?>
<th><?php echo $this->lang->line('full_name');?></th>
        <?php
    }
    ?>
<th><?php echo $this->lang->line('email');?></th>
<th><?php echo $this->lang->line('start_time');?></th>
<th><?php echo $this->lang->line('end_time');?></th>
<th><?php echo $this->lang->line('execution_time');?></th>
 <th><?php echo $this->lang->line('quiz_name');?></th>
 <th><?php echo $this->lang->line('score_obtained');?></th>
 <th><?php echo $this->lang->line('status');?>
 <select onChange="sort_result('<?php echo $limit;?>',this.value);">
 <option value="0"><?php echo $this->lang->line('all');?></option>
 <option value="<?php echo $this->lang->line('pass');?>" <?php if($status==$this->lang->line('pass')){ echo 'selected'; } ?> ><?php echo $this->lang->line('pass');?></option>
 <option value="<?php echo $this->lang->line('fail');?>" <?php if($status==$this->lang->line('fail')){ echo 'selected'; } ?> ><?php echo $this->lang->line('fail');?></option>
 <option value="<?php echo $this->lang->line('pending');?>" <?php if($status==$this->lang->line('pending')){ echo 'selected'; } ?> ><?php echo $this->lang->line('pending');?></option>
 </select>
 </th>
 <th><?php echo $this->lang->line('percentage_obtained');?></th>
  <th><?php echo $this->lang->line('group');?>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="12"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}

foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['rid'];?></td>
    <?php
    if($logged_in['su']=='1'){
    ?>
<td><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
        <?php
    }
    ?>
<td><?php echo $val['email'];?></td>
<td><?php echo Date('d/m/Y', $val['start_time']).'; '. Date('H:i', $val['start_time']) ?></td>
<td><?php echo Date('d/m/Y', $val['end_time']).'; '. Date('H:i', $val['end_time']) ?></td>
<td><?php echo round(($val['end_time'] - $val['start_time'])/60);?> min</td>
 <td><?php echo $val['quiz_name'];?></td>
 <td><?php echo $val['score_obtained'];?></td>
 <td><?php echo $val['result_status'];?></td>
 <td><?php echo $val['percentage_obtained'];?>%</td>
 <td><?php echo $val['group_name'];?></td>
<td>
<a href="<?php echo site_url('result/view_result/'.$val['rid']);?>" class="btn btn-success" ><?php echo $this->lang->line('view');?> </a>
<?php 
if($logged_in['su']=='1'){
	?>
	<a href="javascript:remove_entry('result/remove_result/<?php echo $val['rid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php 
}
?>
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

<a href="<?php echo site_url('result/index/'.$back.'/'.$status);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('result/index/'.$next.'/'.$status);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>





</div>