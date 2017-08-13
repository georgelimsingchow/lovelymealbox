<div class="container">
	<div class="row">

	<div class="col-md-12">
		<div class="panel panel-danger">
		  <div class="panel-heading">
		    <h3 class="panel-title text-center"><?php echo $panel_title; ?></h3>
		  </div>
		  <div class="panel-body">
			  <div class="col-md-12"  style="margin-bottom: 15px;">
			  	<img src="<?php echo base_url('assets/images/cny/cny-package.jpg');?>" class="img-responsive"></div>
			  <div class="col-md-12">
		    <form class="form-horizontal" method="POST" action="<?php echo base_url('cny/promo2_validation')?>">
		    	<?php echo form_error('selectone', '<div class="alert alert-warning">', '</div>'); ?>
				  <div class="form-group <?php if(form_error('name')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>">
				      <?php echo form_error('name', '<span class="help-block">', '</span>'); ?>
				    </div>

				  </div>
				  <div class="form-group <?php if(form_error('phone')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Phone</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="phone" placeholder="0123456789" value="<?php echo set_value('phone'); ?>">
				      <?php echo form_error('phone', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group <?php if(form_error('email')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" name="email" placeholder="happy@lovelymealbox.com" value="<?php echo set_value('email'); ?>">
				      <?php echo form_error('email', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group <?php if(form_error('package')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Package</label>
				    <div class="col-sm-10">
				    <select class="form-control" name="package">
				    	<option value="">--Please Select--</option>
				    	<option value="188" <?php echo set_select('package', '188'); ?>>Package A (RM 188)</option>
				    	<option value="288" <?php echo set_select('package', '288'); ?>>Package B (RM 288)</option>
				    	<option value="488" <?php echo set_select('package', '488'); ?>>Package C (RM 488)</option>
				    	<option value="688" <?php echo set_select('package', '688'); ?>>Package D (RM 688)</option>
				    </select>
				    <?php echo form_error('package', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group <?php if(form_error('date')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Date</label>
				    <div class="col-sm-10">
				    <select class="form-control" name="date">
				    	<option value="">--Please Select--</option>
				    	<option value="26-JAN-2016" <?php echo set_select('date', '26-JAN-2016'); ?>>26th January 2016 (年二九)</option>
				    	<option value="27-JAN-2016" <?php echo set_select('date', '27-JAN-2016'); ?>>27th January 2016 (年三十)</option>
				    </select>
				    <?php echo form_error('date', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>

				  <div class="form-group">
				    <label class="col-sm-2 control-label">Time</label>
				    <h4 class="col-sm-10 text-center">Pick up before 4 PM at Foochow Road No 1</h4>				    
				  </div>
				  	<button class="btn btn-primary pull-right">SUBMIT</button>
		    </form>
			  </div>
		  	

		  </div>
		</div>
	</div>
	</div>
</div>
<script type="text/javascript">
	
</script>