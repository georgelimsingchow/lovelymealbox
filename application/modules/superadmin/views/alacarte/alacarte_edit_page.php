<?php $explode = explode(",", $alacarte->availability); ?>
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

              <h3 class="box-title">Alacarte </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form role="form" action="<?= base_url('superadmin/alacarte/edit'); ?>?id=<?= $this->input->get('id');?>" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label>English Name</label>
                  <input type="text" class="form-control" value="<?= $alacarte->menu_english;?>" name="menu_english">
                </div>
                <div class="form-group">
                  <label>Chinese Name</label>
                  <input type="text" class="form-control" value="<?= $alacarte->menu_chinese;?>" name="menu_chinese">
                </div>
                <div class="form-group">


                <label>Availibility</label>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="1" <?php if (in_array("1", $explode)) { echo "checked";} ?>>Monday</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="2" <?php if (in_array("2", $explode)) { echo "checked";} ?>>Tuesday</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="3" <?php if (in_array("3", $explode)) { echo "checked";} ?>>Wednesday</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="4" <?php if (in_array("4", $explode)) { echo "checked";} ?>>Thursday</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="5" <?php if (in_array("5", $explode)) { echo "checked";} ?>>Friday</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="6" <?php if (in_array("6", $explode)) { echo "checked";} ?>>Saturday</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="availibility[]" value="7" <?php if (in_array("7", $explode)) { echo "checked";} ?>>Sunday</label>
                  </div>                  




                </div>

                <div class="form-group">
                <label>Status</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="1" <?= set_value('status', $alacarte->status) == 1 ? "checked" : "";?>>
                      Yes
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" value="0" <?= set_value('status', $alacarte->status) == 0 ? "checked" : "";?>>
                      No
                    </label>
                  </div>


                   
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

              


            </div>
            <!-- /.box-body -->


          </div>          
        </section>
          
        </div>


        </section><!-- /.content -->