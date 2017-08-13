<div class="container">
<div class="row">
 <div class="btn-group btn-group-justified">
  <a href="#" class="btn btn-warning">PROCESSING</a>
  <a href="#" class="btn btn-primary">PAID</a>  
  <a href="#" class="btn btn-success">DELIVERED</a>
  <a href="#" class="btn btn-danger">CANCELLED</a>
</div> 
</div>

  <div class="row">

  <?php $count = '1';?>
<?php foreach ($ck_report as $order_no => $k): ?>
  
<table class="table table-bordered">
    <thead>
      <tr>
        <th>
          <?php echo $count;?>.
          <?php echo $order_no; ?> (<?php echo $k['date']; ?>) 
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
        Name : <?php echo $k['name']; ?> <br>
        Account No : <?php echo $k['mbr']; ?><br>
        Address : <?php echo $k['address_1']; ?> <?php echo $k['address_2']; ?><br>
        Status : <span class="label label-primary"><?php echo $k['status']; ?></span>      
          
          
        </td>
      </tr>
      <tr>
        <td>
        <?php foreach ($k['meal'] as $name => $desc): ?>
          <?php $decode_menu = json_decode($desc['menu'],true);?>
          [<?php foreach ($decode_menu as $f => $number): ?>
          <?php if (isset($number['id'])): ?>
            <?php $data = get_food_type($number['id']);?>
            <?php echo $data->menu_chinese;?>,
          <?php else: ?>
            <?php $data = get_food_type($number);?>
            <?php echo $data->menu_chinese;?>,
          <?php endif ?>           
          <?php endforeach ?>] --
            <?php echo $desc['qty'] ?> box
             (RM <?php echo $desc['total'] ?>)
          
              <br><?php endforeach ?></td>
      </tr>
     <?php $count++; ?>
    </tbody>
  </table>
<?php endforeach ?>







  </div>

</div>