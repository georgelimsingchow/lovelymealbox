<section class="content-header">
          <h1>
            Add Catering
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>
<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
      </div><!-- /.box-header -->
        <form role="form" action="<?php echo base_url("superadmin/monthly_cater/add_cater");?>" method="post" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label  class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" placeholder="John Doe" name="name" value="<?php echo set_value('name'); ?>">
              <?php echo form_error('name', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" placeholder="60189966523" name="phone">
              <?php echo form_error('phone', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Customer Id</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" placeholder="default is 0" name="customer_id">
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Address</label>
            <div class="col-sm-4">
              <textarea class="form-control" rows="3" placeholder="289d lot 3178 jalan kedandi tabuan dusun 93350" name="address"></textarea>
              <?php echo form_error('address', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Area</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" placeholder="Kenyalang" name="area">
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
        <a href="<?php echo base_url('superadmin/monthly_cater');?>" class="btn btn-danger">Back</a>
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        </div>
      </form>
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
</section>