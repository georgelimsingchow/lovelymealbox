<div class="active tab-pane" id="general">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Order No</th>
      <th>Payment Name</th>
      <th>Order Status</th>
      <th>Total</th>
      <th>Delivery Fee</th>
      <th>Total + Delivery Fee</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($customer_order as $key => $v) { ?>
    <tr>
      <td><?php echo $v['order_no']?></td>
      <td><?php echo $v['payment_firstname']." ".$v['payment_lastname']?></td>
      <td><?php echo $v['order_status']?></td>
      <td><?php echo $v['total'];?></td>
      <td><?php echo $v['delivery_fee'];?></td>
      <td><?php echo number_format($v['total']+$v['delivery_fee'], 2, '.', ' ');?></td>
      <td><a href="<?php echo base_url("superadmin/order/info?order_id=$v[order_id]")?>">View</a></td>
    </tr>
  <?php }?>
  </tbody>
</table>
</div>