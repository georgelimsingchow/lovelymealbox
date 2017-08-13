<div class="container">
  <div class="row">

    <div class="col-md-12">
    <h2 class="text-center"><?php echo $next_day; ?></h2>
      <table class="table table-bordered">
      <?php foreach ($tomorrow_data as $session => $v): ?>
        <thead>
          <tr>

            <th class="text-center" colspan="2"><?php echo ucfirst($session); ?></th>
          </tr>
        </thead>
        <?php $decoded_menu = json_decode($v['picked_menu']) ?>
        <tbody>
        <?php $count = 1; ?>
        <?php foreach ($decoded_menu as $key => $number): ?>
          
          <?php $data = get_food_type($number);?>
          <tr>
          <td class="text-center"><?php echo $count; ?></td>
            <td class="text-center"><?php echo $data->menu_chinese."<br>".$data->menu_english;?></td>
          </tr> 
          <?php $count++; ?>         
        <?php endforeach ?>

        </tbody>
        
      <?php endforeach ?>
      </table>
    </div>


  </div>
</div>