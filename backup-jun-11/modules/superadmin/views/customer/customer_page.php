<section class="content-header">
          <h1>
            Customer Table
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
                  <h3 class="box-title">Customer</h3>
                  <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <li><a href="#">«</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">»</a></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>                      
                      <th>Login type</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach ($customer_data as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1;?>.</td>
                      <td><?php echo $value['first_name']." ".$value['last_name'];?></td>
                      <td><?php echo $value['email'];?></td>
                      <td><?php echo get_login_type($value['login_type']);?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url('superadmin/customer/info');?>?customer_id=<?php echo $value['customer_id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    </tr>                 	
                    <?php }?>
                  </tbody></table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>