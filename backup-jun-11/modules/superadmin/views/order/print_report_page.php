<div class="container">
	<div class="row">
	<?php foreach ($print_report as $key => $value) { ?>
		<div class="col-xs-3 foo">
		<h4 class="text-center"><?php echo $value['that_day_date'];?> (<?php echo $value['order_status'];?>) (<?php echo $value['delivery_session'];?>)</h4>
		<ul class="list-unstyled">
         <li><?php echo $value['payment_firstname'];?> <?php echo $value['phone'];?></li>
         <li><?php echo $value['payment_address_1'];?></li>
         <li><?php echo $value['comment'];?></li>
        </ul>
		<ul class="list-unstyled">
		  <li><?php echo $value['selected_menu'];?> X<?php echo $value['quantity'];?></li>
		</ul>
		</div>
	<?php }?>
	</div>

</div>