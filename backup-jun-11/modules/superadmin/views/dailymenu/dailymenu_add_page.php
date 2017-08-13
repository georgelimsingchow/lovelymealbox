        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Menu
            <small>Today is <?php echo date("l Y-m-d");?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Widgets</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                </div><!-- /.box-header -->
				<form role="form" method="post" action="<?php echo base_url();?>superadmin/dailymenu/add">
                  <div class="box-body">
                  <div class="form-group">
                    <label>Pick Date</label>
                    <?php echo form_dropdown('food_date', $select_date,'','class="form-control"');?>
                    <?php echo form_error('food_date', '<span class="help-block error-red">', '</span>'); ?>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <label>Food Menu Option</label>
                    <?php echo form_multiselect('food_menu[]', $select_box,'','id="select_menu" class="form-control select2" data-placeholder="Select an item" style="width:100%"');?>
                    <?php echo form_error('food_menu[]', '<span class="help-block error-red">', '</span>'); ?>
                  </div><!-- /.form-group -->
                      <div class="form-group">
                        <label for="food-status">Status</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="d_menu_status" value="1" <?php echo set_radio('d_menu_status', '1'); ?>>ON</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="d_menu_status" value="0" <?php echo set_radio('d_menu_status', '0'); ?>>OFF
                          </label>
                        </div>
                        <?php echo form_error('d_menu_status', '<span class="help-block error-red">', '</span>'); ?>
                      </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Add</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->
