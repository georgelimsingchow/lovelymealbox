<section class="content-header">
          <h1>
            Contact Table
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
                  <h3 class="box-title">Contact</h3>
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
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Create Date</th>
                    </tr>
                    <?php foreach ($contact_data as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['phone'];?></td>
                      <td><?php echo $value['email'];?></td>
                      <td><?php echo $value['subject'];?></td>
                      <td><?php echo $value['message'];?></td>
                      <td><?php echo $value['create_date'];?></td>
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