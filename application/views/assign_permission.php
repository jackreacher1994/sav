

  <div class="container">
    <div class="panel-group" id="accordion">
       <form method="post" action="<?php echo site_url('permission/submit_assign_permission/');?>">
      <?php
      foreach ($group_permission_list as $key => $val) { ?>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $val['id']?>"><?php echo $val['permission_name'];?></a>
          </h4>
        </div>
        <div id="<?php echo $val['id']?>" class="panel-collapse collapse ">
          <div class="panel-body">
         
            <table class="table table-bordered">

              <?php 
              if(count($result)==0){
                ?>
                <tr>
                  <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
                </tr> 
                <?php
              }
              $this->db->where('parent_id',$val['id']);
              $this->db->order_by('savsoft_permission.id','desc');
              $query = $this->db->get('savsoft_permission');
              $result2 = $query -> result_array();
           
              foreach($result2 as $key => $val2){
                ?>
                <tr>
                <td><?php echo $val2['permission_name'];?></td>
                <td>
                <?php
                if(in_array($val2['id'], $check_pid)) {
                 ?>
                  <input class="1" type="checkbox" name="pids[]" value="<?php echo $val2['id'];?>" checked/>
                 <?php 
                } else {
                  ?>
                  <input class="2" type="checkbox" name="pids[]" value="<?php echo $val2['id'];?>"/>
                  <?php
                }
                ?>
                </td>
                </tr>
                <input type="hidden" value="<?php ?>" />
                <?php } ?>
            </table>

           
          </div>
        </div>
      </div>
     <?php } ?>
     <br>
     <input type="hidden" name = 'uid' value="<?php echo $uid;?>" />
      <button type="submit" class="btn btn-success"><?php echo $this->lang->line('submit');?></button>
            </form>

    </div>
  </div>

