<?php $img_url = "http://www.theultimatecatwebsite.com/uploads/1/1/0/8/11083235/9880144_orig.jpg"; ?>

<section id="slider">
  <div class="container">
    <div class="row">
      <div class="col-md-12">      
            <div class="row">
            <div class="col-md-12">
                  <div id="owl-example1" class="owl-carousel">
                    <div><a href="<?php echo base_url();?>how/reload"><img src="<?php echo base_url();?>assets/images/home_slider/banner_1.jpg" class="img-responsive"></a></div>
                    <div><img src="<?php echo base_url();?>assets/images/home_slider/banner_2.jpg" class="img-responsive"></div>
                    <div><img src="<?php echo base_url();?>assets/images/home_slider/banner_3.jpg" class="img-responsive"></div>
                    <div><img src="<?php echo base_url();?>assets/images/home_slider/banner_4.jpg" class="img-responsive"></div>


                </div>
            </div>
            </div>
      </div>
    </div>
  </div>
</section>
<section id='daily_menu'>
  <div class="container">
  <div class="row text-center" id="menu">
    <div class="col-md-9">
      <div class="row">
        <div class="col-lg-4 LR_margin_5 column">
          <img src="<?php echo base_url();?>assets/images/column/credit.jpg" class="img-responsive">
          </div>
        <div class="col-lg-4 LR_margin_5 column">
          <img src="<?php echo base_url();?>assets/images/column/dish.jpg" class="img-responsive">
          </div>
        <div class="col-lg-4 LR_margin_5 column">
        <img src="<?php echo base_url();?>assets/images/column/vacancy.jpg" class="img-responsive">
        </div>        
      </div>
      <div class="row">
        <h3>菜单 MENU</h3>
        <hr>
              <?php $counter = 1;?>
              <?php $launch_date = "2010-11-13 00:00:00";?>
              <?php foreach ($daily_menu_details as $key => $value) { ?>
              <?php $subdate = $value['sub_date'];?>
                <div class="col-xs-12 col-sm-12 col-md-4 LR_margin_5">
                  <div class="food-item">
                    <div class="food-head">
                      <h4><?php echo $key; ?></h4>
                      <small><?php echo $subdate; ?></small>
                      <br>
                      <?php if (isset($value['0']['menu_last_date'])) { ?>
                        <small>Expire : <?php echo $value['0']['menu_last_date'];?></small>
                      <?php }?>              
                    </div>
                    <?php if (!empty($value['0'])) { ?>
                        <div class="food-content">
                          <?php $eng_menu = json_to_array(json_decode($value['0']['picked_menu'],true)) ;?>
                            <?php foreach ($eng_menu['meat']['eng'] as $emk => $emv) { ?>
                            <div class="item"><?php echo $eng_menu['meat']['cn'][$emk];?><br><?php echo $emv;?></div>
                            <?php }?>
                            <?php foreach ($eng_menu['vege']['eng'] as $emk => $emv) { ?>
                            <div class="item"><?php echo $eng_menu['vege']['cn'][$emk];?><br><?php echo $emv;?></div>
                            <?php }?>
                          <div class="item">
                          <?php $customer_id = $this->session->userdata('customer_id');?>
                          <?php if($customer_id == '2' || $customer_id == '1'){ ?>
                              <a href='<?php echo base_url();?>order/date/<?php echo $subdate; ?>' class="btn btn-danger btn-block">订购 ORDER</a>                                                    
                            <?php }else{ ?>
                            <a class="btn btn-danger btn-block disabled">COMING SOON</a> 
                            <?php } ?>
                            </div>
                        </div>                 
                    <?php }else{ ?>
                      <div class="food-content">
                        <div class="item">NOT AVAILABLE</div>
                      </div> 
                    <?php } ?>
                  </div>
                </div>
                <?php $counter++;?>
                <?php if (($counter % 4) == 0) {?>
                  <div class="clearfix"></div>
                <?php } ?>
              <?php } ?>        
      </div>

      

    </div>
    <div class="col-md-3">
    <?php $ttt = "http://placehold.it/800x800/795548";?>
      <div class="row">
        <div class="col-md-12 advertising"><img src="<?php echo base_url();?>assets/images/advertisement/ad.jpg" class="img-responsive"></div>
        <div class="col-md-12 advertising"><img src="<?php echo base_url();?>assets/images/advertisement/ad.jpg" class="img-responsive"></div>
        <div class="col-md-12 advertising"><img src="<?php echo base_url();?>assets/images/advertisement/ad.jpg" class="img-responsive"></div>
        <div class="col-md-12 advertising"><img src="<?php echo base_url();?>assets/images/advertisement/ad.jpg" class="img-responsive"></div>
      </div>

      
    </div>
  </div>    

  </div>

</section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <img src="<?php echo base_url();?>assets/images/how.jpg" class="img-responsive">
        </div>
      </div>
    </div>
  </section>