<?php $v_mid = 'vertical-align:middle';?>
<?php $total_delivery_fee = count($cart_details)?>
<div class="container">
	<div class="row">
	<div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">ORDER DETAILS</div>
      <div class="panel-body">
		<?php foreach ($cart_details as $date => $cart_value) { ?>
			<h4 >ORDER : <span class='label label-warning'><?php echo $date." (".date('D', strtotime($date)).")"; ?></span></h4>
			<div class="table-responsive">
				<table class='table table-hover table-bordered table-condensed'>
					<thead>
						<tr>
							<th class='text-center'>#</th>
							<th >DISH</th>
							<th class='text-center'>QUANTITY</th>
							<th class='text-center'>TOTAL</th>							
						</tr>
					</thead>
						<tbody>
				<?php $i = 0;?>
			<?php foreach ($cart_value as $key => $value) { ?>
						<?php $i++ ;?>
				<tr id="<?php echo $value['id']; ?>">
					<td class=' text-center' style='<?php echo $v_mid;?>'><?php echo $i ;?></td>
					<td  style='<?php echo $v_mid;?>'>
						<ul class='list-unstyled'>
					 <?php if (!empty($value['selected_menu']['meat'])) { ?>
						<?php foreach ($value['selected_menu']['meat']['eng'] as $id => $meat_name) {?>
							<li><h5><span class='label label-danger'><?php echo $meat_name; ?></span></h5></li>									
						<?php } ?>
					<?php } ?>
					<?php if (!empty($value['selected_menu']['vege'])) { ?>
					<?php foreach ($value['selected_menu']['vege']['eng'] as $id => $vege_name) { ?>
							<li><h5><span class='label label-success'><?php echo $vege_name; ?></span></h5></li>								
						<?php } ?>
					<?php } ?>
					</ul>
					</td>
					<td class=' text-center' style='<?php echo $v_mid;?>'> <?php echo $value['quantity']; ?></td>						
					<td class='text-center' style='<?php echo $v_mid;?>'><?php echo $value['total']; ?></td>					
				</tr>
			<?php } ?>
			</tbody>
			</table>
		</div>
		<?php } ?>
			<div class="row">
				<div class="col-md-5 pull-right">
					<ul class="list-group">
					  <li class="list-group-item">Delivery Fee : <span class="pull-right">RM <span id="fee">0.00</span></span></li>
					  <li class="list-group-item">Total : <STRONG><span class="pull-right">RM <span id="total_fee"><?php echo sprintf('%0.2f',$total_amount);?></span></span></STRONG></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12"><a href="<?php echo base_url();?>order/date/<?php echo $date;?>" class="btn btn-default">BACK TO <?php echo $date;?></a></div>
			</div>	
      </div>
    </div>

	</div>
	<div class="col-md-4">
	<form action="<?php echo base_url();?>checkout" method="post">
		<div class="row">
			<div class="col-md-12">
			    <div class="panel panel-primary">
			      <div class="panel-heading">1. PAYMENT OPTION</div>
			      <div class="panel-body">
						<div class="radio">
							<label> <input id="cod" type="radio" name="payment_option" value="transfer" <?php echo set_radio('payment_option','transfer');?>> Cash On Delivery (Minimum RM 15.00)</label> 
						</div>			
						<div class="radio">
							<label> <input id="ub" type="radio" name="payment_option" value="credit" <?php echo set_radio('payment_option','credit');?>> User Balance</label> 
						</div>
						<?php echo form_error('payment_option', '<p class="text-danger">', '</p>'); ?>	      	
			      </div>
			    </div>		
			</div>
			<div class="col-md-12">
			    <div class="panel panel-primary">
			    <?php $day_day =  date('D', strtotime($hidden_date['0'])); ?>
			      <div class="panel-heading">2. DELIVERY SESSION (<?php echo $day_day; ?>)</div>
			      <div class="panel-body">
			      <?php if ($delivery_settings['lunch'] == '1') { ?>
					<div class="radio">
						<label> 
						<input type="radio" name="delivery_session" value="lunch" <?php echo set_radio('delivery_session','lunch');?>> Lunch (11:00AM ~ 01:00PM)
						</label> 
					</div>
			      <?php }?>
			      <?php if ($delivery_settings['dinner'] == '1') { ?>
						<div class="radio">
							<label> 
							<input type="radio" name="delivery_session" value="dinner" <?php echo set_radio('delivery_session','dinner');?>> Dinner (05:00PM ~ 07:00PM)
							</label> 
						</div>
			      <?php }?>				
						<?php echo form_error('delivery_session', '<p class="text-danger">', '</p>'); ?>	      	
			      </div>
			    </div>		
			</div>
			<div class="col-md-12">
			    <div class="panel panel-primary">
			      <div class="panel-heading">
			      <h5 class="pull-left">3. SELECT ADDRESS</h5>
					<a href="<?php echo base_url();?>account/address/add" class="btn btn-danger pull-right">New Address</a>
        			<div class="clearfix"></div>
			      </div>
			      <div class="panel-body">
					<?php foreach ($hidden_date as $key => $value) { ?>
						<input type="hidden" name="date_key[]" value="<?php echo $value; ?>" />
					<?php }?>
					<div class="form-group">
						<select name="checkout_address" class="form-control">
							<option value="">Please select address</option>

						<?php foreach ($customer_address as $key => $value) { ?>
							<option value="<?php echo $value['id'];?>"><?php echo $value['long_address']?></option>
						<?php } ?>
						</select>
					</div>
					<?php echo form_error('checkout_address', '<p class="text-danger">', '</p>'); ?>
			      </div>
			    </div>
		
			</div>
				<div class="col-md-12">
				    <div class="panel panel-primary">
				      <div class="panel-heading"><h5>4. LEAVE COMMENT</h5></div>
				      <div class="panel-body">
						<div class="form-group">
							<textarea class="form-control" rows="3" placeholder="Remark" name="comment"></textarea>
						</div>
						<button type="submit" value="submit" name="submit" class='btn btn-danger pull-right' onclick="return confirm('Are you sure to place your order?');">SUBMIT ORDER</button>				</div>
				    </div>
		
				</div>
		</div>
	</form>	
		</div>
	</div>
</div>