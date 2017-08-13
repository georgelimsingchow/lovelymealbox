<?php $v_mid = 'vertical-align:middle';?>
<section>
<div class="container">
	<div class="row" >
		<?php if ($cart_details) { ?>
		<?php foreach ($cart_details as $date => $cart_value) { ?>
			<h4 class='text-center'>ORDER : <span class='label label-warning'><?php echo $date?></span></h4>
			<div class='table-responsive'>
				<table class='table table-hover table-bordered table-condensed' style="background-color: #fff;">
					<thead>
						<tr>
							<th class='text-center'>#</th>
							<th class='text-center'>MEAT</th>
							<th class='text-center'>VEGE</th>
							<th class='text-center'>ACTION</th>
							<th class='text-center'>QUANTITY</th>
							<th class='text-center'>PRICE</th>
							<th class='text-center'>TOTAL</th>							
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
			<?php foreach ($cart_value as $key => $value) { ?>
				
				<?php $i++ ; ?>						
				<tr id="<?php echo $value['id'];?>">
					<td class='col-sm-1 text-center' style='<?php echo $v_mid;?>'><?php echo $i;?></td>
					<td class='col-sm-2 text-center' >
						<ul class='list-unstyled'>
							<?php if (!empty($value['selected_menu']['meat'])) {?>
								<?php foreach ($value['selected_menu']['meat']['eng'] as $id => $meat_name) { ?>
									<li>
										<h5><span class='label label-danger'><?php echo $meat_name;?></span></h5>
									</li>									
								<?php } ?>
							<?php } ?>
						</ul>
					</td>
					<td class='col-sm-2 text-center'>
							<ul class='list-unstyled'>
						<?php if (!empty($value['selected_menu']['vege'])) {?>
							<?php foreach ($value['selected_menu']['vege']['eng'] as $id => $vege_name) { ?>
								<li>
									<h5><span class='label label-success'><?php echo $vege_name;?></span></h5>
								</li>									
							<?php } ?>
						<?php } ?>
						</ul>
					</td>
					<td class='col-sm-1 text-center' style='<?php echo $v_mid;?>'><button type='button' class='btn btn-danger' onclick='cart.remove(<?php echo $value['id']; ?>)'><i class='glyphicon glyphicon-remove'></i></button></td>
					<td class='col-sm-1 text-center' style='<?php echo $v_mid;?>'><?php echo form_dropdown('quantity', $fifty,$value['quantity'],'class="form-control quantity_box"'); ?></td>
					<td class='col-sm-1 text-center' style='<?php echo $v_mid;?>'>RM <?php echo $value['unit']; ?></td>							
					<td class='col-sm-1 text-center' style='<?php echo $v_mid;?>'>RM <?php echo $value['total']; ?></td>					
				</tr>
				<?php } ?>
				<tr>
					<td colspan='4'></td>
						<td class='text-center'>
						<span class='text-success'>
							<strong><?php echo count_individual_total_quantity($date,$this->session->customer_id);?> BOXES</strong>
						</span>
						</td>
					<td></td>
					<td class='text-center' style='<?php echo $v_mid;?>'>
						<strong>RM <?php echo count_individual_total_amount($date,$this->session->customer_id);?></strong>
					</td>					
				</tr>
				</tbody>
				</table>
			</div>
		<?php }?>


		<?php }else{ ?>
			<h3 class='text-center'>The cart is empty</h3>
		<?php }?>

	</div>
</div>

<div class="container">
	<div class="row">
		<a href='<?php echo base_url();?>home' class='btn btn-default pull-left'>CONTINUE SHOPPING</a>
		<?php 
		if ($this->settings->minimum_order($this->session->customer_id) == true) {
			echo "<a href='".base_url()."checkout' class='btn btn-danger pull-right'>CHECKOUT</a>";
		}else{
			echo "<button type='button' class='btn btn-danger pull-right disabled'>UNABLE TO CHECKOUT</button>";
		}

		?>
		
	</div>
</div>
</section>