<div class="container">
	<div class="row">
		<h3 class="text-center"><a href="<?php echo base_url();?>login">Login</a> or Register</h3>
		<hr>
		<div class="col-md-6">
			<a href="#" class="btn btn-block btn-social btn-facebook" onClick="logInWithFacebook()">
    			<span class="fa fa-facebook"></span> Sign in with Facebook
  			</a>
		</div>
		<div class="col-md-1 text-center">
			<strong>OR</strong>
		</div>
		<div class="col-md-5">
	        <form action="<?php echo base_url();?>register" method="post">
	          <div class="form-group <?php if(form_error('firstname')){echo 'has-error';} ?>">
	            <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?php echo set_value('firstname'); ?>">
	            <?php echo form_error('firstname', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="form-group <?php if(form_error('lastname')){echo 'has-error';} ?>">
	            <input type="text" class="form-control" placeholder="Last name / Surname" name="lastname" value="<?php echo set_value('lastname'); ?>">
	            <?php echo form_error('lastname', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="form-group <?php if(form_error('email')){echo 'has-error';} ?>">
	            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
	            <?php echo form_error('email', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="form-group <?php if(form_error('mobile')){echo 'has-error';} ?>">
	            <input type="text" class="form-control" placeholder="mobile e.g 0168833456" name="mobile" value="<?php echo set_value('mobile'); ?>">
	            <?php echo form_error('mobile', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="form-group <?php if(form_error('password')){echo 'has-error';} ?>">
	            <input type="password" class="form-control" placeholder="Create a password" name="password">
	            <?php echo form_error('password', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="form-group <?php if(form_error('repassword')){echo 'has-error';} ?>">
	            <input type="password" class="form-control" placeholder="Re-password" name="repassword">
	            <?php echo form_error('repassword', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="row">
	            <div class="col-xs-8">
	            	<p>By clicking Sign up, you agree to our Terms and that you have read our Data Policy</p>
	            </div><!-- /.col -->
	            <div class="col-xs-4">
	              <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="submit">Sign Up</button>
	            </div><!-- /.col -->
	          </div>
	        </form>
		</div>




		</div>
	</div>
</div>
