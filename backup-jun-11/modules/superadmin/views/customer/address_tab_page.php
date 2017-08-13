<div class="active tab-pane" id="general">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Mobile No</th>
      <th>Address 1</th>
      <th>Address 2</th>
      <th>City</th>
      <th>Postcode</th>
      <th>State</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($customer_address as $key => $v) { ?>
    <tr>
      <td>
      First Name : <?php echo $v['firstname']?><br>
      Last Name : <?php echo $v['lastname']?>

        
      </td>
      <td><?php echo $v['mobile_no']?></td>
      <td><?php echo $v['address_1']?></td>
      <td><?php echo $v['address_2'];?></td>
      <td><?php echo $v['city'];?></td>
      <td><?php echo $v['postcode'];?></td>
      <td><?php echo getState($v['state_id'])?></td>
      <td>
      <?php if ($v['status'] == '1') {?>
        ON
      <?php }else{?>
        DELETED
      <?php }?>
        
      </td>
    </tr>
  <?php }?>
  </tbody>
</table>
</div>