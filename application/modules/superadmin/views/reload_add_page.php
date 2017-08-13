<section class="content-header">
          <h1>
            Customer Reload
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
                  <h3 class="box-title">Customer Reload</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url();?>superadmin/reload/add_balance/<?php echo $customer_data['customer_id'];?>" method="POST">
                  <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id'];?>" />
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Customer id</label>
                      <input type="text" class="form-control" name="customer_id" value="<?php echo $customer_data['customer_id'];?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Customer name</label>
                      <input type="text" class="form-control" value="<?php echo $customer_data['first_name']." ".$customer_data['last_name'];?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Reload amount (RM)</label>
                      <input type="text" class="form-control" name="amount" placeholder="Enter amount e.g 250.50">
                      <?php echo form_error('amount', '<p class="text-danger">', '</p>'); ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" class="form-control" name="description" placeholder="Enter reload, refund">
                      <?php echo form_error('description', '<p class="text-danger">', '</p>'); ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin </label>
                      <input type="text" class="form-control" value="<?php echo $admin['username']?>" readonly>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a href="<?php echo base_url();?>superadmin/reload" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-primary pull-right" name="submit" value="submit">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->

            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $customer_data['first_name']." ".$customer_data['last_name'];?>'s reload record</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Reload Amount</th>
                      <th>Expire Date</th>
                      <th>Create Date</th>
                      <th>Reload By</th>
                    </tr>
                    <?php foreach ($order as $key => $value) {?>
                      <tr>
                        <td><?php echo $key+1;?></td>
                        <td>RM <?php echo $value['amount'];?></td>
                        <td><?php echo $value['expire_date'];?></td>
                        <td><?php echo $value['create_date'];?></td>
                        <td>
                          <?php 

                          $admin_info = get_admin($value['admin_id']);
                          echo $admin_info['username'];

                          ?>
                        </td>
                      </tr>
                    <?php }?>

                  </tbody>
                </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
              </div><!-- /.box -->
            </div>
            <!-- right column -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->