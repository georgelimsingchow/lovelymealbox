<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form class="well col-md-12" method="post" action="<?php echo base_url('login/do_reset_password')?>">
                <?php $success_send = $this->session->flashdata('success_send'); ?>
                <?php if(isset($success_send)){ ?>
                    <div class="alert alert-success"><?php echo $success_send;?></div>
                <?php }?>
				
					<div class="form-group">
					    <label>Your Email</label>
					    <input type="email" class="form-control" value="<?php echo $this->input->post_get('e') ? $this->input->post_get('e') : $this->input->post_get('email') ?>" disabled>
					    <input type="hidden" name="email" value="<?php echo $this->input->post_get('e') ? $this->input->post_get('e') : $this->input->post_get('email') ?> ">
					    <input type="hidden" name="code" value="<?php echo $this->input->post_get('c') ? $this->input->post_get('c') : $this->input->post_get('code') ?>">
					</div>

					<div class="form-group">
					    <label>Password</label>
					    <input type="password" class="form-control" name="password">
                        <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
					</div>

					<div class="form-group">
					    <label>Re Password</label>
					    <input type="password" class="form-control" name="repassword">
                        <?php echo form_error('repassword', '<p class="text-danger">', '</p>'); ?>
					</div>

					<button class="btn  btn-success" name="submit" value="submit">Set My Password</button>
                    <a href="<?php echo base_url();?>" class="btn  btn-danger">Cancel</a>
				</form>				

			</div>
		</div>
	</div>
</section>