        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Menu
            <small>Today is <?php echo date("l Y-m-d");?></small>
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
                </div><!-- /.box-header -->
                  <div class="box-body" id="pickedmenu_form">
                  <div class="form-group">
                    <label>Pick Date</label>
                    <?php echo form_dropdown('food_date', $select_date,'','class="form-control" id="food_date"');?>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                  <label>Picked Menu</label>
                  <ul class="todo-list ui-sortable connectedSortable" id="pickedmenu">               
                  </ul>                    
                  </div>

              <div class="row">
              <div class="col-xs-3">
                <div class="form-group" id="status">
                  <label for="food-status">Status</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="1">ON
                      </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="0">OFF
                    </label>
                  </div>
                </div>                
              </div>
              <div class="col-xs-3">
                 <div class="form-group" id="session">
                  <label for="food-session">Session</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="session" value="lunch">LUNCH</label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="session" value="dinner">DINNER</label>
                  </div>
                </div>               
              </div> 
              </div>
             </div><!-- /.box-body -->
              <div class="box-footer">
              <a href="<?= base_url('superadmin/dailymenu');?>" class="btn btn-default">Back</a>
              <button type="submit" class="btn btn-primary pull-right" name="submit" id="dailymenu_add">Add</button>
                <a href="<?= base_url('superadmin/dailymenu/add');?>" class="btn btn-default pull-right" style="margin-right: 5px;">Reset</a>
                
              </div>

              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Menu List</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" class="form-control pull-right" id="menu_search">
                </div>
              </div>
                </div><!-- /.box-header -->

                  <div class="box-body">

              <ul class="todo-list ui-sortable connectedSortable" id="menulist">
                <?php foreach ($food_menu_list as $k => $v): ?>
                     <li id="<?= $v['id']; ?>" class="list" data-english="<?= trim($v['menu_chinese']." ".strtoupper($v['menu_english'])); ?>">
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
                    </li>            
                <?php endforeach ?>                
              </ul>


                  </div><!-- /.box-body -->



              </div><!-- /.box -->
            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->
