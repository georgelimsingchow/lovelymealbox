<script type="text/javascript">    
    $(function() {
        $("input[name='box-quantity']").TouchSpin({
		initval: 1,
		min:1,
		max:50,
		buttondown_class: 'btn btn-danger',
		buttonup_class: 'btn btn-primary',
		buttondown_txt: '<i class="glyphicon glyphicon-minus"></i>',
		buttonup_txt: '<i class="glyphicon glyphicon-plus"></i>'
	});
    });
 </script>
	<input type="hidden" name="id" value="<?php echo $alacarte->id; ?>">
  <div class="form-group">
    <label class="col-xs-3 control-label">MEAL</label>
    <div class="col-xs-9">
      <p class="form-control-static text-center"><?php echo $alacarte->menu_chinese." ".$alacarte->menu_english; ?></p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-xs-3 control-label">PER PRICE</label>
    <div class="col-xs-9">
      <p class="form-control-static text-center">RM <span id="alacarte-price"><?php echo number_format($alacarte->price,2); ?></span></p>
    </div>
  </div>


<div class="form-group">
	<label class="control-label col-xs-3">QUANTITY</label>
	<div class="col-xs-9">
	<div class="row"><div class="col-xs-12">
    		<input id="alacarte-qty" type="text" value="" name="box-quantity" class="text-center form-control">
  		</div></div>
  		
	</div>
</div>

<div class="form-group">
	<label class="control-label col-xs-3">TOTAL</label>
		<div class="col-xs-9">
			<p class="form-control-static text-center">RM <span id="alacarte-total">0.00<span></p>
		</div>
</div>