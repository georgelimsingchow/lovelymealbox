    <div class="container">
      <?php if(isset($message)){ ?>
        <div class="row">
          <div class="alert alert-danger">
            <strong>Caution!</strong> <?php echo $message;?>
          </div>
        </div>        
      <?php  }?>
      <div class="row">
        <div class="col-md-12"><h1 class="text-center" id="order-date">Mealbox : <span><?php echo date("D Y-M-d", strtotime($output['menu_date']));?></span></h1></div>
      </div>

      <div class="row">        
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-center">MENU</h3>
            </div>
            <div class="panel-body">
             <?php if(isset($message)){ ?>
              <div class="action_toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-warning btn-block btn-lg disabled">
                      <i class="glyphicon glyphicon-plus"></i> UNABLE TO ORDER
                    </a>
                  </div>
                </div>
              </div>
              <?php  }else{ ?>
              <div class="action_toolbar">
                <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-warning btn-block btn-lg" onclick="add_box()">
                      <i class="glyphicon glyphicon-plus"></i> MAKE YOUR BOX
                    </a>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="row">
                  <div class="col-md-12">
                    <?php
                      foreach ($output['picked_menu']['meat'] as $id => $food_name) {
                        echo "<a class='btn btn-block btn-danger btn-lg menu_text' id='$id'>$food_name</a>";
                      }
                    ?>
                    <?php
                      foreach ($output['picked_menu']['vege'] as $id => $food_name) {
                        echo "<a class='btn btn-block btn-success btn-lg menu_text' id='$id'>$food_name</a>";
                      }
                    ?>
                  </div>
              </div>
            </div>
          </div>
              
            </div>            
          </div>          
        </div>
        <div class="col-md-5">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title text-center"><?php echo date("D Y-M-d", strtotime($output['menu_date']));?></h3>
            </div>

            <table class="table ">
              <thead>
                <tr>
                  <th class="text-center">QTY</th>
                  <th class="text-center">CHOICES</th>
                  <th class="text-center">ACTION</th>
                  <th class="text-center">TOTAL</th>
                  
                </tr>

              </thead>
            <tbody>
              <?php if (empty($output['cart'])) { ?>
                  <tr><td colspan='4' class='text-center'><b>CART IS EMPTY MAKE YOUR BOX TO BEGIN</b></td></tr>
                <?php }else{ ?>
                  <?php foreach ($output['cart'] as $id => $value) { ?>
                    <tr>
                      <td style='vertical-align:middle' class='col-md-3 text-center'><?= $value['quantity'];?>x</td>
                      <td style='vertical-align:middle' class='col-md-3'><ul class='list-unstyled'>
                    <?php foreach ($value['selected_menu'] as $type => $type_value) { ?>
                      <?php if ($type == 'meat') { ?>
                    <?php  foreach ($type_value as $type_value_key => $type_value_value) { ?>
                          <li><span class='label label-danger'><?= $type_value_value; ?></span></li>
                    <?php } ?>
                    <?php } ?>
                    <?php  if ($type == 'vege') { ?>
                    <?php    foreach ($type_value as $type_value_key => $type_value_value) { ?>
                        <li><span class='label label-success'><?= $type_value_value; ?></span></li>
                     <?php } ?>
                    <?php } ?>
                    <?php } ?>

                    </ul></td>
                    <td style='vertical-align:middle' class='col-md-3 text-center'>
                      <button type='button' class='btn btn-danger' onclick="cart.remove(<?php echo $value['id'];?>)"><i class='glyphicon glyphicon-remove'></i></button>
                    </td>
                    <td style='vertical-align:middle' class='col-md-3 text-center'><?= sprintf('%0.2f',$value['total']); ?></td>
                    
                   </tr>
                  <?php } ?>
                  <tr>
                    <td style='vertical-align:middle' class='col-md-3'></td>
                    <td colspan='2' style='vertical-align:middle' class='col-md-3'><span class="pull-right">Delivery Fee</span></td>
                    <td style='vertical-align:middle' class='text-center'><?= deliveryfee();?></td>
                  </tr>
                  <tr>
                  <td class='col-md-3'></td>
                  <td class='col-md-3'></td>
                  <td class='col-md-3'>Total</td>
                  <td colspan='3' style='vertical-align:middle'>
                    <strong>RM <?= sprintf('%0.2f',count_individual_total_amount($order_date,$this->session->customer_id)+deliveryfee()) ;?></strong>
                  </td>
                  </tr>
               <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4">
                  <a href='<?php echo base_url();?>checkout' class='btn btn-block btn-warning btn-lg'>NEXT</a>
                </td>
              </tr>
            </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

  <!-- Bootstrap modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Title</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="menu-form">
          <input type="hidden" name="daily_menu_id" value="<?php echo $output['daily_menu_id']; ?>">
          <input type="hidden" name="that_day_date" value="<?php echo $output['slug']; ?>">
          <div class="form-group">
            <div class="col-md-12" id="message"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">SELECTION</label>
            <div class="col-md-9">
              <div class="col-md-6">
                <h4><span class="label label-danger">MEAT</span></h4>
                    <?php 
                    foreach ($output['picked_menu']['meat'] as $id => $food_name) {
                      echo "<div class='checkbox'>";
                      echo "<label><input type='checkbox' value='$id' name='meat[]' class='meat'/>$food_name</label> ";
                      echo "</div>";
                    }
                    ?>
              </div>
              <div class="col-md-6">
                <h4><span class="label label-success">VEGE</span></h4>
                    <?php 
                    foreach ($output['picked_menu']['vege'] as $id => $food_name) {
                      echo "<div class='checkbox'>";
                      echo "<label><input type='checkbox' value='$id' name='vege[]' class='vege'/>$food_name</label> ";
                      echo "</div>";
                    }
                    ?>
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
                <input id="box-qty" type="text" value="" name="box-quantity" class="text-center qty_spinner form-control">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
        <button id="submit_order" type="button" class="btn btn-primary" onclick="save()" >ADD</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

var save_method; //for save method string
var title_date = "<?php echo date("D Y-M-d", strtotime($output['menu_date']));?>";

	function add_box(){

	    save_method = 'add';

      //reset form
      $("#menu-form input[type='checkbox']").removeAttr('checked');
      $("#alert-out").remove();
      $("#box-qty").val("1");
      $("#per-price").text("0.00");
      $("#total-price").text("0.00");

      //show modal
	    $('#modal_form').modal('show');
	    $('.modal-title').text(title_date); // Set Title to Bootstrap modal title
	}

  function save(){

    var url;
 
    if(save_method == 'add') {
        url = "<?php echo base_url('order/order_ajax_add')?>";
    } else {
        url = "<?php echo base_url('order/order_ajax_edit')?>";
    }

    // console.log(save_method);
    // console.log($('#menu-form').serializeArray());

    $.ajax({
        url : url,
        type: "POST",
        dataType: "JSON",
        data: $('#menu-form').serializeArray(),
        success: function(data)
        { 
            if (data.condition == 'failed') {
              console.log(data);
              $("#message").append('<div class="alert alert-danger alert-dismissible" role="alert" id="alert-out"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+data['option_string']+'</div>');
            }else{
              console.log(data.condition);
              location.reload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          console.log(jqXHR);
        }
    });

  }

</script>