<?php $sel = array('class' => 'form-control filter_select','style' => 'width:100%'); ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Order Info
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <?php if ($this->session->flashdata('msg')) { ?>
	        <div class="row">
		        <div class="col-md-12">
		        	<div class="alert alert-success alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> Success!</h4>
		                <?php echo $this->session->flashdata('msg')?>
		              </div>
		        </div>        	
	        </div>
        <?php }?>

        <div class="row">
            <div class="col-md-4">
				<div class="box box-primary box-solid">
			        <div class="box-header with-border">
			            <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Order</h3>
			        </div>
		            <!-- /.box-header -->
		            <div class="box-body no-padding">
		              <table class="table table-striped">
		                <tbody>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Order Date">
			                  		<i class="fa fa-calendar "></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11"><?php echo $info['order_no'];?></td>
			                </tr>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Payment Method">
			                  		<i class="fa fa-credit-card "></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11"><?php echo $info['payment_option'];?></td>
			                </tr>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Deliver Fee">
			                  		<i class="fa fa-truck "></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11">RM <?php echo $info['delivery_fee'];?></td>
			                </tr>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Deliver Fee">
			                  		<i class="fa fa-info-circle"></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11"><?php echo $info['order_status'];?></td>
			                </tr>
		              	</tbody>
		              </table>
		            </div>
				</div>            	
            </div>
            <div class="col-md-4">
				<div class="box box-primary box-solid">
			        <div class="box-header with-border">
			            <h3 class="box-title"><i class="fa fa-user"></i> Customer Details</h3>
			        </div>
		            <!-- /.box-header -->
		            <div class="box-body no-padding">
		              <table class="table table-striped">
		                <tbody>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Name">
			                  		<i class="fa fa-user"></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11">
			                  <?php $customer = $this->customer->get_customer($info['customer_id']);?> 
                          <a href="<?php echo base_url('superadmin/customer/edit');?>?customer_id=<?php echo $info['customer_id'];?>">
                          <?php echo $customer->first_name;?> <?php echo $customer->last_name;?>
                            
                          </a> 
                          </td>
			                </tr>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Email">
			                  		<i class="fa fa-envelope-o "></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11"><?php echo $info['email'];?></td>
			                </tr>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Mobile Phone">
			                  		<i class="fa fa-phone "></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11"><?php echo $info['phone'];?></td>
			                </tr>
		              	</tbody>
		              </table>
		            </div>
				</div>            	
            </div>
            <div class="col-md-4">
				<div class="box box-primary box-solid">
			        <div class="box-header with-border">
			            <h3 class="box-title"><i class="fa fa-cog"></i> Action</h3>
			        </div>
		            <!-- /.box-header -->
		            <div class="box-body no-padding">
		              <table class="table table-striped">
		                <tbody>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Add More">
			                  		<i class="fa fa-plus"></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11">
			                  <?php $customer = $this->customer->get_customer($info['customer_id']);?> 
                          <a href="<?php echo base_url('superadmin/order/add_box');?>?customer_id=<?php echo $info['customer_id'];?>&order_id=<?php echo $info['order_id']?>&that_day_date=<?php echo $that_day_date;?>">Add More Box</a> 
                          </td>
			                </tr>
			                <tr>
			                  <td class="col-md-1">
			                  	<button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Cancel Order">
			                  		<i class="fa fa-minus-circle"></i>
			                  	</button>
			                  </td>
			                  <td class="col-md-11">
                          <a href="<?php echo base_url('superadmin/order/cancel');?>?customer_id=<?php echo $info['customer_id'];?>">Cancel Order</a>	   
                          		</td>
			                </tr>
		              	</tbody>
		              </table>
		            </div>
				</div>            	
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-12">
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
					  <h3 class="box-title">Details</h3>

					  <div class="box-tools pull-right">
					    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					    </button>
					  </div>
					  <!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
				          <thead>
				            <tr>
				                <th class="text-left">Shipping Address</th>
				            </tr>
				          </thead>
				          <tbody>
				            <tr>
				                <td class="text-left">
				                <?php echo $info['payment_firstname'];?> <?php echo $info['payment_lastname'];?><br>
				                <?php echo $info['payment_address_1'];?><br>
				                <?php echo $info['payment_address_2'];?><br>
				                <?php echo $info['payment_city'];?> <?php echo $info['payment_postcode'];?><br>
				                <?php echo $info['payment_state'];?><br>
				                </td>
				            </tr>
				          </tbody>
				        </table>
						<table class="table table-bordered">
				          <thead>
				            <tr>
				            	<th>Menu Date</th>
				                <th>Selected Menu</th>
				                <th>Quantity</th>
				                <th class="text-right">Unit Price</th>
				                <th class="text-right">Total</th>
				            </tr>
				          </thead>
				          <tbody>
				          <?php foreach ($info['details'] as $k => $v) { ?>
				            <tr>
				            	<td><?php echo $v['that_day_date'];?></td>
				                <td><?php if ($v['type'] == 'mealbox'): ?>
					                <?php $menu = json_to_array(json_decode($v['selected_menu'], true)); ?>
					        		<?php foreach ($menu as $mk => $mv) {?>
					        			<?php if ($mk == 'meat') { ?>
					        				<?php foreach ($mv['eng'] as $mvk => $mvv) { ?>
					        					<span class="label label-danger"><?php echo $mvv;?></span>        					
					        				<?php } ?>
					        			<?php } ?>
					        			<?php if ($mk == 'vege') { ?>
					        				<?php foreach ($mv['eng'] as $mvk => $mvv) { ?>
					        					<span class="label label-success"><?php echo $mvv;?></span>        					
					        				<?php } ?>
					        			<?php } ?>
					        		<?php }?>					                	
				                <?php else: ?>
				                	                          <?php 
                            $this->db->select('*');
                            $this->db->from('alacarte');
                            $this->db->where('id' , $v['selected_menu']);
                            $query = $this->db->get();
                            $ret = $query->row();
                           ?>
                          <span class='label label-default'><?php echo $ret->menu_english; ?></span>
				                <?php endif ?>
				                				                	
				                </td>
				                <td><?php echo $v['quantity'];?></td>
				                <td class="text-right">RM <?php echo $v['price'];?></td>
				                <td class="text-right">RM <?php echo $v['total'];?></td>
				            </tr>
				          <?php }?>
				            <tr>
				                <td colspan="4" class="text-right">Sub-Total</td>
				                <td class="text-right">RM <?php echo $info['total_amount'];?></td>
				            </tr>
				            <tr>
				                <td colspan="4" class="text-right">Delivery Fee</td>
				                <td class="text-right">RM <?php echo number_format($info['delivery_fee'], 2, '.', ' ');?></td>
				            </tr>
				            <tr>
				                <td colspan="4" class="text-right">Total</td>
				                <td class="text-right">RM <?php echo number_format($info['total_amount']+$info['delivery_fee'], 2, '.', ' ');?></td>
				            </tr>
				          </tbody>
				        </table>
					</div>
				<!-- /.box-body -->
				</div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-xs-12">
				<div class="box box-primary box-solid">
					<div class="box-header with-border">
					  <h3 class="box-title">Edit Order</h3>
					  <div class="box-tools pull-right">
					    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					    </button>
					  </div>
					  <!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form class="form-horizontal" method="POST" action="<?php echo base_url('superadmin/order/edit_status');?>/<?php echo $info['order_id'];?>">
						  <div class="box-body">
						    <div class="form-group">
						      <label class="col-sm-2 control-label">Order Status</label>
						      <div class="col-sm-10">
						      	<select class="form-control" name="order_status">
						      		<option value="processing" <?php echo ($info['order_status'] == 'processing' ? 'selected' : '');?> >Processing</option>
						      		<option value="paid" <?php echo ($info['order_status'] == 'paid' ? 'selected' : '');?>>Paid</option>
						      		<option value="delivered" <?php echo ($info['order_status'] == 'delivered' ? 'selected' : '');?>>Delivered</option>
						      		<option value="cancelled" <?php echo ($info['order_status'] == 'cancelled' ? 'selected' : '');?>>Cancelled</option>
						      	</select>
						      </div>
						    </div>
						  </div>
						  <!-- /.box-body -->
						  <div class="box-footer">
						    <button type="submit" class="btn btn-primary pull-right">Submit</button>
						  </div>
						  <!-- /.box-footer -->
						</form>					
					</div>
				<!-- /.box-body -->
				</div>
        	</div>        	
        </div>
      
      <!-- /.box -->

        </section><!-- /.content -->