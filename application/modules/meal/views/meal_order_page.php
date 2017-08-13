<style type="text/css">  
  .cart-header
  {
    width: 100%;
    background-color: #f5f5f5;
    height: 30px;
    padding-top: 5px;
    border-top: 1px solid #dadada;
    border-bottom: 1px solid #dadada;
    margin-bottom: 5px;
  }

  .cart-body{
    margin-top: 5px;
    width: 100%;
    height: auto;
  }

  .no-padding{
    padding-right: 0;
    padding-left: 0;
  }

  .with-margin{
    margin-right: 15px;
    margin-left: 15px;
  }

  .cart-item{
    margin: 0px auto;
    padding-top: 5px;
    padding-bottom: 5px;
    border-bottom: 1px solid grey;
  }

  .cart-footer{
    margin: 0px auto;
    padding-top: 5px;
    padding-bottom: 5px;
  }

  .cart-item p{
    margin-top: 3px;
    margin-bottom: 0px;
    font-size: 11px;
    color: #1d1d1d;
  }

  .session_active {
    background-color: #337ab7;
    color: white;
  }

  .session_panel{
    margin-bottom: 0px;
    margin-top: 10px;
  }

  .del_item
  {
    color: #d9534f;
  }



</style>
<section style="background-color: #f5f5f5">
<?php $date = $this->input->get('date'); ?>
    <div class="container">
      <div class="row text-center">

      <div class="col-xs-6">
                          <a href="<?php echo base_url('lunch');?>?<?php echo "date=$date"?>">
                <div class="panel panel-default <?php if($this->uri->segment(1) == 'lunch') echo "session_active";?> session_panel">
                    <div class="panel-body">
                    <h1><?php echo $date; ?></h1>
                        <h3 class="session">LUNCH</h3>
                    </div>
                </div>
            </a>
      </div>
      <div class="col-xs-6">
                          <a href="<?php echo base_url('dinner');?>?<?php echo "date=$date"?>">
                <div class="panel panel-default <?php if($this->uri->segment(1) == 'dinner') echo "session_active";?>  session_panel">
                    <div class="panel-body">
                    <h1><?php echo $date; ?></h1>
                        <h3 class="session">DINNER</h3>
                    </div>
                </div>
            </a>
      </div>
      </div>    	
    </div>
</section>
<section>
<div class="container">
<div class="row">
   <br>
            <div class="col-md-8">
            <div class="row">
                <div class="col-xs-12">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4 style="margin: 0">Meal Box</h4></div>
                        <div class="panel-body">
                        <div class="row">
                          <div class="col-md-12">
                          <?php if (!empty($menu)): ?>
                          <ul class="list-group text-center">
                          
                            <?php $decode_menu = json_decode($menu['picked_menu'],true);?>
                            <?php foreach ($decode_menu as $key => $id): ?>
                              <?php $data = get_food_type($id);?>
                              <?php if ($data->type == 'meat'): ?>
                                <li class="list-group-item list-group-item-danger"><?php echo $data->menu_chinese." ".$data->menu_english;?></li>
                              <?php endif ?>
                              <?php if ($data->type == 'vege'): ?>
                                <li class="list-group-item list-group-item-success"><?php echo $data->menu_chinese." ".$data->menu_english;?></li>
                              <?php endif ?>
                            <?php endforeach ?>                

                          </ul>
                          <button type="button" class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#mealbox_modal">BUILD NOW</button>
                        <?php else: ?> 
                          <button type="button" class="btn btn-danger btn-block disabled">Coming Soon</button>
                        <?php endif ?>
                          </div>
                          </div>

                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                </div>
                <div class="col-xs-12">                    
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4 style="margin: 0">Ala Carte</h4></div>
                        <div class="panel-body">
                        <div class="row">
                          <div class="col-xs-12">

                          <?php if (!empty($alacarte)): ?>
                          <?php foreach ($alacarte as $key => $v): ?>
                            <div class="media">
                              <div class="media-left">
                                <img src="<?php echo base_url($v['pic_url']); ?>" class="media-object" height="100" width="120">
                              </div>
                              <div class="media-body media-middle">
                                <h4 class="media-heading"><?php echo $v['menu_chinese']." ".$v['menu_english'] ?></h4>
                                <p>RM <?php echo number_format($v['price'],2) ?></p>                                
                              </div>
                              <div class="media-right media-middle">
                              <button type="button" class="btn btn-danger" data-id="<?php echo $v['id']; ?>" data-toggle="modal" data-target="#alacarte_modal"><i class="glyphicon glyphicon-plus"></i> ADD</button>
                              </div>
                            </div>
                           <?php endforeach ?>                             
                          <?php else: ?>
                            <button type="button" class="btn btn-danger btn-block disabled">Check Again Tomorrow</button>
                          <?php endif ?>
                          
                            </div>
                        </div>
                        </div>                    
                  </div>
                </div>              
            </div>  



                </div>
                <div class="col-md-4">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4 style="margin: 0">Shopping Cart</h4>
                        </div>
                        <div class="panel-body no-padding">
                          <div class="container cart-header">
                          <div class="row">
                            <div class="col-xs-7"><span>Item</span></div>
                            <div class="col-xs-2"><span>Qty</span></div>
                            <div class="col-xs-3"><span>Price</span></div></div>
                            
                          </div>
                          <?php if (!empty($get_cart)): ?>
                          <div class="cart-body">
                          <?php foreach ($get_cart as $key => $v): ?>

                            <div class="row cart-item">
                             <div class="col-xs-7">
                             <?php if ($v['type'] == 'mealbox'): ?>
                                  <span class="label label-primary"><?php echo ucfirst($v['type']); ?></span>
                                  <?php $food_item = json_decode($v['selected_menu'],true);?>
                                  <?php foreach ($food_item as $key => $id): ?>
                                    <?php $food_name = get_food_type($id); ?>
                                    <p><?php echo $food_name->menu_english; ?></p>                                
                                  <?php endforeach ?>                               
                             <?php else: ?>
                                  <span class="label label-warning"><?php echo ucfirst($v['type']); ?></span>
                                  <?php $ala = $this->mm->get_single_alacarte($v['selected_menu']); ?>
                                  <p><?php echo $ala->menu_english ?></p>
                             <?php endif ?>


                            </div>
                            <div class="col-xs-1"><p><?php echo $v['quantity']; ?></p></div>
                            <div class="col-xs-3 text-right">
                              <p><?php echo number_format($v['quantity']*$v['unit'],2); ?></p>
                              
                            </div>
                            <a class="del_item" data-item-id="<?php echo $v['id']?>">X</a>
                            </div>                            
                          <?php endforeach ?>
                          </div>
                          <div class="row cart-item">
                             <div class="col-xs-12">
                             <strong>TOTAL</strong>
                             <div class="pull-right"><span>RM <?php echo $total['total']; ?></span></div>                                 
                            </div>
                          </div>
                          <div class="row cart-footer">
                             <div class="col-md-12">
                                <a href="<?php echo base_url('checkout')."/".$this->uri->segment(1);?>?date=<?php echo $this->input->get('date')?>" class="btn btn-primary btn-block">NEXT</a>
                              </div>
                          </div>                            
                          <?php else: ?>
                          <div class="row cart-footer">
                             <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-block disabled">NEXT</button>
                                </div>
                          </div>                            
                          <?php endif ?>


                        </div>
                    </div>
                </div>
