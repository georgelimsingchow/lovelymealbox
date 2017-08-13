<div class="active tab-pane">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $this->reload->get_total_reload($customer_id) ? $this->reload->get_total_reload($customer_id) : "0"; ?></h3>
          <p>Total Reload</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $this->reload->get_remaining($customer_id) ? $this->reload->get_remaining($customer_id) : "0"; ?></h3>
          <p>Remaining Reload</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Amount</th>
            <th>Description</th>
            <th>Expire Date</th>
            <th>Create Date</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($balance as $key => $v) { ?>
          <tr>
            <td><?php echo $v['amount']?></td>
            <td><?php echo $v['description']?></td>
            <td><?php echo $v['expire_date']?></td>
            <td><?php echo $v['create_date']?></td>
          </tr>
        <?php }?>
        </tbody>
      </table>     
    </div>
  </div>

</div>