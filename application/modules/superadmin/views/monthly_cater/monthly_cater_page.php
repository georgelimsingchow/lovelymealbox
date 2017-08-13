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
                      <th>Detail</th>

                      <th>Action</th>
                    </tr>
                    <?php foreach ($cater_data as $key => $value) { ?>
                    <tr>
                      <td><?= $value['name'];?></td>
                      <td><?= $value['phone'];?></td>
                      <td> dummy </td>

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