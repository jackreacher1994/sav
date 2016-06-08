<div class="container">


    <h3><?php echo $title;?></h3>



    <div class="row">
        <form method="post" action="<?php echo site_url('qbank/new_question_6/'.$nop);?>">

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

                                    <option value="<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>


                    <div class="form-group">
                            <label style="display:none;"  ><?php echo $this->lang->line('select_level');?></label>
                            <select class="form-control" name="lid" style="display:none;">
                                <?php
                                foreach($level_list as $key => $val){
                                    ?>

                                    <option value="<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div> 



                        <div class="form-group">
                            <label for="inputEmail"  ><?php echo $this->lang->line('question');?></label>
                            <textarea  name="question"  class="form-control"   ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail"  ><?php echo $this->lang->line('description');?></label>
                            <textarea  name="description"  class="form-control"></textarea>
                        </div>
                        <?php
                        for($i=1; $i<=$nop; $i++){
                            ?>
                            <div class="form-group">
                                <label for="inputEmail"  ><?php echo $this->lang->line('options');?> <?php echo $i;?>)</label> <br>
                                <br><textarea  name="option[]"  class="form-control"   ></textarea>
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
                            <ul id="sortable" class="list-group" style="list-style: none;">
                                <?php
                                for($i=1; $i<=$nop; $i++){
                                    ?>
                                    <li value="<?php echo $i; ?>" class="ui-state-default list-group-item"><?php echo $this->lang->line('options');?> <?php echo $i;?></li>
                                    <?php
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
    </div>





</div>