<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form class="well col-md-12" method="post" action="<?php echo base_url('login/reset_password')?>">
                <?php $success_send = $this->session->flashdata('success_send'); ?>
                <?php if(isset($success_send)){ ?>
                    <div class="alert alert-success"><?php echo $success_send;?></div>
                <?php }?>
				
					<div class="form-group">
					    <label>Email</label>
					    <input type="email" class="form-control" name="email">
                        <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
					</div>

					<button class="btn  btn-success" name="submit" value="submit">Reset</button>
                    <a href="<?php echo base_url();?>" class="btn  btn-danger">Cancel</a>
				</form>				

			</div>
		</div>
	</div>
</section>