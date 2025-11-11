


<?php $__env->startSection('content'); ?>

<div class="section section--head">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
				<div class="section__title">
					<h1><?php echo e($settings->title); ?> Mining Contracts</h1>
					<p>Choose a cloud mining plan, different hash rate per plan, you can improve dedicated mining profits and Hash using custom mining contracts.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section section--pb">
	<div class="container">
		<div class="row row--relative">
			<div class="col-12">
				<div class="about">
					<h2 class="about__title"><?php echo e($settings->title); ?> Contracts</h2>
					<p class="about__text">MineWatts Mining Contracts, our mining contracts are strategically designed to offer investors reliable and sustainable 
					profitability through cloud-based infrastructure. By removing the need for expensive hardware or complex setup, we provide 
					an accessible and efficient way to participate in cryptocurrency mining. Each plan is carefully structured with varying durations, 
					hashrates, and ROI models to cater to different investment goals and risk preferences.</p>

					<span class="block-icon block-icon--purple"><i class="ti ti-topology-star-2"></i></span>
					<span class="screw screw--lines-bl"></span>
					<span class="screw screw--lines-br"></span>
					<span class="screw screw--lines-tr"></span>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<?php if(session('error')): ?>
				<div class="alert alert-danger"><?php echo e(session('error')); ?></div>
			<?php endif; ?>

		<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-12 col-md-6 col-lg-4">
		<div class="node <?php echo e($plan->sold_out ? 'opacity-50' : ''); ?>">
			<h3 class="node__title node__title--blue">
				<b><?php echo e($plan->name); ?></b>
				<?php if($plan->sold_out): ?>
					<span class="badge bg-danger" style="font-size: 14px;">Sold Out</span>
				<?php endif; ?>
			</h3>
			<span class="node__date"><?php echo e($plan->duration); ?> day<?php echo e($plan->duration > 1 ? 's' : ''); ?></span>

			<p class="node__title--green"><span class="text-white">Asset:</span> <b><?php echo e($plan->asset->name ?? $plan->asset_id); ?></b></p>

			<span class="node__line">
				<img src="<?php echo e(asset('assets/img/dodgers/dots--line-orange.svg')); ?>" alt="">
			</span>

			<ul class="node__list">
				<li><i class="ti ti-circle-check"></i><b>$<?php echo e(number_format($plan->price, 2)); ?></b> Cost</li>
				<li><i class="ti ti-circle-check"></i><b><?php echo e(ucfirst($plan->roi_value)); ?>%</b> Interest Profit</li>
				<li><i class="ti ti-circle-check"></i><b>ROI Type:</b> <?php echo e(ucfirst($plan->roi_type)); ?></li>
				<li><i class="ti ti-circle-check"></i>Profit: <b>$<?php echo e(number_format($plan->expected_profit, 2)); ?></b></li>
				<li><i class="ti ti-circle-check"></i><b><?php echo e($plan->badge ?? 'N/A'); ?></b></li>
			</ul><br>

			<?php if($plan->sold_out): ?>
				<a href="javascript:void(0);" class="apool__btn btn-secondary disabled" style="cursor: not-allowed;">SOLD OUT</a>
			<?php else: ?>
				<a href="<?php echo e(route('login')); ?>" class="apool__btn">MINE CRYPTO</a>
			<?php endif; ?>

			<span class="stats__dodger stats__dodger--left stats__dodger--orange"></span>
			<span class="stats__dodger stats__dodger--right stats__dodger--orange"></span>
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/mining-contracts.blade.php ENDPATH**/ ?>