<style type="text/css">
.wrapper {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  grid-column-gap: 1px;
  grid-row-gap: 1px;
  background-color: #fff;
  /*color: #444;*/
  grid-auto-rows :minmax(20px,auto);
}

.box {
  /*background-color: #444;*/
  /*color: #fff;*/
  padding: 10px;
  border: 1px solid grey;
/*  font-size: 150%;*/
}

.box p {
	margin-top: 5px;
	margin-bottom: 5px;
}

.header > h1
{
	text-align: center;
	margin-top: 10px;
	margin-bottom: 10px;

}

.box > h2 {
	margin: 0px;
}

.header {
	grid-column:1/5;


	/*grid-row: 1;*/
}





</style>
<?php 
	
    $lunch_data = array();
    $dinner_data = array();
?>

<?php foreach ($order_report as $session => $v) { ?>
	<?php if ($session == 'lunch'): ?>
		<?php $lunch_data = $v; ?>
	<?php endif ?>
	<?php if ($session == 'dinner'): ?>
		<?php $dinner_data = $v; ?>
	<?php endif ?>	
<?php }?>



<div class="wrapper">
  <div class="header"><h1>LUNCH</h1></div>
  <?php foreach ($lunch_data as $key => $v): ?>
  	<div class="box">
  		<h2>*<?= $v['name']; ?> MBR<?= $v['customer_id']+3000; ?>*</h2>
  		<p>Status : <?= $v['status']; ?></p>
  		<p><address><?= $v['address']; ?></address></p>


		<?php foreach ($v['food'] as $k => $list): ?>
			<strong>--<?= $list ?></strong><br>
		<?php endforeach ?>
		<?php if ( $v['status'] == 'processing'): ?>
			RM <?= $v['total']; ?>
		<?php endif ?>		  

  	</div>
  <?php endforeach ?>
</div>

<div class="wrapper">
  <div class="header"><h1>DINNER</h1></div>
  <?php foreach ($dinner_data as $key => $v): ?>
  	<div class="box">
  		<h2>*<?= $v['name']; ?> MBR<?= $v['customer_id']+3000; ?>*</h2>
  		<p>Status : <?= $v['status']; ?></p>
  		<p><address><?= $v['address']; ?></address></p>


		<?php foreach ($v['food'] as $k => $list): ?>
			<strong>--<?= $list ?></strong><br>
		<?php endforeach ?>
		<?php if ( $v['status'] == 'processing'): ?>
			RM <?= $v['total']; ?>
		<?php endif ?>		  

  	</div>
  <?php endforeach ?>
</div>


	
	




