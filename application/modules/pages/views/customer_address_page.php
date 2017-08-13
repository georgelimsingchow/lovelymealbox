<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class="container">

<div class="row">
  <div class="col-md-12">
<form class="form-inline text-center" method="GET" action="<?= base_url('pages/customer_address');?>">
  <div class="form-group">
      <label for="account_no">Account No</label>
      <select class="form-control" id="account_no" name="account_no">
      <?php foreach ($account_no as $key => $v): ?>
      	<option value="<?= $v?>" <?=($v == $this->input->get('account_no') ? "selected" : "")?>><?= $v;?></option>
      <?php endforeach ?>
      </select>
  </div>

  <button type="submit" class="btn btn-primary">Search</button>
</form>

  </div>
</div>
<div class="row">
	<div class="col-md-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Account No</th>
				<th>Contact</th>
				<th>Address</th>				
			</tr>
		</thead>
		<tbody>
		<?php foreach ($all_address as $key => $v): ?>
			<tr>
				<td><?= $v['firstname']."<br>".$v['lastname']; ?></td>
				<td>MBR<?= $v['customer_id']+3000;?></td>
				<td><?= $v['mobile_no'];?></td>
				<td>
					<?= $v['address_1'];?><br>
					<?= $v['address_2'];?>
				</td>
			</tr>
		<?php endforeach ?>
			
		</tbody>
	</table>
		
	</div>
</div>

</div>