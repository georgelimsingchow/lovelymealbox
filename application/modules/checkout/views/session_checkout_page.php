<?php $mid = 'vertical-align:middle';?>
<?php $d = $this->input->get('date');?>
<?php $sess = $this->uri->segment(2);?>
<div class="container">
	<div class="row">
	<div class="col-md-8">

    <div class="panel panel-primary">
      <div class="panel-heading">ORDER DETAILS</div>
      <div class="panel-body">
      <h4> <span class="label label-warning"><?php echo ucfirst($sess);?></span> <span class="label label-warning"><?php echo date("Y-M-d (D)", strtotime($d));?></span></h4>
      <div class="table-responsive">
				<table class="table table-hover table-bordered table-condensed">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>ITEM</th>
							<th class="text-center">TYPE</th>
							<th class="text-center">QUANTITY</th>
							<th class="text-center">TOTAL</th>							
						</tr>
					</thead>
					<tbody>
					<?php foreach ($checkout_detail as $key => $v): ?>
						<tr>
							<td class=" text-center" style="<?php echo $mid;?>"><?php echo $key+1;?></td>
							<td style="<?php echo $mid;?>">
							<?php if ($v['type'] == 'mealbox'): ?>
								<ul class="list-unstyled">
                              <?php $food_item = json_decode($v['selected_menu'],true);?>
                              <?php foreach ($food_item as $key => $id): ?>
                                <?php $food_name = get_food_type($id); ?>
                                <li><?php echo $food_name->menu_english; ?></li>                               
                              <?php endforeach ?>															
								</ul>
							<?php else: ?>
								<?php $ala = $this->mm->get_single_alacarte($v['selected_menu']); ?>
								<ul class="list-unstyled">
									<li><?php echo $ala->menu_english; ?></li>
								</ul>
							<?php endif ?>
							</td>
							<td class="text-center">
								<?php echo ucfirst($v['type']); ?>
							</td>
								
							
							<td class=" text-center" style="<?php echo $mid;?>"><?php echo $v['quantity']?></td>						
							<td class="text-center" style="<?php echo $mid;?>">RM <?php echo sprintf('%0.2f',$v['quantity']*$v['unit']);?></td>					
						</tr>						
					<?php endforeach ?>
					</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-5 pull-right">
				<ul class="list-group">
				  <li class="list-group-item">Delivery Fee : <span class="pull-right">RM <span id="fee">0.00</span></span></li>
				  <li class="list-group-item">Total : <strong><span class="pull-right">RM <span id="total_fee"><?php echo $total['total']; ?></span></span></strong></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><a href="<?php echo base_url().$sess;?>?date=<?php echo $d; ?>" class="btn btn-default">BACK TO <?php echo $d; ?></a></div>
		</div>
      </div>
    </div>

	</div>
	<div class="col-md-4">
	<form action="<?php echo base_url('checkout')."/".$sess;?>?date=<?php echo $d; ?>" method="post">
		<input type="hidden" name="session" value="<?php echo $sess; ?>" />
		<input type="hidden" name="that_day_date" value="<?php echo $d; ?>" />

		<div class="row">
			<div class="col-md-12">
			    <div class="panel panel-primary">
			      <div class="panel-heading">1. PAYMENT OPTION</div>
			      <div class="panel-body">
						<div class="radio">
							<label> <input id="cod" type="radio" name="payment_option" value="transfer" <?php echo set_radio('payment_option','transfer');?>> Cash On Delivery (Extra RM 2.00)</label> 
						</div>
						
						<?php  $user_balance = get_amount($this->session->customer_id);?>
						<?php if ($total['total'] > $user_balance): ?>
							<div class="radio disabled">
							<label> <input id="ub" type="radio" name="payment_option" value="credit" <?php echo set_radio('payment_option','credit');?> disabled> User Balance (Insufficient Funds)</label> 
						</div>			
						<?php else: ?>
							<div class="radio">
							<label> <input id="ub" type="radio" name="payment_option" value="credit" <?php echo set_radio('payment_option','credit');?>> User Balance 
							(left RM <?php echo $user_balance; ?>)</label> 
						</div>
						<?php endif ?>
						<?php echo form_error('payment_option', '<p class="text-danger">', '</p>'); ?>	      	
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
						<button type="submit" value="submit" name="submit" class='btn btn-danger pull-right' onclick="return confirm('Are you sure to place your order?');">SUBMIT ORDER</button>
					</div>
				    </div>
		
				</div>
		</div>
	</form>	
		</div>
	</div>
</div>