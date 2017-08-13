
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Food Menu
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url();?>superadmin/foodmenu/add" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="chineseName">Chinese Name</label>
                      <input type="text" class="form-control" id="chineseName" placeholder="姜丝鸡肉" name="chinese_name" value="<?php echo set_value('chinese_name'); ?>">
                      <?php echo form_error('chinese_name', '<span class="help-block error-red">', '</span>'); ?>
                    </div>
                    <div class="form-group">
                      <label for="englishName">English Name</label>
                      <input type="text" class="form-control" id="englishName" placeholder="Ginger Chicken" name="english_name" value="<?php echo set_value('english_name'); ?>">
                      <?php echo form_error('english_name', '<span class="help-block error-red">', '</span>'); ?>
                    </div>
                    <div class="form-group">
                      <label>Food Description</label>
                      <textarea class="form-control" rows="3" placeholder="Cooked with tomato sauce" name="food_desc"></textarea>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="food-status">Status</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="food-status" value="1" <?php echo set_radio('status', '1'); ?>>ON</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="food-status" value="0" <?php echo set_radio('status', '0'); ?>>OFF
                          </label>
                        </div>
                        <?php echo form_error('status', '<span class="help-block error-red">', '</span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="food-type">Food Type</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="type" id="food-type" value="meat" <?php echo set_radio('type', 'meat'); ?>>Meat</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="type" id="food-type" value="vege" <?php echo set_radio('type', 'vege'); ?>>Vege
                          </label>
                        </div>
                        <?php echo form_error('type', '<span class="help-block error-red">', '</span>'); ?>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->