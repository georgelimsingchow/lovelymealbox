<div class="container">
	<div class="row">
		<h3 class="text-center">Login or <a href="<?php echo base_url();?>register">Register</a></h3>
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
	        <form action="<?php echo base_url();?>login" method="post">
	        	<?php echo form_error('not_found', '<p class="text-danger">', '</p>'); ?>
	          <div class="form-group <?php if(form_error('email')){echo 'has-error';} ?>">
	            <input type="text" class="form-control" placeholder="Enter your email" name="email" value="<?php echo set_value('email'); ?>">
	            <?php echo form_error('email', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="form-group <?php if(form_error('password')){echo 'has-error';} ?>">
	            <input type="password" class="form-control" placeholder="Enter your password" name="password" value="<?php echo set_value('password'); ?>">
	            <?php echo form_error('password', '<p class="help-block">', '</p>'); ?>
	          </div>
	          <div class="row">
	            <div class="col-xs-8">

	            </div><!-- /.col -->
	            <div class="col-xs-4">
	              <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="submit">Sign In</button>
	            </div><!-- /.col -->
	          </div>
	        </form>
		</div>
	</div>
</div>
