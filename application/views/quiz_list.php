 <div class="container">
<?php 
$logged_in=$this->session->userdata('logged_in');
			 
			
			?>
   
 <h3><?php echo $title;?></h3>
    <?php 
	if($logged_in['su']=='1'){
		?>
		<div class="row">
 
  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('quiz/index/');?>">
	<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search_key');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>
	 
	  
    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<?php 
	}
?>

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
 <th>#</th>
 <th><?php echo $this->lang->line('quiz_name');?></th>
<th><?php echo $this->lang->line('noq');?></th>
<td><b><?php echo $this->lang->line('status');?></b></td>
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
 <td><?php echo $val['quid'];?></td>
 <td><?php echo substr(strip_tags($val['quiz_name']),0,50);?></td>
<td><?php echo $val['noq'];?></td>
<td>
	<?php 
	if($val['end_date'] < time()){ 
	echo 'Hết hạn';
 	} 
	?>
</td>
 <td>
     
     <?php
     if($val['maximum_attempts'] > $this->quiz_model->count_result($val['quid'],$logged_in['uid'])){
     ?>
<a href="<?php echo site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>
         <?php
     } else {
         ?>
<i><?php echo $this->lang->line('maximum_attempt_invalid');?></i>
         <?php
     }
     ?>
     
<?php 
if($logged_in['su']=='1' || $logged_in['su']=='2' || $logged_in['su']=='3'){
	?>
<a href="<?php echo site_url('quiz/assign_user_for_quiz/'.$val['quid']);?>" class="btn btn-success"><?php echo $this->lang->line('assign_user');?></a>

<a href="<?php echo site_url('quiz/insert_quiz_use_old/'.$val['quid']);?>" class="btn btn-warning">Sử dụng bài kiểm tra này để tạo mới </a>
<a href="<?php echo site_url('quiz/edit_quiz/'.$val['quid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<!-- <a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a> -->
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

<a href="<?php echo site_url('quiz/index/'.$back);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('quiz/index/'.$next);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>





</div>