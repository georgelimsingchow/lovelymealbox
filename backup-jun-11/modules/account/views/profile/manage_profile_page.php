<div class="container">
    <div class="row">
     <ol class="breadcrumb brand-danger">
      <li><a href="<?php echo base_url();?>home">Home</a></li>
      <li><a href="<?php echo base_url();?>account">Account</a></li>
      <li class="active">Change your details</li>
    </ol>
  </div>
	<div class="row">
   		<hr>
      <?php echo $this->session->flashdata('flsh_msg'); ?>
      <?php $msg = $this->session->flashdata('msg'); ?>
        <?php if(isset($msg)){ ?>
            <div class="alert alert-warning"><?php echo $msg;?></div>
        <?php }?>
   		<form class="form-horizontal" action="<?php echo base_url();?>account/profile" method="post">
          <div class="form-group">
            <label for="fname" class="col-sm-2 control-label">First name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $this->mdl_usermodel->getFirstName(); ?>" placeholder="[First name]" >
              <?php echo form_error('fname', '<p class="text-danger">', '</p>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="lname" class="col-sm-2 control-label">Last name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lname"  name="lname" value="<?php echo $this->mdl_usermodel->getLastName(); ?>" placeholder="[Surname] or [Last name]">
              <?php echo form_error('lname', '<p class="text-danger">', '</p>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="the_email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="the_email" name="email" value="<?php echo $this->mdl_usermodel->getEmail(); ?>" placeholder="[Email]">
            <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="the_mobile" class="col-sm-2 control-label">Mobile no.</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="the_mobile" name="mobile" value="<?php echo $this->mdl_usermodel->getPhone(); ?>" placeholder="[Mobile number] e.g 012-3456789">
            <?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
            </div>
          </div>
          <div class="clearfix">
            <button type="submit" class="btn btn-primary pull-right" name="submit" value="submit">CONTINUE</button>
          </div>           
   		</form>
         
	</div>
  <div class="row">
      <hr>
      <form class="form-horizontal" action="<?php echo base_url();?>account/profile" method="post">
          <div class="form-group">
            <label for="fname" class="col-sm-2 control-label">Login With Facebook</label>
            <div class="col-sm-10">
            <?php $fb_id = $this->mdl_usermodel->getFBID(); ?>
            <?php if($fb_id){?>              
                <a class="btn btn-block btn-social btn-facebook">
                    <span class="fa fa-facebook"></span> Connected
                  </a>
              </div>
             <?php }else{ ?>
                <a href="#" class="btn btn-block btn-social btn-facebook" onClick="connectToFacebook()">
                    <span class="fa fa-facebook"></span> Connect To your Facebook.
                  </a>              
             <?php }?>
            </div>
          </div>        
      </form>         
  </div>
</div>