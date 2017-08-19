<section class="content-header">
          <h1>
            Add Catering
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>
<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
      </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Start Date</th>
              <th>Duration</th>
              <th>Total Price</th>
              <th>Pax</th>
              <th>Session</th>
              <th>Times</th>
              <th>Comment</th>                                   
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cater_detail as $key => $v) { ?>
              <tr>
                <td><?= substr($v['start_date'], 0,-9)?></td>
                <td>
                  <?php $day_range = json_decode($v['day_range'],TRUE); ?>
                    <?= implode(" , ", $day_range); ?>                                    
                </td>
                <td>RM <?= $v['fee']?></td>
                <td><?= $v['pax']?></td>      
                <td>
                <?php $session = json_decode($v['session'],TRUE); ?>
                    <?= implode(" , ", $session); ?>                   
                </td>
                <td><?= $v['credit']?></td>         
                <td><?= $v['comment']?></td>
              </tr>
            <?php  }?>
            </tbody>
          </table>
        </div><!-- /.box-body -->


    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
      </div><!-- /.box-header -->
        <form role="form" action="<?php echo base_url('superadmin/monthly_cater/add_cater_detail');?>?id=<?php echo $cater['id']?>" method="post" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label  class="col-sm-2 control-label">Name</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" value="<?php echo $cater['name']?>" disabled>
              <input type="hidden" value="<?php echo $cater['id']?>" name="cater_id">
            </div>
          </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Start Date:</label>
              <div class="col-sm-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="startDate" name="start_date" value="<?= set_value('start_date')?>">
                </div>
                <?php echo form_error('start_date', '<span class="help-block error-red">', '</span>'); ?>
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">End Date:</label>
              <div class="col-sm-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="endDate" name="end_date" value="<?= set_value('end_date')?>">
                </div>
                <?php echo form_error('end_date', '<span class="help-block error-red">', '</span>'); ?>
              </div>
                <!-- /.input group -->
              </div>

          <div class="form-group">
            <label  class="col-sm-2 control-label">Day</label>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
              <div class="checkbox">
                <label><input type="checkbox" name=day[] value="1">Monday</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" name=day[] value="2">Tuesday</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" name=day[] value="3">Wednesday</label>
              </div>                  
                </div>
                <div class="col-sm-6">
              <div class="checkbox">
                <label><input type="checkbox" name=day[] value="4" >Thursday</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" name=day[] value="5" >Friday</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" name=day[] value="6" >Saturday</label>
              </div>                  
                </div>
              </div>


              <?php echo form_error('day[]', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Session</label>
            <div class="col-sm-6">            
              <div class="checkbox">
                <label><input type="checkbox" name=session[] value="lunch" >Lunch</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" name=session[] value="dinner" >Dinner</label>
              </div>
              <?php echo form_error('session[]', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Qty</label>
            <div class="col-sm-6">
              <input type="text" class="form-control"  placeholder="e.g 22 times" name="qty" value="<?php echo set_value('qty')?>">
              <?php echo form_error('qty', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Pax</label>
            <div class="col-sm-6">
              <select class="form-control" name="pax">
                <option <?php echo  set_select('pax', '1'); ?>>1</option>
                <option <?php echo  set_select('pax', '2'); ?>>2</option>
                <option <?php echo  set_select('pax', '3'); ?>>3</option>
                <option <?php echo  set_select('pax', '4'); ?>>4</option>
                <option <?php echo  set_select('pax', '5'); ?>>5</option>
                <option <?php echo  set_select('pax', '6'); ?>>6</option>
                <option <?php echo  set_select('pax', '7'); ?>>7</option>
                <option <?php echo  set_select('pax', '8'); ?>>8</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Fee</label>
            <div class="col-sm-6">
              <input type="text" class="form-control"  placeholder="280" name="fee" value="<?php echo set_value('fee')?>">
              <?php echo form_error('fee', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="3" placeholder="shw wants rice" name="comment"></textarea>
            </div>
          </div>

        </div><!-- /.box-body -->
        <div class="box-footer">
        <a href="<?php echo base_url('superadmin/monthly_cater');?>" class="btn btn-danger">Back</a>
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        </div>
      </form>
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->



</section>