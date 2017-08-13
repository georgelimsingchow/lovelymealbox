<section class="content-header">
<?php $customer_id = '?customer_id='.$this->input->get('customer_id')?>  
  <h1>Customer Table</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Simple</li>
  </ol>
  <!-- <div class="pull-right"><button type="submit" class="btn btn-danger">Submit</button></div> -->
</section>

<section class="content">
          <div class="row">
<div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if($this->uri->segment(3) == 'info')echo 'active';?>"><a href="<?php echo base_url('superadmin/customer/info').$customer_id;?>">Info</a></li>
              <li class="<?php if($this->uri->segment(3) == 'order')echo 'active';?>"><a href="<?php echo base_url('superadmin/customer/order').$customer_id;?>">Order</a></li>
              <li class="<?php if($this->uri->segment(3) == 'reload')echo 'active';?>"><a href="<?php echo base_url('superadmin/customer/reload').$customer_id;?>">Reload</a></li>
              <li class="<?php if($this->uri->segment(3) == 'address')echo 'active';?>"><a href="<?php echo base_url('superadmin/customer/address').$customer_id;?>">Address</a></li>
            </ul>
            <div class="tab-content">
            <?php if (isset($tab)) {$this->load->view($view_module.'/'.$tab);} ?>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>          
          </div><!-- /.row -->
        </section>