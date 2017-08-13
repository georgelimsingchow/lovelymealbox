<section>
	<div class="container">
	<?php 
		$contact_message = $this->session->flashdata('flsh_msg');
	if (isset($contact_message)) {?>
		<div class="row">
			<div class="alert alert-success" role="alert">Message has been sent!</div>
		</div>
	<?php }; ?>


		<div class="row">
			<form class="well col-md-12" action="<?php echo base_url()?>contact/send" method="POST">
				<div class="row">
					<div class="col-md-3">
					  <div class="form-group">
					    <label>Name</label>
					    <input type="text" class="form-control" name="name" placeholder="Mr John King" value="<?php echo set_value('name'); ?>">
					    <?php echo form_error('name', '<p class="text-danger">', '</p>'); ?>
					  </div>
					  <div class="form-group">
					    <label>Email</label>
					    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
					    <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
					  </div>
					  <div class="form-group">
					    <label>Phone</label>
					    <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo set_value('phone'); ?>">
					    <?php echo form_error('phone', '<p class="text-danger">', '</p>'); ?>
					  </div>
					    <div class="form-group">
					    <label>Subject</label>
					    <input type="text" class="form-control" name="subject" placeholder="Inquiry" value="<?php echo set_value('subject'); ?>">
					    <?php echo form_error('subject', '<p class="text-danger">', '</p>'); ?>
					  </div>
					</div>
					<div class="col-md-5">
					    <div class="form-group">
					    	<label>Messsage</label>
					    	<textarea class="form-control" rows="7" name="message" placeholder="Leave message here" ><?php echo set_value('message'); ?></textarea>
					    	<?php echo form_error('message', '<p class="text-danger">', '</p>'); ?>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-6">
					  			<div class="g-recaptcha" data-sitekey="6LeAfwsUAAAAAKHiedIgyfbW916yYJ_QUm7tn9wJ"></div>
					  			<?php echo form_error('g-recaptcha-response', '<p class="text-danger">', '</p>'); ?>
					  		</div>
					  		<div class="col-md-6">
					  			<button class="btn btn-primary pull-right">SUBMIT</button>
					  		</div>
					  	</div>

					  	
					</div>
					<div class="col-md-3">
					<label>Contact Info</label>
		                    <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;010 975 3899</p>
		                    <p><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp;010 975 3899</p>
		                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp;info@lovelymealbox.com</p>
					  </div>					
						
					</div>
				</div>
			</form>
		</div>
	</div>
</section>