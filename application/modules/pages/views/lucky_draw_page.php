

<section>



<?php if ($this->session->userdata('customer_logged_in')): ?>
	<?php $customer_joined = $this->pages->has_joined($this->session->customer_id); ?>
<?php if ($customer_joined): ?>
	<div class="container">
		<div class="alert alert-success">
		  <strong>恭喜!</strong> 参赛成功按 <a href="<?= base_url('home');?>">[这里]</a>回主页
		</div>
		<p></p>
	</div>
<?php else: ?>
	
	<div class="container">
	  <h3 class="text-center">Lucky Draw [5th Aug 2017]</h3>
	  <p class="text-center">为了公平起见你只可以选 <strong>1</strong> 样</p>
	  <form action="<?= base_url('lucky-draw')?>" method="post">
	  <?php echo form_error('prize', '<div class="alert alert-warning">', '</div>'); ?>
	    <div class="radio">
	      <label>
	      <input type="radio" name="prize" value="1">凡签购 RM 180 配套送出一个 豪华餐盒 -----x1
	      </label>
	    </div>
	    <div class="radio">
	      <label>
	      <input type="radio" name="prize" value="2">免费送出豪华餐盒 -----x1
	      </label>
	    </div>
	    <div class="radio">
	      <label>
	      	<input type="radio" name="prize" value="3">伙食回扣 20% (必须签两人份) -----x3
	      </label>
	    </div>
	    
	    <button class="btn btn-primary btn-block">SUBMIT</button>
	  </form>
	</div>

	
<?php endif ?>




<?php else: ?>
	<div class="container">
		<h3 class="text-center">你必须登陆才可以参加游戏!</h3>
		<p class="text-center"><a href="<?= base_url('login'); ?>">Login Link</a></p>
	</div>
<?php endif ?>


</section>