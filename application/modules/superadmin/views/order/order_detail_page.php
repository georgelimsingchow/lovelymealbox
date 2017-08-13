<?php $sel = array('class' => 'form-control filter_select','style' => 'width:100%'); ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Order
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $this->mOrder->count_order_status('processing'); ?></h3>

              <p>Processing</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('superadmin/order')?>?order_status=processing&submit=submit" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $this->mOrder->count_order_status('paid'); ?></h3>

              <p>Paid</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('superadmin/order')?>?order_status=paid&submit=submit" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $this->mOrder->count_order_status('delivered'); ?></h3>

              <p>Delivered</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('superadmin/order')?>?order_status=delivered&submit=submit" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $this->mOrder->count_order_status('cancelled'); ?></h3>

              <p>Cancelled</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('superadmin/order')?>?order_status=cancelled&submit=submit" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- SELECT2 EXAMPLE -->

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Order List</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <form role="form" method="GET" action="<?php echo base_url('superadmin/order');?>">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Order Number</label>
                      <?php echo form_dropdown('order_no', $order_no, $this->input->get('order_no'),$sel);?>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Order Date</label>
                      <input class="form-control" id="that_day_date" name="that_day_date" placeholder="Enter Date" type="text" value="<?php echo $this->input->get('that_day_date')?>">
                    </div>
                    <!-- /.form-group -->
                  
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Customer Name</label>
                      <?php echo form_dropdown('customer_id', $customer_name, $this->input->get('customer_id'),$sel);?>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Delivery Session</label>
                      <?php echo form_dropdown('delivery_session', $delivery_session, $this->input->get('delivery_session'),$sel);?>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Order Status</label>
                      <?php echo form_dropdown('order_status', $order_status,$this->input->get('order_status'),$sel);?>
                    </div>
                    <!-- /.form-group -->

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Filter</button>
            <?php if (isset($url)) { ?>
              <a href="<?php echo base_url('superadmin/order/report')."?".$url;?>" class="btn btn-warning" >Inhouse Report</a>
              <a href="<?php echo base_url('superadmin/order/printable_report')."?".$url;?>" class="btn btn-warning" >Print Report</a>
            <?php }?>            
          </div>
          </form>
        </div>
        <?php if (isset($details)) {?>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Order List</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
            <div class="box-body table-responsive">
            <?php $thedate = $this->input->get('that_day_date'); ?>
            <?php if (!empty($thedate)): ?>
              <?php $count_meal = $this->mOrder->count_ordered_meal($thedate);
                    $count_lunch = $count_meal['lunch'];
                    $count_dinner = $count_meal['dinner'];
               ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th colspan=2 class="text-center">LUNCH</th>
                    <th colspan=2 class="text-center">DINNER</th>
                  </tr>
                  <tr>
                    <th>MEALBOX</th>
                    <th>ALACARTE</th>
                    <th>MEALBOX</th>
                    <th>ALACARTE</th>
                  </tr>
                  <?php foreach ($count_lunch as $type => $v): ?>
                    <?php if ($type == 'mealbox'): ?>
                      <?= print_r($v); ?>
                    <?php endif ?>
                  <?php endforeach ?>
                  <?php foreach ($count_dinner as $type => $value): ?>
                                      d
                  <?php endforeach ?>
                  <tr><th>Hello</th></tr>
                  <tr><th>Hello</th></tr>
                </thead>
              </table>
            <?php endif ?>
              <table class="table table-bordered">
                <tbody>
                <?php foreach ($details as $order_number => $item) { ?>
                    <tr>
                      <th colspan="10" class="text-center"><strong><?php echo $order_number;?></strong></th>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <th>Payment Name</th>
                      <th>Order Status</th>                     
                      <th>Selected Menu</th>
                      <th>QTY</th>
                      <th>Price</th>
                      <th>Delivery Date</th>
                      <th>Session</th>
                      <th>Comment</th> 
                      <th>Action</th>                      
                    </tr>
                      <?php foreach ($item as $k => $v) { ?>
                      <?php $customer = $this->customer->get_customer($v->customer_id);?>                      
                      <tr>
                        <td>                        
                          <a href="<?php echo base_url('superadmin/customer/info');?>?customer_id=<?php echo $v->customer_id;?>">
                          <?php echo $customer->first_name;?> <?php echo $customer->last_name;?>
                            
                          </a>                        
                        
                          
                        </td>
                        <td><?php echo $v->firstname." ".$v->lastname;?></td>
                        <td><?php echo $v->order_status;?></td>
                        <td>
                        <?php if ($v->type == 'mealbox'): ?>
                        <?php  $select_menu_array = json_to_array(json_decode($v->selected_menu,TRUE));?>
                              <?php  foreach ($select_menu_array as $smk => $smv) {
                                if ($smk == 'meat') {
                                  foreach ($smv['eng'] as $engk => $engv) {
                                   echo "<span class='label label-danger'>$engv</span><br>";
                                  }
                                }
                                if ($smk == 'vege'){
                                  foreach ($smv['eng'] as $engk => $engv) {
                                    echo "<span class='label label-success'>$engv</span><br>";
                                  }
                                }
                              };?>                          
                        <?php else: ?>
                          <?php 
                            $this->db->select('*');
                            $this->db->from('alacarte');
                            $this->db->where('id' , $v->selected_menu);
                            $query = $this->db->get();
                            $ret = $query->row();
                           ?>
                          <span class='label label-default'><?php echo $ret->menu_english; ?></span>
                        <?php endif ?>
                        </td>
                        <td><?php echo $v->quantity;?></td>
                        <td><?php echo $v->price;?></td>
                        <td><?php echo $v->that_day_date;?></td>
                        <td><?php echo $v->delivery_session;?></td>
                        <td><?php echo $v->comment;?></td>
                        <td>
                        <a href="<?php echo base_url('superadmin/order/info');?>?order_id=<?php echo $v->order_id;?>">Edit</a></td>
                      </tr>
                      <?php }?>
                  <?php }?>
                </tbody>
              </table>
            </div>
        </div>
         <?php  }?>
      
      <!-- /.box -->

        </section><!-- /.content -->