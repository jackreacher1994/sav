<style type="text/css">
	/*  bhoechie tab */
	div.bhoechie-tab-container{
		z-index: 10;
		background-color: #ffffff;
		padding: 0 !important;
		border-radius: 4px;
		-moz-border-radius: 4px;
		border:1px solid #ddd;
		margin-top: 20px;
		margin-left: 50px;
		-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
		box-shadow: 0 6px 12px rgba(0,0,0,.175);
		-moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
		background-clip: padding-box;
		opacity: 0.97;
		filter: alpha(opacity=97);
	}
	div.bhoechie-tab-menu{
		padding-right: 0;
		padding-left: 0;
		padding-bottom: 0;
	}
	div.bhoechie-tab-menu div.list-group{
		margin-bottom: 0;
	}
	div.bhoechie-tab-menu div.list-group>a{
		margin-bottom: 0;
	}
	div.bhoechie-tab-menu div.list-group>a .glyphicon,
	div.bhoechie-tab-menu div.list-group>a .fa {
		color: #5A55A3;
	}
	div.bhoechie-tab-menu div.list-group>a:first-child{
		border-top-right-radius: 0;
		-moz-border-top-right-radius: 0;
	}
	div.bhoechie-tab-menu div.list-group>a:last-child{
		border-bottom-right-radius: 0;
		-moz-border-bottom-right-radius: 0;
	}
	div.bhoechie-tab-menu div.list-group>a.active,
	div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
	div.bhoechie-tab-menu div.list-group>a.active .fa{
		background-color: #5A55A3;
		background-image: #5A55A3;
		color: #ffffff;
	}
	div.bhoechie-tab-menu div.list-group>a.active:after{
		content: '';
		position: absolute;
		left: 100%;
		top: 50%;
		margin-top: -13px;
		border-left: 0;
		border-bottom: 13px solid transparent;
		border-top: 13px solid transparent;
		border-left: 10px solid #5A55A3;
	}

	div.bhoechie-tab-content{
		background-color: #ffffff;
		/* border: 1px solid #eeeeee; */
		padding-left: 20px;
		padding-top: 10px;
	}

	div.bhoechie-tab div.bhoechie-tab-content:not(.active){
		display: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
			e.preventDefault();
			$(this).siblings('a.active').removeClass("active");
			$(this).addClass("active");
			var index = $(this).index();
			$("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
			$("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
		});
	});
</script>



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
			
			<form method="post" action="<?php echo site_url('permission/submit_assign_permission');?>">
				<table class="table table-bordered">
					
					<tr>
						<th>Permission</th>
						<th>Check</th>
					</tr>
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
							<td><?php echo $val['permission_name'];?></td>
							<td><input type="checkbox" name="pid" value="<?php echo $val['pid'];?>"/></td>
						</tr>

						<?php 
					}
					?>
					
				</table>
				<input type="hidden"  name = "uid" value="<?php echo $uid;?>" />
				<button type="submit" class="btn btn-success">Assign Permission</button>
			</form>
		</div>

	</div>







</div>