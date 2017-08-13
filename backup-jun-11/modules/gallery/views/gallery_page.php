<div class="container">
	<h2>MENU</h2>
  <div class="row">

		<div class='list-group gallery'>
		<?php foreach ($food_image_list as $key => $value): ?>
            <div class='col-sm-12 col-xs-12 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="#">
                    <img class="img-responsive" alt="" src="<?php echo base_url('assets/images/gallery')?>/<?php echo $value['pic_url']?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?php echo $value['menu_english']?></small>
                    </div> <!-- text-right / end -->
                </a>
            </div>			
		<?php endforeach ?>
        </div> <!-- list-group / end -->
  </div>

</div>

<div class="container">
	<h2>CATERING BUFFET EVENT</h2>
  <div class="row">
		<div class='list-group gallery'>
		<?php foreach ($buffet as $key => $value): ?>
            <div class='col-sm-12 col-xs-12 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="#">
                    <img class="img-responsive" alt="" src="<?php echo base_url('assets/images/gallery')?>/<?php echo $value['img_path']?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?php echo $value['name']?></small>
                    </div> <!-- text-right / end -->
                </a>
            </div>			
		<?php endforeach ?>
        </div> <!-- list-group / end -->
  </div>
</div>


<div class="container">
	<h2>MEAL BOX</h2>
  <div class="row">
		<div class='list-group gallery'>
		<?php foreach ($mealbox as $key => $value): ?>
            <div class='col-sm-12 col-xs-12 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="#">
                    <img class="img-responsive" alt="" src="<?php echo base_url('assets/images/gallery')?>/<?php echo $value['img_path']?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?php echo $value['name']?></small>
                    </div> <!-- text-right / end -->
                </a>
            </div>			
		<?php endforeach ?>
        </div> <!-- list-group / end -->
  </div>

</div>


<div class="container">
	<h2>MONTHLY CATER</h2>
  <div class="row">

		<div class='list-group gallery'>
		<?php foreach ($monthly_cater as $key => $value): ?>
            <div class='col-sm-12 col-xs-12 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="#">
                    <img class="img-responsive" alt="" src="<?php echo base_url('assets/images/gallery')?>/<?php echo $value['img_path']?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?php echo $value['name']?></small>
                    </div> <!-- text-right / end -->
                </a>
            </div>			
		<?php endforeach ?>
        </div> <!-- list-group / end -->
  </div>

</div>