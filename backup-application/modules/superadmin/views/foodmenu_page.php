        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Food Menu
            <small>preview of simple tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <a href="<?php echo base_url();?>superadmin/foodmenu/add" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>ID</th>
                      <th>Chinese Name</th>
                      <th>English Name</th>
                      <th>Type</th>
                      <th>Shown</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach ($food_menu as $key => $value) { ?>
                    	<tr>
                    		<td><?php echo $key+1; ?></td>
                    		<td><?php echo $value['menu_chinese']; ?></td>
                    		<td><?php echo $value['menu_english']; ?></td>
                    		<td>
                    			<?php if ($value['type'] == 'meat') 
                    			{
                    				echo "<span class='badge bg-red'>".strtoupper($value['type'])."</span>";
                    			}else{
                    				echo "<span class='badge bg-green'>".strtoupper($value['type'])."</span>";
                    			}
                    			?>
                    		</td>
                    		<td><?php if ($value['status'] == '1'){echo "ON";}else{echo "OFF";}?></td>
                    		<td><?php echo $value['create_date']; ?></td>
                    		<td>
                    			<a href="<?php echo base_url();?>superadmin/foodmenu/edit/<?php echo $value['id']; ?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                      			<a href="<?php echo base_url();?>superadmin/foodmenu/delete/<?php echo $value['id']; ?>" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
                    		</td>
                    	</tr>
                    <?php }?>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->