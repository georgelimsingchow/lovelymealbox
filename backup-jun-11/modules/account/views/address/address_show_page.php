<div class="container">
    <div class="row">
		 <ol class="breadcrumb brand-danger">
		  <li><a href="<?php echo base_url();?>home">Home</a></li>
		  <li><a href="<?php echo base_url();?>account">Account</a></li>
		  <li class="active">Manage address</li>
		</ol>
	</div>
	<div class="row">
	<a href="<?php echo base_url();?>checkout" class='btn btn-primary'>BACK TO CHECKOUT</a>
		<a href="<?php echo base_url();?>account/address/add" class='btn btn-primary pull-right'>NEW ADDRESS</a>
	</div>
	<div class="row">
   		<hr>

		<?php echo $this->session->flashdata('flsh_msg'); ?>
   		<table class="table table-bordered table-hover" style="background-color: #fff;">
   			<tbody>
   				<?php if (empty($addresses)) {?>
   				<tr>
   					<td class="text-center">
   						<h2>PLEASE ADD NEW ADDRESS</h2>
   					</td>
   				</tr>
   					
   				<?php }else{ ?>
	   				<?php foreach ($addresses as $key => $value) {?>
	   					<tr>
							<td class="text-left">
								<?php echo $value['firstname']." ".$value['lastname'];?>
								<br>
								<?php echo $value['mobile_no'];?>
								<br>
								<?php echo $value['address_1']." ".$value['address_2'];?>
								<br>
								<?php echo $value['city']." ".$value['postcode'];?>
								<br>
								<?php echo $value['state_id'];?>
							</td>
							<td class="text-right">
								<a href="<?php echo base_url();?>account/address/edit/<?php echo $value['id'];?>" class="btn btn-warning">Edit</a>
								<a href="<?php echo base_url();?>account/address/delete/<?php echo $value['id'];?>" class="btn btn-danger">Delete</a>
							</td>  						
	   					</tr>
	   				<?php }?>
   				<?php }?>

   			</tbody>
   		</table>
	</div>

</div>