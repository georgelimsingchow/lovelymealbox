<div class="container">
    <div class="row">
		 <ol class="breadcrumb brand-danger">
		  <li><a href="<?php echo base_url();?>home">Home</a></li>
		  <li><a href="<?php echo base_url();?>account">Account</a></li>
		  <li class="active"><a>Reload History</a></li>
		</ol>
	</div>
	<div class="row">
   		<hr>
   		<table class="table table-bordered table-hover" style="background-color: #fff">
			<thead>
				<tr>
					<th class='text-center'>NO</th>
					<th class='text-center'>Reload Amount</th>
					<th class='text-center'>Create Date</th>							
				</tr>
			</thead>
   			<tbody>
   				<?php if (empty($reload_data)) {?>
   				<tr>
   					<td colspan="4" class="text-center">
   						<h2>You have not reloaded yet</h2>
   					</td>
   				</tr>
   					
   				<?php }else{ ?>

	   				<?php foreach ($reload_data as $key => $value) {?>
	   					<tr>
	   						<td class="text-center"><?php echo $key+1;?></td>
							<td class="text-center"><?php echo $value['amount'];?></td>
							<td class="text-center"><?php echo $value['create_date'];?></td>													
	   					</tr>
	   				<?php }?>
   				<?php }?>

   			</tbody>
   		</table>
	</div>
	<div class="row">
		<a href="<?php echo base_url();?>account/" class='btn btn-default'>BACK</a>
	</div>
</div>