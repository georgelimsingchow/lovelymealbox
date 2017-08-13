<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Manage Daily Menu
    <small><?php echo date("l Y-m-d");?></small>
  </h1>

</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
			<a href="<?php echo base_url();?>superadmin/dailymenu/add" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</a>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
          	<tbody>
          	<tr>
          		<th>#</th>
          		<th class="text-center">Menu Date</th>
          		<th class="text-center">Meal</th>
              <th class="text-center">Session</th>
          		<th class="text-center">Expiry Date</th>
          		<th class="text-center">Action</th>
          	</tr>
          	<?php foreach ($daily_menu_array as $key => $v) { ?>
          	<tr>
          		<td><?php echo $key+1; ?></td>
        		<td class="text-center"><?= date("Y-M-d (D)", strtotime($v['menu_date'])); ?></td>
            	<td ><ol>
            		<?php $mv_array = json_to_array(json_decode($v['picked_menu'],true));  

                  foreach ($mv_array as $k => $sv) {
                    if ($k == 'meat') {
                      foreach ($sv['cn'] as $ek => $ev) {
                        echo "<li><span class='label label-danger'>".$ev." (".$ek.")"."</span></li>";
                      }
                    }else{
                      foreach ($sv['cn'] as $ek => $ev) {
                        echo "<li><span class='label label-success'>".$ev." (".$ek.")"."</span></li>";
                      }                    
                    }
                    }	
            		?></ol>
            	</td>
              <td class="text-center"><?= $v['session']; ?></td>
        		<td class="text-center"><?= date("Y-M-d H:i (D)", strtotime($v['expire_date'])); ?></td>
        		<td class="text-center"><a href="<?= base_url("superadmin/dailymenu/edit?id=$v[id]");?>">Edit</a></td>
          	</tr>
          	<?php }?>
          	</tbody>
          </table>
        </div><!-- /.box-body -->
		<div class="box-footer clearfix">
			<a href="<?= base_url();?>superadmin/dailymenu/add" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</a>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

</section><!-- /.content -->
