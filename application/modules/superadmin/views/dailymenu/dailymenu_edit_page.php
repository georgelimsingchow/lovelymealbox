        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Menu
            <small><?= $dailymenu['slug'];  ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Widgets</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-warning"></i>
                  <h3 class="box-title">Daily Menu List</h3>

                </div>

            <div class="box-body">
<ul class="todo-list ui-sortable connectedSortable" id="editdailymenu">
            <?php $decoded_menu = json_decode($dailymenu['picked_menu']) ?>
            <?php foreach ($decoded_menu as $id => $number): ?>
              <?php $data = get_food_type($number);?>
                 <li id="<?= $number;  ?>" class="list">
                  <!-- drag handle -->
                      <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>

                  <!-- todo text -->
                  <span class="text"><?= $data->menu_chinese?> <?= $data->menu_english;?></span>
                  <!-- Emphasis label -->
                  <?php if ($data->type == 'meat') { ?>
                    <small class="label label-danger"> <?= $data->type; ?></small>
                  <?php } else { ?>
                    <small class="label label-success"> <?= $data->type; ?></small>
                 <?php } ?>
                   
                  
                  
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-trash-o" data-id="<?= $number; ?>"></i>
                  </div>
                </li>            
            <?php endforeach ?>                
              </ul>
            </div>
              <div class="box-footer">
              <a href="<?= base_url('superadmin/dailymenu');?>" class="btn btn-default">Back</a>
                <button id="dailymenu_update" type="submit" class="btn btn-info pull-right">Update</button>
              </div>


            </div>
              </div><!-- /.box -->
            <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <i class="fa fa-warning"></i>
                  <h3 class="box-title">Menu List</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
                </div>
            <div class="box-body">
              <ul class="todo-list ui-sortable connectedSortable" id="menulist">
                <?php foreach ($food_menu_list as $k => $v): ?>
                     <li id="<?= $v['id'];  ?>" class="list">
                      <!-- drag handle -->
                          <span class="handle ui-sortable-handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                          </span>
                      <!-- todo text -->
                      <span class="text"><?= $v['menu_chinese'];?> <?= $v['menu_english'];?></span>
                      <!-- Emphasis label -->
                      <?php if ($v['type'] == 'meat') { ?>
                        <small class="label label-danger"> <?= $v['type']; ?></small>
                      <?php } else { ?>
                        <small class="label label-success"> <?= $v['type']; ?></small>
                     <?php } ?>               
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <i class="fa fa-trash-o" data-id="<?=  $v['id']; ?>"></i>
                      </div>
                    </li>            
                <?php endforeach ?>                
              </ul>
            </div>
            </div>
              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->
