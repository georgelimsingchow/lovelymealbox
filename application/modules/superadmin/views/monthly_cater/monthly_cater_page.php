<section class="content-header">
          <h1>
            Monthly Catering List
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>

<section class="content">

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?= $count_active_cater; ?></h3>
        <p>Active Cater</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?= $count_inactive_cater;  ?></h3>
        <p>Inactive Cater</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div><!-- ./col -->


</div>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <a href="<?= base_url('superadmin/monthly_cater/add_cater')?>" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Cater Customer</a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Credit</th>

                      <th>Action</th>
                    </tr>
                    <?php foreach ($cater_data as $key => $value) { ?>
                    <tr>
                      <td><?= $value['name'];?></td>
                      <td><?= $value['phone'];?></td>
                      <td> 
                        <?php  
                          $debit = $this->mcater->get_cater_total_reload($value['id']); 
                          $credit = $this->mcater->get_cater_total_spent($value['id']);

                        ?>
                        Total Reload : <strong>RM <?= $debit['total_fee']; ?></strong><br>
                        Total Credit : <strong><?= $debit['total_credit'] ? $debit['total_credit'] :"0"; ?></strong><br>
                        Total Spent : <strong><?= $credit['total_credit'] ? $credit['total_credit'] :"0"; ?></strong><br>
                        Total Credit Left : <strong><?= $debit['total_credit'] - $credit['total_credit']; ?></strong>
                      </td>

                      <td>
                        <a href="<?= base_url('superadmin/monthly_cater/add_cater_detail')?>?id=<?= $value['id'];?>" class="btn btn-primary">Reload</a>
                        <a href="<?= base_url('superadmin/monthly_cater/order_cater_detail')?>?id=<?= $value['id'];?>" class="btn btn-danger">Order</a>                     
                      </td>
                    </tr>                	
                    <?php }?>
                  </tbody></table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>