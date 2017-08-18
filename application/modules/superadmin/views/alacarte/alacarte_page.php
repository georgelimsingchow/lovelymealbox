        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->


        <div class="row">

        <section class="col-md-12">
<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Alacarte List</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
<table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Day</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <?php foreach ($alacarte_list as $key => $v): ?>
                <tr>
                  <td><?= $key+1; ?></td>
                  <td>
                  	English : <strong><?= $v['menu_english']; ?></strong><br>
                  	Chinese : <strong><?= $v['menu_chinese']; ?></strong>
                  </td>
                  <td>
                    <?= $v['availability']; ?>
                  </td>
                  <td>
                  <?php if ($v['status'] == '1'): ?>
                  	 <span class="badge bg-green">YES</span>
                  <?php else: ?>
                  	<span class="badge bg-red">NO</span>
                  <?php endif ?>
                  	
                 </td>
                  <td><a href="<?= base_url('superadmin/alacarte/edit');?>?id=<?= $v['id']; ?>">Edit</a></td>
                </tr>                	
                <?php endforeach ?>




              </tbody></table>

              


            </div>
            <!-- /.box-body -->

            <div class="box-footer clearfix no-border">
 <button type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>          
        </section>
          
        </div>


        </section><!-- /.content -->