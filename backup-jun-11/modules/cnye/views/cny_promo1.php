<div class="container">
	<div class="row">

	<div class="col-md-12">
		<div class="panel panel-danger">
		  <div class="panel-heading">
		    <h3 class="panel-title text-center"><?php echo $panel_title; ?></h3>
		  </div>
		  <div class="panel-body">
		    <form class="form-horizontal" method="POST" action="<?php echo base_url('cny/promo1_validation')?>">

		    	<table class="table table-bordered">
		    	<thead>
		    		<tr>
		    			<th class="text-center">港式古早味烧肉</th>
		    			<th class="text-center">麦芽糖玻璃叉烧</th>
		    			<th class="text-center">港式五香烧鸡</th>
		    			<th class="text-center">港式脆皮烧鸭</th>
		    		</tr>
		    	</thead>
			    	<tbody>
			    	<tr>
			    		<td><img src="<?php echo base_url('assets/images/cny/sr.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/cny/cs.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/cny/sj.jpg');?>" class="img-responsive"></td>
			    		<td><img src="<?php echo base_url('assets/images/cny/sy.jpg');?>" class="img-responsive"></td>
			    	</tr>
			    	<tr>
			    		<td>
						 <select id="roasted_pork" class="form-control" name="promo1[roasted_pork]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="35" <?php echo  set_select('promo1[roasted_pork]', '35'); ?> >500 gram (RM 35)</option>
						 	<option value="65" <?php echo  set_select('promo1[roasted_pork]', '65'); ?>>1 Kg (RM 65)</option>
						 	<option value="100" <?php echo  set_select('promo1[roasted_pork]', '100'); ?>>1.5 Kg (RM 65 + RM 35)</option>
						 	<option value="130" <?php echo  set_select('promo1[roasted_pork]', '130'); ?>>2 Kg (RM 65 + RM 65)</option>
						 </select>    			
			    		</td>
			    		<td>
						 <select id="char_siu" class="form-control" name="promo1[char_siu]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="35">500 gram (RM 35)</option>
						 	<option value="60">1 Kg (RM 60)</option>
						 	<option value="95">1.5 Kg (RM 60 + RM 35)</option>
						 	<option value="120">2 Kg (RM 60 + RM 60)</option>
						 </select>			    			
			    		</td>
			    		<td>
						 <select id="duck" class="form-control" name="promo1[duck]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="28">1 piece (RM 28)</option>
						 	<option value="56">2 pieces (RM 56)</option>
						 </select>
			    			
			    		</td>
			    		<td>
						 <select id="chicken" class="form-control" name="promo1[chicken]" onchange="getTotal();">
						 	<option value=''>--Please Select--</option>
						 	<option value="48">1 piece (RM 48)</option>
						 	<option value="96">2 pieces (RM 96)</option>
						 </select>
			    			
			    		</td>
			    	</tr>
			    	<tr>
			    		<td colspan="3"></td>
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
				    	<option value="26-JAN-2016" <?php echo set_select('date', '27-JAN-2016'); ?>>26th January 2016 (年二九)</option>
				    	<option value="27-JAN-2016" <?php echo set_select('date', '27-JAN-2016'); ?>>27th January 2016 (年三十)</option>
				    </select>
				    <?php echo form_error('date', '<span class="help-block">', '</span>'); ?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Time</label>
				    <h4 class="col-sm-10 text-center">Pick up before 4 PM at Foochow Road No 1</h4>
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
			var total = chicken()+ duck()+pork_belly()+char_siu();
			$("#cny_total").html(total); 
		    // alert(sel.value);
		}

		function chicken()
		{
			var chicken = 0;
			chicken = Number($('#chicken option:selected').val());
			return chicken;
		}

		function duck()
		{
			var duck = 0;
			duck = Number($('#duck option:selected').val());
			return duck;
		}

		function pork_belly()
		{
			var pork_belly = 0;
			pork_belly = Number($('#roasted_pork option:selected').val());
			return pork_belly;
		}

		function char_siu()
		{
			var char_siu = 0;
			char_siu = Number($('#char_siu option:selected').val());
			return char_siu;
		}
</script>