<?php 

	$payment_code = array(
		'transfer' => 'Cash On Delivery',
		'credit' => 'Customer Credit',
		);

?>
<div class="container">
    <div class="row">
		 <ol class="breadcrumb brand-danger">
		  <li><a href="<?php echo base_url();?>home">Home</a></li>
		  <li><a href="<?php echo base_url();?>account">Account</a></li>
		  <li class="active">Order History</li>
		</ol>
	</div>
	<div class="row">
			<ul class="nav nav-tabs nav-justified">
			  <li class="<?php echo ( $order_type == 'processing' ? "active": "" ); ?>"><a href="<?php echo base_url();?>account/order/?type=processing">PROCESSING (<?php echo $processing;?>)</a></li>
			  <li class="<?php echo ( $order_type == 'paid' ? "active": "" ); ?>"><a href="<?php echo base_url();?>account/order/?type=paid">PAID (<?php echo $paid;?>)</a></li>
			  <li class="<?php echo ( $order_type == 'delivered' ? "active": "" ); ?>"><a href="<?php echo base_url();?>account/order/?type=delivered">DELIVERED (<?php echo $delivered;?>)</a></li>
			  <li class="<?php echo ( $order_type == 'cancelled' ? "active": "" ); ?>"><a href="<?php echo base_url();?>account/order/?type=cancelled">CANCELLED (<?php echo $cancelled;?>)</a></li>
			</ul>
   		<hr>
   		<div class="col-md-12">
   			<?php foreach ($all_order as $key => $value) { ?>
			<div class="panel panel-primary">
				<div class="panel-heading"> 
					<h3 class="panel-title"><?php echo $key+1; ?>. ORDER NO : <?php echo $value['order_no']; ?></h3> 
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<strong>Billed to:</strong>
							<ul class="list-unstyled">
                                <li> <?php echo $value['payment_firstname']." ".$value['payment_lastname']; ?> </li>
                                <li> <?php echo $value['payment_phone']; ?></li>
                                <li> <?php echo $value['payment_address_1']; ?></li>
                                <li> <?php echo $value['payment_address_2']." ".$value['payment_postcode']; ?> </li>
                                <li> <?php echo $value['payment_city']." ".getState($value['payment_state']); ?> </li>
                            </ul>
						</div>
						<div class="col-md-3">
							<strong>Order Date:</strong>
							<ul class="list-unstyled">
                                <li> <?php echo date("M j,Y H:i:s", strtotime($value['create_date'])); ?> </li>
                            </ul>
							<strong>Status:</strong>
							<ul class="list-unstyled">
                                <li> <?php echo ucfirst($value['order_status']);?> </li>
                            </ul>
							<strong>Session:</strong>
							<ul class="list-unstyled">
                                <li> <?php echo ucfirst($value['delivery_session']);?> </li>
                            </ul>
						</div>
						<div class="col-md-3">
							<strong>Payment Method:</strong>
							<ul class="list-unstyled">
                                <li> <?php echo ucfirst($payment_code[$value['payment_option']]);?> </li>
                            </ul>
						</div>
						<?php if($value['payment_option'] == 'transfer'){ ?>
							<div class="col-md-3">
								<strong>Please prepare accurate cash when delivery</strong>
								
							</div>
						<?php } ?>
					</div>
					<div class="row">
						<div class="col-md-12">
						   		<table class="table table-bordered">
						   			<thead>
						   				<tr>
											<th class="text-center">Item</th>
											<th class="text-center">Date</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Unit</th>
											<th class="text-center">Total</th>											
						   				</tr>
						   			</thead>
						   			<tbody>
						   				<?php foreach ($value['order_details'] as $d_k => $d_v) { ?>
							   				<tr id="row<?php echo $d_v['order_product_id'];?>">
												<td class="text-left">
							<?php if ($d_v['type'] == 'mealbox'): ?>
								<ul class="list-unstyled">
                              <?php $food_item = json_decode($d_v['selected_menu'],true);?>
                              <?php foreach ($food_item as $key => $id): ?>
                                <?php $food_name = get_food_type($id); ?>
                                <li><?php echo $food_name->menu_english; ?></li>                               
                              <?php endforeach ?>															
								</ul>
							<?php else: ?>
								<?php $ala = $this->mm->get_single_alacarte($d_v['selected_menu']); ?>
								<ul class="list-unstyled">
									<li><?php echo $ala->menu_english; ?></li>
								</ul>
							<?php endif ?>
													
												</td>
												<td class="text-center"><?php echo $d_v['that_day_date'];?></td>
												<td class="text-center"><?php echo $d_v['quantity'];?></td>										
												<td class="text-center"><?php echo $d_v['price'];?></td>
												<td class="text-center">RM <?php echo $d_v['total'];?></td>
							   				</tr>
						   				<?php }?>
						   			</tbody>
						   		</table>
						</div>
					</div>
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<ul class="list-group">
					  <li class="list-group-item">Delivery Fee : <span class="badge">RM <?php echo sprintf("%.2f", $value['delivery_fee']);?></span></li>
					  <li class="list-group-item">Total : <span class="badge">RM <?php echo sprintf("%.2f", ($value['total'] + $value['delivery_fee']));?></span></li>
					</ul>
				</div>
			</div>
				</div>
			</div>
   			<?php }?>


   		</div>

	</div>
</div>