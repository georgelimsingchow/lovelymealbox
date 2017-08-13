<div class="container">
    <div class="row">
		 <ol class="breadcrumb brand-danger">
		  <li><a href="<?php echo base_url();?>home">Home</a></li>
		  <li><a href="<?php echo base_url();?>account">Account</a></li>
		  <li class="active"><a>CNY</a></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="table-responsive">
		    	<table class="table table-bordered" style="background-color: #fff;">
		    	<thead>
		    		<tr>
		    			<th class="text-center">Order Number</th>
		    			<th class="text-center">Name</th>
		    			<th class="text-center">Status</th>
		    			<th class="text-center">Sushi</th>
		    			<th class="text-center">CNY</th>
		    			<th class="text-center">Pickup Date</th>
		    			<th class="text-center">Total</th>
		    		</tr>
		    	</thead>
			    	<tbody>
			    	<?php if (!empty($cny_order)) { ?>
			    	<?php foreach ($cny_order as $key => $v) { ?>
				    	<tr>
					    	<td class="text-center"><?php echo $v['order_no']?></td>
					    	<td class="text-center"><?php echo $v['name']?></td>
					    	<td class="text-center"><?php echo $v['order_status']?></td>
					    	<td class="text-center">
					    		<?php 
					    			$sushi_key = array(
					    				'sushi1' => "Party Pack (L)",
					    				'sushi2' => "Party Pack (S)",
					    				'appetizer' => "Appetizer",
					    				'yeeshang' => "Yee Shang",
					    				'sashimi' => "Salmon Sashimi",
					    				);

					    			$sushi = json_decode($v['sushi_order'],TRUE);
					    		?>
					    		<?php 
					    		if ($sushi) {
					    			foreach ($sushi as $key => $value) {
					    				if (!empty($value)) {
					    					echo $sushi_key[$key].": RM ".$value."<br>";
					    				}
					    				
					    			} 
					    		}
					    		?>
					    	</td>
					    	<td>
					    	<?php if ($v['package'] != '') { ?>
					    		<ul class="list-unstyled">
					    			<li>新年配套 : RM <?php echo $v['package']?></li>
					    		</ul>
					    	<?php  }else{ ?>
					    		<ul class="list-unstyled">
					    			<li>港式古早味烧肉 : RM <?php echo $v['pork_belly']?></li>
					    			<li>麦芽糖玻璃叉烧 : RM <?php echo $v['char_siew']?></li>
					    			<li>港式五香烧鸡 : RM <?php echo $v['chicken']?></li>
					    			<li>港式脆皮烧鸭 : RM <?php echo $v['roasted_duck']?></li>
					    		</ul>
					    	<?php } ?>

					    	</td>
					    	<td class="text-center">
					    		<?php echo $v['pickup_date']?>
					    	</td>
					    	<td class="text-center">
					    		RM <?php echo $v['pork_belly']+$v['char_siew']+$v['chicken']+$v['roasted_duck']+$v['package']?>
					    	</td>
				    	</tr>
			    	<?php }?>

			    	<?php }else{?>
			    		<tr></tr>
			    	<?php } ?>			    		
			    	</tbody>		    		
		    	</table>
		    	</div>
		</div>
	</div>
</div>