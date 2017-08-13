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
                  <a href="<?php echo base_url('superadmin/monthly_cater/add_cater')?>" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Cater Customer</a>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Detail</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach ($cater_data as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['phone'];?></td>
                      <td>
                      <?php $detail = $this->mcater->get_single_detail($value['id']);?>
                      <?php if (!empty($detail)) { ?>
                        <?php foreach ($detail as $sk => $sv) { ?>
                        <?php 
                          $endDate = date_create(substr(date('Y-m-d H:i:s'), 0,10));
                          $today = date_create(substr($sv['end_date'], 0,10));
                          $interval = date_diff($endDate, $today);
                        ?>                          
                          Start Date : <strong><?php echo substr($sv['start_date'], 0,10);?></strong><br>
                          End Date : 
                            <?php if ($interval->days <= '7') { ?>
                                <strong style="color:#dd4b39";><?php echo substr($sv['end_date'], 0,10);?></strong>
                              <?php }else{ ?>
                                <strong style="color:#00a65a";><?php echo substr($sv['end_date'], 0,10);?></strong>
                               <?php } ?>                            
                          <br>
                          Duration : <strong><?php echo $sv['from_day'];?> to <?php echo $sv['to_day'];?></strong><br>
                          Pax : <strong><?php echo $sv['pax'];?></strong><br>
                          Fee : <strong><?php echo $sv['fee'];?></strong><br>
                          Tingkat : <strong><?php echo $sv['is_tingkat'];?></strong>
                        <?php }?>
                      <?php }?>

                      </td>
                      <td><?php echo $value['create_date'];?></td>
                      <td>
                        <a href="<?php echo base_url('superadmin/monthly_cater/add_cater_detail')?>?id=<?php echo $value['id'];?>" class="btn btn-primary">Check</a>                     
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