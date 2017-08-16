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
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $customer_reload;?></h3>
                  <p>Total Reload</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?= $customer_real_reload;?></h3>
                  <p>Total Real Reload</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?= $customer_used;?></h3>
                  <p>Total Used</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>0</h3>
                  <p>Dummy</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Customer Reload</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url();?>superadmin/reload/add_balance?customer_id=<?= $customer_data['customer_id'];?>" method="POST">
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
                  <h3 class="box-title">
                      <?= $customer_data['first_name']." ".$customer_data['last_name'];?>'s reload record
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach ($order as $key => $v) {?>
                      <tr>
                        <td><?= $key+1;?></td>
                        <td>
                          Reload : <?= $v['amount'];?><br>
                          Actual :  <?= $v['real_amount'];?>
                          </td>
                        <td><?= $v['description'];?></td>
                        <td>
                          Expire : <?= $v['expire_date'];?><br>
                          Create : <?= $v['create_date'];?>
                        </td>

                        <td>
                          <a href="<?= base_url();?>superadmin/reload/edit_balance?reload_id=<?= $v['balance_id'];?>&customer_id=<?= $v['customer_id']?>" class="btn btn-danger">Edit</a></td>
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