</div>
</div>
</section>

<!-- Modal -->
<div class="modal fade" id="mealbox_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel"><?php echo date("D Y-M-d", strtotime($this->input->get('date')));?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="menu-form">
          <input type="hidden" name="session" value="<?php echo $this->uri->segment(1);?>">
          <input type="hidden" name="that_day_date" value="<?php echo $date; ?>">
          <div class="form-group">
            <div class="col-md-12" id="message"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">SELECTION</label>
            <div class="col-md-9">
              <div class="col-md-6">
                <h4><span class="label label-danger">MEAT</span></h4>
                <?php foreach ($decode_menu as $key => $id): ?>
                  <?php $data = get_food_type($id);?>
                  <?php if ($data->type == 'meat'): ?>
                    <div class="checkbox">
                      <label><input type="checkbox" value="<?php echo $data->id;?>" name="meat[]" class="meat"><?php echo $data->menu_chinese." ".$data->menu_english;?></label>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>                      <!--  -->
              </div>
              <div class="col-md-6">
                <h4><span class="label label-success">VEGE</span></h4>
                <?php foreach ($decode_menu as $key => $id): ?>
                  <?php $data = get_food_type($id);?>
                  <?php if ($data->type == 'vege'): ?>
                  <div class="checkbox">
                  <label><input type="checkbox" value="<?php echo $data->id;?>" name="vege[]" class="vege"><?php echo $data->menu_chinese." ".$data->menu_english;?></label>
                  </div>
                  <?php endif ?>
                <?php endforeach ?>                      
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">PER PRICE</label>
            <div class="col-md-9"><p class="form-control-static text-center">RM <span id="per-price">0.00<span></p></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">QUANTITY</label>
            <div class="col-md-9">
              <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-2">
                <input id="box-qty" type="text" value="" name="box-quantity" class="text-center form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">TOTAL</label>
            <div class="col-md-9"><p class="form-control-static text-center">RM <span id="total-price">0.00<span></p></div>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button id="mealbox_submit" type="button" class="btn btn-primary">ADD</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alacarte_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel"><?php echo date("D Y-M-d", strtotime($this->input->get('date')));?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="alacarte-form">
          <input type="hidden" name="session" value="<?php echo $this->uri->segment(1);?>">
          <input type="hidden" name="that_day_date" value="<?php echo $date; ?>">
          <div class="form-group">
            <div class="col-md-12" id="alacarte_message"></div>
          </div>
          <div id="george"></div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
        <button id="alacarte_submit" type="button" class="btn btn-primary">ADD</button>
      </div>
    </div>
  </div>
</div>