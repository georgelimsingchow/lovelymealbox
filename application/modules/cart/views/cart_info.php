<?php if (!empty($lunch_data)): ?>
  <div class="col-md-12">       
    <strong>Lunch</strong>
    <hr>
    <?php foreach ($lunch_data as $key => $value): ?>
      <div class="row">
        <div class="col-xs-7">
        <?php foreach ($value['selected_menu'] as $k => $v): ?>
          <?php if ($v['type'] == 'meat'): ?>
            <span class="label label-success"><?php echo $v['menu_english'] ?></span>
          <?php endif ?>
          <?php if ($v['type'] == 'vege'): ?>
            <span class="label label-danger"><?php echo $v['menu_english'] ?></span>
          <?php endif ?>                                                
        <?php endforeach ?> 

        </div>
          <div class="col-xs-2 text-center"><?php echo $value['quantity'] ?></div>
          <div class="col-xs-3"><div class="pull-right"><span>RM </span><span><?php echo $value['total_price'] ?></span></div></div>
      </div>
      <hr style="border: 1px solid #eee">      
    <?php endforeach ?>           
        </div>
<?php endif ?>
<?php if (!empty($dinner_data)): ?>
  <div class="col-md-12">
              <strong>Dinner</strong>
              <hr>
    <?php foreach ($dinner_data as $key => $value): ?>
      <div class="row">
        <div class="col-xs-7">
        <?php foreach ($value['selected_menu'] as $k => $v): ?>
          <?php if ($v['type'] == 'meat'): ?>
            <span class="label label-success"><?php echo $v['menu_english'] ?></span>
          <?php endif ?>
          <?php if ($v['type'] == 'vege'): ?>
            <span class="label label-danger"><?php echo $v['menu_english'] ?></span>
          <?php endif ?>                                                
        <?php endforeach ?> 

        </div>
          <div class="col-xs-2 text-center"><?php echo $value['quantity'] ?></div>
          <div class="col-xs-3"><div class="pull-right"><span>RM </span><span><?php echo $value['total_price'] ?></span></div></div>
      </div>
      <hr style="border: 1px solid #eee">      
    <?php endforeach ?> 
  </div>  
<?php endif ?>
        
<div class="col-md-12">
    <strong>Order Total</strong>
    <div class="pull-right"><span>$</span><span>150.00</span></div>
    <hr>
</div>

