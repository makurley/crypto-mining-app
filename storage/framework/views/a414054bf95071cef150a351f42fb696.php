

<?php $__env->startSection('content'); ?>

    	<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h1><?php echo e($settings->title); ?> Mining Racks</h1>
						<p>Choose a cloud mining plan, different hash rate per plan, you can improve dedicated mining profits and Hash</p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<!-- end head -->

	<!-- about -->
	<div class="section section--pb">
		<div class="container">
			<div class="row row--relative">
				<div class="col-12">
					<div class="about">
						<h2 class="about__title"><?php echo e($settings->title); ?> Mining Plans</h2>

						<p class="about__text"><?php echo e($settings->title); ?> mining plans are strategically designed to offer investors reliable 
						and sustainable profitability through cloud-based infrastructure. By removing the need for expensive hardware 
						or complex setup, we provide an accessible and efficient way to participate in cryptocurrency mining. Each plan 
						is carefully structured with varying durations, hashrates, and ROI models to cater to different investment goals 
						and risk preferences.</p>

						
						<!-- design elements -->
						<span class="block-icon block-icon--purple">
							<i class="ti ti-topology-star-2"></i>
						</span>
						<span class="screw screw--lines-bl"></span>
						<span class="screw screw--lines-br"></span>
						<span class="screw screw--lines-tr"></span>
					</div>
				</div>

				<!-- animation background -->
				<div class="section__canvas section__canvas--page section__canvas--first" id="canvas"></div>
			</div>
		</div>
	</div>
	<!-- end about -->

	<!-- arbitrage pools -->
	<div class="section">
		<div class="container">
			<div class="row">
    <!-- Error Notification -->

<!-- Display error message if available -->
<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<!-- Loop through plans and display each -->

<div class="row">
  <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-md-6 col-lg-4">
        <!-- node -->
        <div class="node <?php echo e($plan->sold_out ? 'opacity-50' : ''); ?>">
            <h3 class="node__title node__title--blue">
                <b><?php echo e($plan->name); ?></b>
                <?php if($plan->sold_out): ?>
                    <span class="badge bg-danger" style="font-size: 14px;">Sold Out</span>
                <?php endif; ?>
            </h3>
            <span class="node__date"><?php echo e($plan->duration); ?> day<?php echo e($plan->duration > 1 ? 's' : ''); ?></span>

            <p class="node__title--green">
                <span class="text-white">Asset:</span>
                <b><?php echo e($plan->asset->name ?? $plan->asset_id); ?></b>
            </p>

            <span class="node__line">
                <img src="<?php echo e(asset('assets/img/dodgers/dots--line-orange.svg')); ?>" alt="">
            </span>

            <ul class="node__list">
                <li><i class="ti ti-circle-check"></i><b>$<?php echo e(number_format($plan->price, 2)); ?></b> Cost</li>
                <li><i class="ti ti-circle-check"></i><b><?php echo e(ucfirst($plan->roi_value)); ?>%</b> Interest Profit</li>
                <li><i class="ti ti-circle-check"></i><b>ROI Type:</b> <?php echo e(ucfirst($plan->roi_type)); ?></li>
                <li><i class="ti ti-circle-check"></i><b>$<?php echo e(number_format($plan->expected_profit, 2)); ?></b> Expected Profit</li>
                <li><i class="ti ti-circle-check"></i><b><?php echo e($plan->badge ?? 'N/A'); ?></b></li>
            </ul><br>

            <button type="button"
                class="text-white confirm-btn apool__btn <?php echo e($plan->sold_out ? 'disabled' : ''); ?>"
                data-id="<?php echo e($plan->id); ?>"
                data-name="<?php echo e($plan->name); ?>"
                <?php echo e($plan->sold_out ? 'disabled style=background-color:gray;cursor:not-allowed;' : ''); ?>>
                <?php echo e($plan->sold_out ? 'SOLD OUT' : 'MINE CRYPTO'); ?>

            </button>

            <!-- design elements -->
            <span class="stats__dodger stats__dodger--left stats__dodger--orange"></span>
            <span class="stats__dodger stats__dodger--right stats__dodger--orange"></span>
        </div>
        <!-- end node -->
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
		</div>
	</div>
	<!-- confirm-purchase modal -->
	<div class="modal modal--auto fade" id="confirmPurchaseModal" tabindex="-1" role="dialog"  aria-labelledby="confirmModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>

					<h4 class="modal__title">Confirm Mining Plan Purchase</h4>

					<p class="modal__text">  You are about to purchase <strong id="planName"></strong> mining plan? Click button below to confirm purchase.</p>

					 <form method="POST" id="confirmPurchaseForm" class="modal__form">
            <?php echo csrf_field(); ?>
            <button type="button" class="form__btn" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="form__btn">Confirm</button>
        </form>

					<!-- design elements -->
					<span class="screw screw--big-tl"></span>
					<span class="screw screw--big-bl"></span>
					<span class="screw screw--big-br"></span>
				</div>
			</div>
		</div>
	</div>
	<!-- end confirm-purchase modal -->

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.confirm-btn');
    const modal = new bootstrap.Modal(document.getElementById('confirmPurchaseModal'));
    const planNameField = document.getElementById('planName');
    const confirmForm = document.getElementById('confirmPurchaseForm');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const planId = this.dataset.id;
            const planName = this.dataset.name;
            planNameField.textContent = planName;
            confirmForm.action = `/plans/purchase/${planId}`;
            modal.show();
        });
    });
});
</script>
<?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/plans/index.blade.php ENDPATH**/ ?>