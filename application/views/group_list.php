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

			<form method="post" action="<?php echo site_url('user/insert_group/');?>">

				<table class="table table-bordered">
					<tr>
						<th><?php echo $this->lang->line('group_name');?></th>
						<th><?php echo $this->lang->line('parent_group');?></th>

						<th><?php echo $this->lang->line('action');?> </th>
					</tr>
					<?php
					if(count($group_list)==0){
						?>
						<tr>
							<td colspan="5"><?php echo $this->lang->line('no_record_found');?></td>
						</tr>


						<?php
					}

					foreach($group_list as $key => $val){
						?>
						<tr>
							<td><input type="text"   class="form-control"  value="<?php echo $val['group_name'];?>" onBlur="updategroup(this.value, null,'<?php echo $val['gid'];?>');" ></td>

							<td>
									<?php
									foreach($parent_list as $parent){
										if($parent['gid'] == $val['parent_id']) {	
										echo $parent['group_name'];
											}
										}
									?>
								
							</td>

							<td>
								<a href="javascript:remove_entry('user/remove_group/<?php echo $val['gid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

							</td>

						</tr>
						<?php
					}?>

					<tr>
						<td><input type="text"   class="form-control"   name="group_name" value="" placeholder="<?php echo $this->lang->line('group_name');?>"  required ></td>

						<td>
							<select class="form-control" name="parent_id">
								<option value="0"><?php echo $this->lang->line('no_parent_group');?></option>
								<?php
								foreach($parent_list as $key => $val){
									?>

									<option value="<?php echo $val['gid'];?>"><?php echo $val['group_name'];?></option>
									<?php
								}
								?>
							</select>
						</td>

						<td>
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('add_new');?></button>
						</td>
					</tr>


				</table>
			</form>
		</div>

	</div>



</div>