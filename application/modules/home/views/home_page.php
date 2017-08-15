<section>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h4 class="text-center" style="color: #c22026">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Order closing time at 9:00 PM
        </h4>
      </div>
      <div class="col-md-6">
        <h4 class="text-center" style="color: #c22026">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Mon ~ Sat (Including Public Holiday)
        </h4>
      </div>
    </div>
  </div>
</section>

<section id="slider">
  <div class="container">
    <div class="row">
      <div class="col-md-12">      
            <div class="row">
            <div class="col-md-12">
                  <div id="owl-example1" class="owl-carousel">
                  <div><img src="<?php echo base_url();?>assets/images/alacarte.jpg" class="img-responsive"></div>
                  <div><img src="<?php echo base_url();?>assets/images/package.jpg" class="img-responsive"></div>             
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
    <div class="col-md-12">
      <div class="row">
        <h3>菜单 MENU</h3>
        <hr>
              <?php $counter = 1;?>
              <?php foreach ($daily_menu_details as $key => $value) { ?>
              <?php $subdate = $value['sub_date'];?>
                <div class="col-xs-12 col-sm-12 col-md-4 LR_margin_5">

                  <div class="food-item">
                    <div class="food-head">
                      <h4><?php echo $key; ?></h4>
                      <small><?php echo $subdate; ?></small>
                      <br>            
                    </div>
                <div class="panel-heading">
                  <ul class="nav nav-pills nav-justified">
                      <li class="active"><a href="#tab<?php echo $subdate; ?>1" data-toggle="tab">LUNCH</a></li>
                      <li><a href="#tab<?php echo $subdate; ?>2" data-toggle="tab">DINNER</a></li>
                  </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab<?php echo $subdate; ?>1">
                    <?php if (!empty($value['lunch'])) { ?>
                    <?php $decoded_lunch = json_decode($value['lunch']['picked_menu']) ?>
                        <div class="food-content">
                        <table class="table table-bordered">
                            <tbody>
                            <?php foreach ($decoded_lunch as $id => $number): ?>
                              <?php $data = get_food_type($number);?>
                              <tr>
                                <td><?php echo $id+1 ?></td>
                                <td><?php echo $data->menu_chinese."<br>".$data->menu_english;?></td>
                              </tr>                              
                            <?php endforeach ?>
                              <tr>
                                <td colspan=2>
                                  <a href="<?php echo base_url();?>lunch?date=<?php echo $subdate; ?>" class="btn btn-danger btn-block">订购 ORDER</a>
                                </td>
                              </tr>
                            </tbody>  
                        </table>
                        </div>                 
                    <?php }else{ ?>
                      <div class="food-content">
                        <div class="item">
                        <?php if ($subdate == '2017-05-01') { ?>
                          PUBLIC HOLIDAY <br> LABOUR DAY
                        <?php }else{ ?>

                        NOT AVAILABLE
                          <?php } ?>
                        </div>
                      </div> 
                    <?php } ?>

                        </div>
                        <div class="tab-pane fade" id="tab<?php echo $subdate; ?>2">
                    <?php if (!empty($value['dinner'])) { ?>
                    <?php $decoded_dinner = json_decode($value['dinner']['picked_menu']) ?>
                        <div class="food-content">
                        <table class="table table-bordered">
                            <tbody>
                            <?php foreach ($decoded_dinner as $id => $number): ?>
                              <?php $data = get_food_type($number);?>
                              <tr>
                                <td><?php echo $id+1 ?></td>
                                <td><?php echo $data->menu_chinese."<br>".$data->menu_english;?></td>
                              </tr>                              
                            <?php endforeach ?>
                              <tr>
                                <td colspan=2>
                                  <a href="<?php echo base_url();?>dinner?date=<?php echo $subdate; ?>" class="btn btn-danger btn-block">订购 ORDER</a>
                                </td>
                              </tr>
                            </tbody>  
                        </table>
                        </div>                 
                    <?php }else{ ?>
                      <div class="food-content">
                        <div class="item">
                        <?php if ($subdate == '2017-05-01') { ?>
                          PUBLIC HOLIDAY <br> LABOUR DAY
                        <?php }else{ ?>

                        NOT AVAILABLE
                          <?php } ?>
                        </div>
                      </div> 
                    <?php } ?>

                        </div>
                    </div>
                </div>
             

                  </div>
                </div>
                <?php $counter++;?>
                <?php if (($counter % 4) == 0) {?>
                  <div class="clearfix"></div>
                <?php } ?>
              <?php } ?>        
      </div>       

    </div>
  </div>    

  </div>

</section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          
        </div>
      </div>
    </div>
  </section>