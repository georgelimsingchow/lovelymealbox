<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/datatables/dataTables.bootstrap.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/admin-main.css">

        <?php $add_box = $this->uri->segment(3);  ?>

    <?php if (($add_box == 'add_box') || ($add_box == 'order_cater_detail') ||($add_box == 'edit_balance')): ?>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
    <?php endif ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo base_url();?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url();?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?> - Director
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url();?>superadmin/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <!-- DASHBOARD -->
            <li class="<?php if($this->uri->segment(2) == 'dashboard'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <!-- FOOD MENU -->
            <li class="<?php if($this->uri->segment(2) == 'foodmenu'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/foodmenu"><i class="fa fa-cutlery"></i> <span>Manage Food Menu</span></a></li>

            <!-- DAILY MENU -->
            <li class="<?php if($this->uri->segment(2) == 'dailymenu'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/dailymenu"><i class="fa fa-cutlery"></i> <span>Manage Daily Menu</span></a></li>

            <!-- CUSTOMER MENU -->
            <li class="<?php if($this->uri->segment(2) == 'customer'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/customer"><i class="fa fa-user"></i> <span>Manage Customer</span></a></li>

            <!-- ORDER -->
            <li class="<?php if($this->uri->segment(2) == 'order'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/order"><i class="fa fa-calculator"></i> <span>Manage Order</span></a></li>
            
                        <!-- ORDER -->
            <li class="<?php if($this->uri->segment(2) == 'reload'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/reload"><i class="fa fa-calculator"></i> <span>Manage Reload</span></a></li>
            <!-- TRANSACTION -->

            <!-- contact -->
            <li class="<?php if($this->uri->segment(2) == 'contact'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/contact"><i class="fa fa-calculator"></i> <span>Contact</span></a></li>
            <!-- contact -->

            <!-- chinese new year -->
            <li class="<?php if($this->uri->segment(2) == 'cny'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/cny"><i class="fa fa-calculator"></i> <span>Chinese New Year</span></a></li>
            <!-- chinese new year -->

            <!-- monthly cater -->
            <li class="<?php if($this->uri->segment(2) == 'monthly_cater'){ echo "active";}else{ echo "";} ;?>"><a href="<?php echo base_url();?>superadmin/monthly_cater"><i class="fa fa-calculator"></i> <span>Monthly Cater</span></a></li>
            <!-- monthly cater -->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cutlery"></i> <span>Transaction</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Manage Transaction</a></li>
              </ul>
            </li>
            <!-- testing dynamic menu php -->


            <!-- testing dynamic menu php order, product , sales , transaction-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Sales</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../index.html"><i class="fa fa-circle-o"></i>View Sales</a></li>
              </ul>
            </li>
            <!-- testing dynamic menu php -->
            <li>
              <a href="../calendar.html">
                <i class="fa fa-calendar"></i> <span>SAMPLE</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->
    <div class="content-wrapper">
      <?php if (isset($view_file)) {$this->load->view($view_module.'/'.$view_file);} ?>
    </div>


      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>assets/admin/plugins/select2/select2.full.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url();?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>assets/admin/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url();?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url();?>assets/admin/plugins/chartjs/Chart.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/admin/dist/js/app.js"></script>



    <script type="text/javascript">

    var baseUrl = '<?= base_url('superadmin'); ?>';

    <?php $dailymenu_add = $this->uri->segment(2)."/".$this->uri->segment(3); ?>
    <?php if ($dailymenu_add == 'dailymenu/add'): ?>
        $("#pickedmenu, #menulist").sortable({
          placeholder: "sort-highlight",
          connectWith: ".connectedSortable",
          handle: ".handle",
          forcePlaceholderSize: true,
          zIndex: 999999
        });

        var menu_search = $("#menu_search");
        var list_data = $("#menulist li");
      menu_search.keyup(function() {
        filteredtext = menu_search.val().toUpperCase();
        list_data.each(function(){
          var currenttext = $(this).data('english'),
          showCurrentLi = currenttext.indexOf(filteredtext) !== -1;
            $(this).toggle(showCurrentLi);
        });
      });

     $( "#dailymenu_add" ).click(function(event) {
          event.preventDefault();

         var daily_menu = new Array();
          $('#pickedmenu li').each(function(){
              daily_menu.push($(this).attr("id"));
          });

          var status = $('input[name=status]:checked').val();
          var session = $('input[name=session]:checked').val();
          var date = $("#food_date option:selected").val();

          if (typeof(status) === 'undefined') {
            $('#status_error').remove();
            $("#status").append('<span class="help-block error-red" id="status_error">The Status field is required.</span>');            
          }else{
            $('#status_error').remove();
          }

          if (typeof(session) === 'undefined') {
            $('#session_error').remove();
            $("#session").append('<span class="help-block error-red" id="session_error">The Session field is required.</span>');         
          }else{
            $('#session_error').remove();
          }

          if (daily_menu.length == '0') {
            $('#pickedmenu_error').remove();
            $("#pickedmenu").append('<span class="help-block error-red" id="pickedmenu_error">Please Pick Menu</span>'); 
          }else{
            $('#pickedmenu_error').remove();
          }

          if ((typeof(status) !== 'undefined')&&(typeof(session) !== 'undefined')&&(daily_menu.length != '0')) {
          $.ajax({
              type: "POST",
              dataType :'json',
              url: baseUrl+"/dailymenu/ajax_add",
              data: {
                dailymenu: JSON.stringify(daily_menu), 
                status : status, 
                session : session,
                date    : date,
              },
              success: function(data){
                 if (data.status == 'success') {
                    $('.alert').remove();
                    $( "#pickedmenu_form").prepend(
                      '<div class="alert alert-success alert-dismissible">'
                      + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                      + '<h4><i class="icon fa fa-check"></i>  '+data.msg+' !</h4></div>'
                    );
                 }else if (data.status == 'failed'){
                  $('.alert').remove();
                    $( "#pickedmenu_form").prepend(
                      '<div class="alert alert-warning alert-dismissible">'
                      + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                      + '<h4> '+data.msg+' !</h4></div>'
                    );                  
                 }
              }
          });
          }
     });
    <?php endif ?>

    <?php $customer = $this->uri->segment(2); ?>
        <?php if ($customer == 'customer'): ?>

          var t = $("#customer_table").DataTable({
            "paging" : true,
            "autoWidth": false,
            "pageLength": 100,
            "ajax"   : "<?= base_url('superadmin/customer/ajax_customer')?>",
            "pagingType": "simple_numbers",
            "columns" :[
                { "data": null },
                { "data" : "name"},
                { "data" : "account_no"},
                { "data" : "email"},
                { "data" : "customer_id",
                  "render" : function(data,type,full,meta){
                    return '<a href="<?= base_url('superadmin/customer/info?customer_id=')?>'+data+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                  }

              },


            ]
            });
          t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
        <?php endif ?>

    <?php if (isset($dailymenu['picked_menu'])) { ?>

      var original_menu = '<?= $dailymenu['picked_menu'];?>';
      var daily_menu_id = '<?= $this->input->get('id');?>';
      
      $("#editdailymenu, #menulist").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
      });

      $(".fa-trash-o").click(function(event) {
         $(this).closest('.list').remove();          
      });


      $( "#dailymenu_update" ).click(function(event) {
        event.preventDefault();
          var daily_menu = new Array();
          $('#editdailymenu li').each(function(){
              daily_menu.push($(this).attr("id"));
          });


          $.ajax({
              type: "POST",
              dataType :'json',
              url: baseUrl+"/dailymenu/ajax_edit",
              data: {dailymenu: JSON.stringify(daily_menu) , dailymenuid : daily_menu_id },
              success: function(data){
                 if (data.status == 'success') {
                    $('.alert').remove();
                    $( "#editdailymenu").prepend(
                      '<div class="alert alert-success alert-dismissible">'
                      + '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                      + '<h4><i class="icon fa fa-check"></i>  '+data.msg+' !</h4></div>'
                    );
                 }
              }
          });
      });



    <?php } ?>

     
   
  //jQuery UI sortable for the todo list

        //Initialize Select2 Elements

        $(".filter_select").select2();

        $("#select_menu").select2();

        $('#that_day_date, #startDate, #endDate').datepicker({
          todayHighlight: true,
          format: 'yyyy-mm-dd'
        });
        
    </script>

  </body>
</html>
