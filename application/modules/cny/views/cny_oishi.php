<div class="container">
	<div class="row">

	<div class="col-md-12">
		<div class="panel panel-danger">
		  <div class="panel-heading">
		    <h3 class="panel-title text-center"><?php echo $panel_title; ?></h3>
		  </div>
		  <div class="panel-body">
		    <form class="form-horizontal" method="POST" action="<?php echo base_url('cny/oishi_validation')?>">

		    	<table class="table table-bordered">
		    	<thead>
		    		<tr>
		    			<th class="text-center">Party Pack (L)</th>
		    			<th class="text-center">Party Pack (S)</th>
		    			<th class="text-center">Appetizer</th>
		    			<th class="text-center">Yee Sang</th>
		    			<th class="text-center">Salmon Sashimi</th>
		    		</tr>
		    	</thead>
			    	<tbody>
			    	<tr>
			    		<td><img src="<?php echo base_url('assets/images/oishi/sushi1.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/oishi/sushi2.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/oishi/appetizer.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/oishi/yeeshang.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/oishi/sashimi.jpg');?>" class="img-responsive"></td>
			    	</tr>
			    	<tr>
			    		<td>
						 <select id="sushi1" class="form-control" name="oishi[sushi1]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="138">1 Set (RM 138)</option>
						 	<option value="276">2 Set (RM 276)</option>
						 	<option value="414">3 Set (RM 414)</option>
						 	<option value="552">4 Set (RM 552)</option>
						 </select>    			
			    		</td>
			    		<td>
						 <select id="sushi2" class="form-control" name="oishi[sushi2]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="98">1 Set (RM 98)</option>
						 	<option value="196">2 Set (RM 196)</option>
						 	<option value="294">3 Set (RM 294)</option>
						 	<option value="392">4 Set (RM 392)</option>
						 </select>			    			
			    		</td>
			    		<td>
						 <select id="appetizer" class="form-control" name="oishi[appetizer]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="58">1 Set (RM 58)</option>
						 	<option value="116">2 Set (RM 116)</option>
						 	<option value="174">3 Set (RM 174)</option>
						 	<option value="232">4 Set (RM 232)</option>
						 </select>
			    			
			    		</td>
			    		<td>
						 <select id="yeeshang" class="form-control" name="oishi[yeeshang]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="39.90">1 set (RM 39.90)</option>
						 	<option value="79.80">2 set (RM 79.80)</option>
						 	<option value="119.70">3 set (RM 119.70)</option>
						 	<option value="159.60">4 set (RM 159.60)</option>
						 </select>
			    			
			    		</td>
			    		<td>
						 <select id="sashimi" class="form-control" name="oishi[sashimi]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="60">500 gram (RM 60)</option>
						 	<option value="110">1 KG (RM 110)</option>
						 	<option value="170">1.5 KG (RM 170)</option>
						 	<option value="220">2 KG (RM 220)</option>
						 </select>
			    			
			    		</td>
			    	</tr>
			    	<tr>
			    		<td colspan="4"></td>
			    		<td class="text-center"><h3>RM <span id="cny_total">0</span></h3></td>
			    	</tr>			    		
			    	</tbody>		    		
		    	</table>
		    	<?php echo form_error('selectone', '<div class="alert alert-warning">', '</div>'); ?>
				  <div class="form-group <?php if(form_error('name')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>">
				      <?php echo form_error('name', '<span class="help-block">', '</span>'); ?>
				    </div>

				  </div>
				  <div class="form-group <?php if(form_error('phone')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Phone</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="phone" placeholder="0123456789" value="<?php echo set_value('phone'); ?>">
				      <?php echo form_error('phone', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group <?php if(form_error('email')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" name="email" placeholder="happy@lovelymealbox.com" value="<?php echo set_value('email'); ?>">
				      <?php echo form_error('email', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group <?php if(form_error('date')){echo 'has-error';} ?>">
				    <label class="col-sm-2 control-label">Date</label>
				    <div class="col-sm-10">
				    <select class="form-control" name="date">
				    	<option value="">--Please Select--</option>
				    	<option value="27-JAN-2016" <?php echo set_select('date', '27-JAN-2016'); ?>>27th January 2016 (年三十)</option>
				    </select>
				    <?php echo form_error('date', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Time</label>
				    <h4 class="col-sm-10 text-center">Pick up after 11AM before  4PM at Foochow Road No 1</h4>
				  </div>
				  	<button class="btn btn-primary pull-right">SUBMIT</button>
		    </form>
		  </div>
		</div>
	</div>
	</div>
</div>
<script type="text/javascript">

		function getTotal(sel)
		{
			var total = sushi1()+ sushi2()+ appetizer()+yeeshang()+sashimi();
			$("#cny_total").html(total); 
		    // alert(sel.value);
		}

		function sushi1()
		{
			var sushi1 = 0;
			sushi1 = Number($('#sushi1 option:selected').val());
			return sushi1;
		}

		function sushi2()
		{
			var sushi2 = 0;
			sushi2 = Number($('#sushi2 option:selected').val());
			return sushi2;
		}

		function appetizer()
		{
			var appetizer = 0;
			appetizer = Number($('#appetizer option:selected').val());
			return appetizer;
		}

		function yeeshang()
		{
			var yeeshang = 0;
			yeeshang = Number($('#yeeshang option:selected').val());
			return yeeshang;
		}

		function sashimi()
		{
			var sashimi = 0;
			sashimi = Number($('#sashimi option:selected').val());
			return sashimi;
		}

</script>