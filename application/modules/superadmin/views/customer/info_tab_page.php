<div class="active tab-pane" id="general">
<form class="form-horizontal">
  <div class="form-group">
    <label class="col-sm-2 control-label">Account No</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $cdata->account_no;?>" disabled>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">First Name</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="First Name" value="<?php echo $cdata->first_name;?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Last Name</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $cdata->last_name;?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">E-Mail</label>

    <div class="col-sm-10">
      <input type="email" class="form-control" placeholder="E-Mail" value="<?php echo $cdata->email;?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">FB E-mail</label>

    <div class="col-sm-10">
      <input type="email" class="form-control" placeholder="FB E-Mail" value="<?php echo $cdata->fb_email;?>" disabled>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">FB ID</label>

    <div class="col-sm-10">
    <?php if (!empty($cdata->fb_id)) {  ?>
      <p class="help-block"><a target="_blank" href="http://www.facebook.com/<?php echo $cdata->fb_id;?>">Facebook Profile</a></p>
    <?php }else{ ?>
      <p class="help-block">Not connected to Facebook</p>
    <?php } ?>  
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Mobile No</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Mobile No" value="<?php echo $cdata->phone;?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Status</label>

    <div class="col-sm-10">
      <select class="form-control">
        <option>On</option>
        <option>Off</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger">Submit</button>
    </div>
  </div>
</form>
</div>