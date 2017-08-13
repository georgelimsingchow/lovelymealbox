<?php $order_url = 'superadmin/order/';?>
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
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="get" action="<?php echo base_url().$order_url;?>new_one">

                  <div class="box-body">

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Order Number</label>
                      <select class="form-control" name="order_number" id="order_number">
                        <option></option>
                      <?php foreach ($get_order_number as $key => $value) { ?>
                        <option value="<?php echo $key;?>" <?php if ($this->input->get('order_number') == $key){ echo 'selected="selected"'; } ?>><?php echo $value;?></option>
                      <?php }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Customer Name</label>
                      <select class="form-control" name="customer_name" id="customer_name">
                        <option></option>
                      <?php foreach ($get_customer_name as $key => $value) { ?>
                        <option value="<?php echo $key;?>" <?php if ($this->input->get('customer_name') == $key){ echo 'selected="selected"'; } ?>><?php echo $value;?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Order Status</label>
                      <select class="form-control" name="order_status" id="order_status">
                        <option></option>
                      <?php foreach ($get_order_status as $key => $value) { ?>
                        <option value="<?php echo $key;?>" <?php if ($this->input->get('order_status') == $key){ echo 'selected="selected"'; } ?>><?php echo $value;?></option>
                      <?php }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Is settled</label>
                      <select class="form-control" name="is_settled">
                        <option></option>
                      <?php foreach ($get_order_settled as $key => $value) { ?>
                        <option value="<?php echo $key;?>" <?php if ($this->input->get('is_settled') == $key){ echo 'selected="selected"'; } ?>><?php echo $value;?></option>
                      <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Order Date</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="that_day_date" placeholder="2016-12-31" name="that_day_date" value="<?php echo set_value('that_day_date', $this->input->get('that_day_date')); ?>">
                    </div>
                    </div>

                  </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="submit" value="submit">Search</button>
                    <a href="<?php echo base_url().$order_url;?>new_one" class="btn btn-primary">Reset</a>
                    <?php if (!empty($order_data)) { ?>
                    <div class=" pull-right box-tools">
                      <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Report <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url().$order_url;?>delivery_csv<?php echo $url_data;?>">Delivery</a></li>
                          <li><a href="<?php echo base_url().$order_url;?>inhouse_csv<?php echo $url_data;?>">Checking</a></li>
                          <li><a href="<?php echo base_url().$order_url;?>inhouse_csv/CN/<?php echo $url_data;?>">Checking CN</a></li>
                        </ul>
                      </div>
                    </div>

                    <?php }?>
                  </div>
                </form>
              </div><!-- /.box -->

            </div>
          </div><!-- /.row -->
          <!-- Main row -->

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">All Order</h3>
                  <div class="box-tools">

                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tbody>

                      <?php if (!empty($order_data)) { ?>
                      <?php foreach ($order_data as $key => $value) { ?>
                        <tr>
                          <th colspan="8" class="text-center"><strong><?php echo $key;?></strong></th>
                        </tr>
                        <tr>
                          <th>Customer</th>
                          <th>Payment Name</th>
                          <th>Postcode</th>                      
                          <th>Menu</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          <th>Delivery Date</th>                          
                          <th>Settled</th>
                        </tr>
                        <?php foreach ($value as $vk => $vv) { ?>
                          <tr>
                            <td><?php echo $vv['firstname']." ".$vv['lastname'];?></td>
                            <td><?php echo $vv['payment_firstname']." ".$vv['payment_lastname'];?></td>
                            <td>
                              <?php echo $vv['payment_postcode'];?><br>
                            </td>
                            <td><?php echo $vv['selected_menu'];?></td>
                            <td><?php echo $vv['quantity'];?></td>
                            <td>RM <?php echo $vv['total'];?></td>
                            <td><?php echo $vv['that_day_date'];?></td>
                            <td>
                              <?php if ($vv['is_settled'] == '0') {?>
                                <span class="badge bg-red">NO</span>
                              <?php }else{?>
                                <span class="badge bg-green">YES</span>
                              <?php }?>
                            </td>
                          </tr>
                        <?php }?>
                      <?php }?>
                      <?php }else{ ?>
                      <tr>
                        <td colspan="6" class="text-center"><strong>SEARCH TO BEGIN</strong></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->