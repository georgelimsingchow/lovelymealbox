<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Manage Daily Menu
    <small><?php echo date("l Y-m-d");?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Widgets</li>
  </ol>
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
          		<th class="text-center">Meat</th>
              <th class="text-center">Vege</th>
          		<th class="text-center">Expiry Date</th>
              <th class="text-center">Created Date</th>
          		<th class="text-center">Action</th>
          	</tr>
          	<?php foreach ($daily_menu_array as $key => $value) { ?>
          	<tr>
          		<td><?php echo $key+1; ?></td>
        		<td class="text-center"><?php echo date("Y-M-d (D)", strtotime($value['menu_date'])); ?></td>
            	<td><ol>
            		<?php 
            			$mv_array = json_to_array_english(json_decode($value['picked_menu'],true)); 
                  // print_r($mv_array);exit();
            			
    						foreach ($mv_array as $k => $v) {
    							if ($k == 'meat') {
    								foreach ($v as $v_k => $v_v) {
    									echo "<li><span class='label label-danger'>".$v_v." (".$v_k.")"."</span></li>";
    								}        								
    							}
    						}
            		?></ol>
            	</td>
              <td><ol>
                <?php 
                 foreach ($mv_array as $k => $v) {
                    if ($k == 'vege') {
                      foreach ($v as $v_k => $v_v) {
                        echo "<li><span class='label label-success'>".$v_v." (".$v_k.")"."</span></li>";
                      }                       
                    }
                  }
                ?></ol>
              </td>
        		<td class="text-center"><?php echo date("Y-M-d H:i (D)", strtotime($value['expire_date'])); ?></td>
            <td class="text-center"><?php echo $value['create_date']; ?></td>
        		<td class="text-center">Edit</td>
          	</tr>
          	<?php }?>
          	</tbody>
          </table>
        </div><!-- /.box-body -->
		<div class="box-footer clearfix">
			<a href="<?php echo base_url();?>superadmin/dailymenu/add" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</a>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

</section><!-- /.content -->