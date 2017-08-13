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
        <form role="form" action="<?php echo base_url('superadmin/monthly_cater/add_cater_detail');?>?id=<?php echo $cater['id']?>" method="post" class="form-horizontal">
        <div class="box-body">
          <div class="form-group">
            <label  class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="<?php echo $cater['name']?>" disabled>
              <input type="hidden" value="<?php echo $cater['id']?>" name="cater_id">
            </div>
          </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Start Date:</label>
              <div class="col-sm-4">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="startDate" name="start_date" value="<?php echo set_value('start_date')?>">
                </div>
                <?php echo form_error('start_date', '<span class="help-block error-red">', '</span>'); ?>
              </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">End Date:</label>
              <div class="col-sm-4">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="endDate" name="end_date" value="<?php echo set_value('end_date')?>">
                </div>
                <?php echo form_error('end_date', '<span class="help-block error-red">', '</span>'); ?>
              </div>
                <!-- /.input group -->
              </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">From</label>
            <div class="col-sm-4">
              <select class="form-control" name="from_day">
                <option <?php echo  set_select('from_day', 'MON'); ?>>MON</option>
                <option <?php echo  set_select('from_day', 'TUE'); ?>>TUE</option>
                <option <?php echo  set_select('from_day', 'WED'); ?>>WED</option>
                <option <?php echo  set_select('from_day', 'THU'); ?>>THU</option>
                <option <?php echo  set_select('from_day', 'FRI'); ?>>FRI</option>
                <option <?php echo  set_select('from_day', 'SAT'); ?>>SAT</option>
                <option <?php echo  set_select('from_day', 'SUN'); ?>>SUN</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">To</label>
            <div class="col-sm-4">
              <select class="form-control" name="to_day">
                <option <?php echo  set_select('to_day', 'MON'); ?>>MON</option>
                <option <?php echo  set_select('to_day', 'TUE'); ?>>TUE</option>
                <option <?php echo  set_select('to_day', 'WED'); ?>>WED</option>
                <option <?php echo  set_select('to_day', 'THU'); ?>>THU</option>
                <option <?php echo  set_select('to_day', 'FRI'); ?>>FRI</option>
                <option <?php echo  set_select('to_day', 'SAT'); ?>>SAT</option>
                <option <?php echo  set_select('to_day', 'SUN'); ?>>SUN</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Session</label>
            <div class="col-sm-4">
              <select class="form-control" name="session">
                <option <?php echo  set_select('session', 'LUNCH'); ?>>LUNCH</option>
                <option <?php echo  set_select('session', 'DINNER'); ?>>DINNER</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Pax</label>
            <div class="col-sm-4">
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
            <div class="col-sm-4">
              <input type="text" class="form-control"  placeholder="280" name="fee" value="<?php echo set_value('fee')?>">
              <?php echo form_error('fee', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="radio">
                <label>
                  <input type="radio" name="tingkat" value="YES">
                  Tingkat - YES
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="tingkat" value="NO">
                  Tingkat - NO
                </label>
              </div>
              <?php echo form_error('tingkat', '<span class="help-block error-red">', '</span>'); ?>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-4">
              <textarea class="form-control" rows="3" placeholder="shw wants rice" name="comment"></textarea>
            </div>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Id</th>
              <th>Pax</th>
              <th>Total Price</th>
              <th>Day</th>
              <th>Duration</th>
              <th>Comment</th>                      
              <th>Create Date</th>
              
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cater_detail as $key => $v) { ?>
              <tr>
                <td><?php echo $v['cater_detail_id']?></td>
                <td><?php echo $v['pax']?></td>
                <td>RM <?php echo $v['fee']?></td>
                <td><?php echo $v['from_day']?> to <?php echo $v['to_day']?></td>
                <td><?php echo substr($v['start_date'], 0,10); ?> to <?php echo substr($v['end_date'],0,10); ?></td>                      
                
                <td><?php echo $v['comment']?></td>
                <td><?php echo $v['create_date']?></td>
              </tr>
            <?php  }?>
            </tbody>
          </table>
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