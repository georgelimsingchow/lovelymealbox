<div class="container">
    <div class="row">
		 <ol class="breadcrumb brand-danger">
		  <li><a href="<?php echo base_url();?>home">Home</a></li>
		  <li><a href="<?php echo base_url();?>account">Account</a></li>
		  <li><a href="<?php echo base_url();?>account/address/">Manage address</a></li>
		  <li class="active">Edit address</li>
		</ol>
	</div>
	<div class="row">
   		<h4></h4>
   		<hr>

   		<div class="col-md-10">

   		<form class="form-horizontal" action="<?php echo base_url();?>account/address/edit/<?= $id?>" method="post">
   			<fieldset>
	   		<div class="form-group">
	             <label for="fname" class="col-sm-2 control-label">First name</label>
	             <div class="col-sm-10">
	               <input type="text" class="form-control" id="fname" placeholder="[First name]" value="<?php echo set_value('fname',$firstname); ?>" name="fname">
	               <?php echo form_error('fname', '<p class="text-danger">', '</p>'); ?>

	             </div>
	         </div>
			<div class="form-group">
	             <label for="lname" class="col-sm-2 control-label">Last name</label>
	             <div class="col-sm-10">
	               <input type="text" class="form-control" id="lname" placeholder="[Surname] or [Last name]" value="<?php echo set_value('lname',$lastname); ?>" name="lname">
	               <?php echo form_error('lname', '<p class="text-danger">', '</p>'); ?>
	             </div>
			</div>	
			<div class="form-group">
	             <label for="mobile" class="col-sm-2 control-label">Mobile no.</label>
	             <div class="col-sm-10">
	               <input type="text" class="form-control" id="mobile" placeholder="[Mobile number] e.g 012-3456789" value="<?php echo set_value('mobile',$mobile_no); ?>" name="mobile">
	               <?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
	             </div> 
			</div>
			<div class="form-group">
	             <label for="address1" class="col-sm-2 control-label">Address 1</label>
	             <div class="col-sm-10">
	               <input type="text" class="form-control" id="address1" placeholder="[House number/Lot number/Floor and Building Name]" value="<?php echo set_value('address_1',$address_1); ?>" name="address_1">
	               <?php echo form_error('address_1', '<p class="text-danger">', '</p>'); ?>
	             </div>
			</div>

			<div class="form-group">
	             <label for="address2" class="col-sm-2 control-label">Address 2</label>
	             <div class="col-sm-10">
	               <input type="text" class="form-control" id="address2" placeholder="[Street Name]" value="<?php echo set_value('address_2',$address_2); ?>" name="address_2">
	             </div>
	         </div>
			<div class="form-group">
	             <label for="city" class="col-sm-2 control-label">City/Town</label>
	             <div class="col-sm-10">
	             	<input type="text" class="form-control" id="city" name="city" placeholder="[City/Town] e.g kuching" value="<?php echo set_value('city',$city); ?>" name="city">
	             	<p class="text-primary">We only deliver to town area , bdc, pending, green road, saberkas, 7th mile, stutong area, tabuan jaya, hui sing, airport, King centre</p>
	             	<?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
	             </div>
			</div>

			<div class="form-group">
             <label for="postcode" class="col-sm-2 control-label">Postcode</label>
             <div class="col-sm-10">
             	<?php

             	$data = array(
				        'name'          => 'postcode',
				        'id'            => 'postcode',
				        'value'         => $postcode,
				        'class'			=> 'form-control',
				        'placeholder'   => 'e.g 93300'
				);
					echo form_input($data);
             	?>
             	<?php echo form_error('postcode', '<p class="text-danger">', '</p>'); ?>
             </div>
			</div>
			<div class="form-group">
	             <label for="state" class="col-sm-2 control-label">State</label>
	             <div class="col-sm-10">
	             	<?php 
	             	$js = 'class="form-control" id="state"';
	             	echo form_dropdown('state', $state, set_value('state',$state_id) ,$js);

	             	?>
	             </div>
			</div>
			</fieldset>
				<div class="clearfix">
					<a href="<?php echo base_url();?>account/address" class='btn btn-default'>BACK</a>
					<button type="submit" class="btn btn-primary pull-right" name="submit" value="submit">CONTINUE</button>
				</div>
   		</form>
   		</div>

	</div>
</div>
