<html lang="en">
<head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title> </title>
	<!-- bootstrap css -->
	<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
	
	<!-- custom css -->
	<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

	<script>
		
		var base_url="<?php echo base_url();?>";

	</script>
	
	<!-- jquery -->
	<script src="<?php echo base_url('js/jquery.js');?>"></script>
	
	<!-- custom javascript -->
	<script src="<?php echo base_url('js/basic.js');?>"></script>
	
	<!-- bootstrap js -->
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>

	<script src="http://code.jquery.com/jquery-1.12.3.js"></script>
	
</head>
<body>
	
	<?php 
	if($this->session->userdata('logged_in')){
		if($this->uri->segment(2)!='attempt'){
			$logged_in=$this->session->userdata('logged_in');
			$array_pid = explode(',', $logged_in['pid']);
			?>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><?php echo $this->lang->line('savsoft_quiz');?></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<?php  
							if($logged_in['su'] == 1 || $logged_in['su'] == 2 || $logged_in['su'] == 3){
								?>
								
								<li <?php if($this->uri->segment(1)=='dashboard'){ echo "class='active'"; } ?> ><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('dashboard');?></a></li>

								
								<li class="dropdown" <?php if($this->uri->segment(1)=='user'){ echo "class='active'"; } ?>>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('users');?> <span class="caret"></span></a>
									
									<ul class="dropdown-menu">
										<?php if(in_array('10', $array_pid)) { ?>
										<li><a href="<?php echo site_url('user/new_user');?>"><?php echo $this->lang->line('add_new');?></a></li>
										<?php } 
										if(in_array('11', $array_pid)) { ?>
										<li><a href="<?php echo site_url('user');?>"><?php echo $this->lang->line('list');?> <?php echo $this->lang->line('users');?> </a></li>
										<?php } 
										if(in_array('14', $array_pid)) { ?>
										
										<li><a href="<?php echo site_url('user/group_list');?>"><?php echo $this->lang->line('group_list');?></a></li>
										<?php }?>
									</ul>
								</li>
								
							
								
								<li class="dropdown" <?php if($this->uri->segment(1)=='qbank'){ echo "class='active'"; } ?> >
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('qbank');?> <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<?php if(in_array('12', $array_pid)) { ?>
										<li><a href="<?php echo site_url('qbank/pre_new_question');?>"><?php echo $this->lang->line('add_new');?></a></li>
										<?php } 
										if(in_array('13', $array_pid)) { ?>
										<li><a href="<?php echo site_url('qbank');?>"><?php echo $this->lang->line('list');?> <?php echo $this->lang->line('question');?> </a></li>
										<?php } 
										if(in_array('16', $array_pid)) { ?>

										<li><a href="<?php echo site_url('qbank/category_list');?>"><?php echo $this->lang->line('category_list');?></a></li>
										<?php } 
										if(in_array('17', $array_pid)) { ?>
										<li><a href="<?php echo site_url('qbank/level_list');?>"><?php echo $this->lang->line('level_list');?></a></li>
										<?php } ?>
									</ul>
								</li>
								
								
								
								<?php 
							}else{
								?>
								<li><a href="<?php echo site_url('user/edit_user/'.$logged_in['uid']);?>"><?php echo $this->lang->line('myaccount');?></a></li>
								<?php 
							}
							?>

							<li class="dropdown" <?php if($this->uri->segment(1)=='qbank'){ echo "class='active'"; } ?> >
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('quiz');?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php if(in_array('18', $array_pid)) { ?>
									<li><a href="<?php echo site_url('quiz/add_new');?>"><?php echo $this->lang->line('add_new');?></a></li>
									<?php } 
									if(in_array('18', $array_pid)) { ?>
									<li><a href="<?php echo site_url('quiz/add_new_quiz');?>"><?php echo $this->lang->line('add_new_with_temp');?></a></li>
									<?php } 
									if(in_array('18', $array_pid)) { ?>
									<li><a href="<?php echo site_url('quiz');?>"><?php echo $this->lang->line('list');?> <?php echo $this->lang->line('quiz');?> </a></li>	
									<?php } ?>
								</ul>
							</li>
							<li><a href="<?php echo site_url('result');?>"><?php echo $this->lang->line('result');?></a></li>

							<?php  
							if($logged_in['su'] ==1 || $logged_in['su']==2 || $logged_in['su']==3){
								?>
								
								<li class="dropdown" <?php if($this->uri->segment(1)=='permission'){ echo "class='active'"; } ?> >
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->lang->line('assign_permission');?> <span class="caret"></span></a>
									<ul class="dropdown-menu">
									<?php if(in_array('21', $array_pid)) { ?>
										<li><a href="<?php echo site_url('permission/permission_list');?>">List permission</a></li>
										<?php } 
									if(in_array('22', $array_pid)) { ?>
										<li><a href="<?php echo site_url('permission/user_assign_permission');?>">Assign Permission</a></li>
										<?php } ?>
									</ul>
								</li>
								
								<?php 
							}
							?>
							<li><a href="<?php echo site_url('user/logout');?>"><?php echo $this->lang->line('logout');?></a></li>
							
							
						</ul>
						
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>

			<?php 
		}
	}
	?>
	