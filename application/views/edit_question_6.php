<div class="container">


    <h3><?php echo $title;?></h3>



    <div class="row">
        <form method="post" action="<?php echo site_url('qbank/edit_question_6/'.$question['qid']);?>">

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
                            <?php echo $this->lang->line('sort_answer');?>

                        </div>


                        <div class="form-group">
                            <label   ><?php echo $this->lang->line('select_category');?></label>
                            <select class="form-control" name="cid">
                                <?php
                                foreach($category_list as $key => $val){
                                    ?>

                                    <option value="<?php echo $val['cid'];?>"  <?php if($question['cid']==$val['cid']){ echo 'selected'; } ?> ><?php echo $val['category_name'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label  style="display:none;" ><?php echo $this->lang->line('select_level');?></label>
                            <select class="form-control" name="lid" style="display:none;">
                                <?php
                                foreach($level_list as $key => $val){
                                    ?>

                                    <option value="<?php echo $val['lid'];?>" <?php if($question['lid']==$val['lid']){ echo 'selected'; } ?> ><?php echo $val['level_name'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="inputEmail"  ><?php echo $this->lang->line('question');?></label>
                            <textarea  name="question"  class="form-control"   ><?php echo $question['question'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail"  ><?php echo $this->lang->line('description');?></label>
                            <textarea  name="description"  class="form-control"><?php echo $question['description'];?></textarea>
                        </div>

                        <?php
                        foreach($options as $key => $val){
                            ?>
                            <div class="form-group">
                                <label for="inputEmail"  ><?php echo $this->lang->line('options');?> <?php echo $key+1;?>)</label> <br>
                                <textarea  name="option[]"  class="form-control"   ><?php echo $val['q_option'] ?></textarea>
                            </div>
                            <?php
                        }
                        ?>

                        <script>
                            $(function() {
                                $( "#sortable" ).sortable({
                                    placeholder: "ui-sortable-placeholder",
                                    stop: function(event, ui) {
                                        var data = [];

                                        $("#sortable li").each(function(i, el){
                                            data.push($(el).val()+"="+$(el).index());
                                        });

                                        $("input[name='right_order']").val(data);

                                        //alert($("input[name='right_order']").val());
                                    }
                                });
                            });
                        </script>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('right_order');?></label>
                            <ul id="sortable">
                                <?php
                                foreach($options_order as $key => $val) {
                                    foreach ($options as $k => $v) {
                                        if ($val['oid'] == $v['oid']) {
                                        ?>
                                        <li value="<?php echo ($k + 1); ?>"
                                            class="ui-state-default"><?php echo $this->lang->line('options'); ?><?php echo ($k + 1); ?></li>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                            <input type="hidden" name="right_order">
                        </div>


                        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>

                    </div>
                </div>




            </div>
        </form>

        <div class="col-md-3">


            <div class="form-group">
                <table class="table table-bordered">
                    <tr><td><?php echo $this->lang->line('no_times_corrected');?></td><td><?php echo $question['no_time_corrected'];?></td></tr>
                    <tr><td><?php echo $this->lang->line('no_times_incorrected');?></td><td><?php echo $question['no_time_incorrected'];?></td></tr>
                    <tr><td><?php echo $this->lang->line('no_times_unattempted');?></td><td><?php echo $question['no_time_unattempted'];?></td></tr>

                </table>

            </div>


        </div>
    </div>





</div>