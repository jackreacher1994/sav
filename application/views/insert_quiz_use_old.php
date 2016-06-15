 <div class="container">


 	<h3><?php echo $title;?></h3>


 	<div class="row">
 
 		<form method="post" action="<?php echo site_url('quiz/insert_quiz/');?>">

 			<div class="col-md-8">
 				<br> 
 				<div class="login-panel panel panel-default">
 					<div class="panel-body"> 



 						<?php 
 						if($this->session->flashdata('message')){
 							echo $this->session->flashdata('message');	
 						}
 						?>	


 						<div class="form-group">	 
 							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('quiz_name');?></label> 
 							<input type="text"  name="quiz_name" value="<?php echo $quiz['quiz_name'];?>" class="form-control" placeholder="<?php echo $this->lang->line('quiz_name');?>"  required autofocus>
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('description');?></label> 
 							<textarea   name="description"  class="form-control tinymce_textarea" ><?php echo $quiz['description'];?></textarea>
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('start_date');?></label> 
 							<input type="text" name="start_date"  value="<?php echo date('Y-m-d H:i:s',$quiz['start_date']);?>" class="form-control" placeholder="<?php echo $this->lang->line('start_date');?>"   required >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('end_date');?></label> 
 							<input type="text" name="end_date"  value="<?php echo date('Y-m-d H:i:s',$quiz['end_date']);?>" class="form-control" placeholder="<?php echo $this->lang->line('end_date');?>"   required >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('duration');?></label> 
 							<input type="text" name="duration"  value="<?php echo $quiz['duration'];?>" class="form-control" placeholder="<?php echo $this->lang->line('duration');?>"  required  >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"><?php echo $this->lang->line('maximum_attempts');?></label> 
 							<input type="text" name="maximum_attempts"  value="<?php echo $quiz['maximum_attempts'];?>" class="form-control" placeholder="<?php echo $this->lang->line('maximum_attempts');?>"   required >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('pass_percentage');?></label> 
 							<input type="text" name="pass_percentage" value="<?php echo $quiz['pass_percentage'];?>" class="form-control" placeholder="<?php echo $this->lang->line('pass_percentage');?>"   required >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('correct_score');?></label> 
 							<input type="text" name="correct_score" value="<?php echo $quiz['correct_score'];?>" class="form-control" placeholder="<?php echo $this->lang->line('correct_score');?>"   required >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('incorrect_score');?></label> 
 							<input type="text" name="incorrect_score"  value="<?php echo $quiz['incorrect_score'];?>" class="form-control" placeholder="<?php echo $this->lang->line('incorrect_score');?>"  required  >
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('form_email');?></label><br>
 							<textarea id="form_email" name="form_email" rows="10" cols="101" class="form-control"><?php echo $quiz['form_email'];?></textarea>
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail" ><?php echo $this->lang->line('view_answer');?></label> <br>
 							<input type="radio" name="view_answer"    value="1" <?php if($quiz['view_answer']==1){ echo 'checked'; } ?>  > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
 							<input type="radio" name="view_answer"    value="0"   <?php if($quiz['view_answer']==0){ echo 'checked'; } ?>  > <?php echo $this->lang->line('no');?>
 						</div>
 						<?php 
 						if($this->config->item('webcam')==true){
 							?>
 							<div class="form-group">	 
 								<label for="inputEmail" ><?php echo $this->lang->line('capture_photo');?></label> <br>
 								<input type="radio" name="camera_req"    value="1"  > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
 								<input type="radio" name="camera_req"    value="0"  checked > <?php echo $this->lang->line('no');?>
 							</div>
 							<?php 
 						}else{
 							?>
 							<input type="hidden" name="camera_req" value="0">

 							<?php 
 						}
 						?>
 						<div class="form-group">	 
 							<label   ><?php echo $this->lang->line('select_group');?></label> <br>
 							<?php 
 							foreach($group_list as $key => $val){
 								?>

 								<input type="checkbox" name="gids[]" value="<?php echo $val['gid'];?>" <?php if(in_array($val['gid'],explode(',',$quiz['gids']))){ echo 'checked'; } ?> > <?php echo $val['group_name'];?> &nbsp;&nbsp;&nbsp;
 								<?php 
 							}
 							?>

 						</div>

 						<div class="form-group">	 
 							<label for="inputEmail" ><?php echo $this->lang->line('question_selection');?></label> <br>
 							<input type="radio" name="question_selection"    value="1"  > <?php echo $this->lang->line('automatically');?><br>
 							<input type="radio" name="question_selection"    value="0"  checked > <?php echo $this->lang->line('manually');?>
 						</div>
 						<div class="form-group">	 
 							<label for="inputEmail" ><?php echo $this->lang->line('generate_certificate');?></label> <br>
 							<input type="radio" name="gen_certificate"    value="1"   <?php if($quiz['gen_certificate']==1){ echo 'checked'; } ?> > <?php echo $this->lang->line('yes');?><br>
 							<input type="radio" name="gen_certificate"    value="0"    <?php if($quiz['gen_certificate']==0){ echo 'checked'; } ?> > <?php echo $this->lang->line('no');?>
 						</div>

 						<div class="form-group">	 
 							<label for="inputEmail"  ><?php echo $this->lang->line('certificate_text');?></label> 
 							<textarea   name="certificate_text"  class="form-control" style="height:250px;"><?php echo $quiz['certificate_text'];?></textarea><br>
 							<?php echo $this->lang->line('tags_use');?> <?php echo htmlentities("<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>  <h3></h3>  <font></font>");?><br>
 							{email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained}, {score_obtained}, {result}, {generated_date}, {result_id}, {qr_code}

 							<br><br>
 							<a href="<?php echo site_url('result/preview_certificate/'.$quiz['quid']);?>" target="preview_cert" class="btn btn-warning"><?php echo $this->lang->line('preview');?></a>

 							<span style="color:#ff0000"><?php echo $this->lang->line('preview_warning');?></span>
 						</div>


 						<button class="btn btn-success" type="submit"><?php echo $this->lang->line('next');?></button>

 					</div>
 				</div>




 			</div>
 		</form>
 	</div>





 </div>