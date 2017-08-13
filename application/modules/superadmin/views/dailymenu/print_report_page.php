<div class="container">
	<div class="row">
	<?php $counter = 1;?>
	<?php foreach ($menu as $key => $value) { ?>
		<div class="col-xs-3 foo">
		<h4 class="text-center"><?php echo $value['slug'];?></h4>
		<ol>
			<?php foreach ($value['decoded'] as $k => $v) { ?>
				<li><?php echo $v;?></li>
			<?php }?>
        </ol>
		</div>
        <?php $counter++;?>
        <?php if (($counter % 4) == 0) {?>
          <div class="clearfix"></div>
        <?php } ?>
	<?php }?>
	</div>

</div>