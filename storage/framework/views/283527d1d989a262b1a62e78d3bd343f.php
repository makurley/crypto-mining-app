
<?php $__env->startSection('content'); ?>

    	<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
					<div class="section__title">
						<h1>Congratulations</h1>
						<p>You have successfully purchased the plan: <strong><?php echo e(session('plan_name')); ?></strong></p>
					</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<!-- end head -->
	<!-- about -->
	<style>.deals__table-wrap {
    margin: 0 auto; /* Center the table wrap */
}

.table {
    width: 100%; /* Ensure the table takes full width */
}

.deals__text {
    margin: 0; /* Remove any default margin */
}</style>
<div class="section section--pb">
    <div class="container">
        <div class="row row--relative">
            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                <div class="about">
                    <div class="deals__table-wrap">
                        <table class="table table-responsive w-100">
                            <thead>
                                <tr>
                                    <th> <div class="deals__text deals__text--buy">Type</div></th>
                                    <th> <div class="deals__text deals__text--buy">Description</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">Crypto Type:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy"><?php echo e(session('crypto_type')); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">Amount Invested:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy">$<?php echo e(number_format(session('invested_amount'), 2)); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">ROI Per Day:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy"><?php echo e(session('roi_percentage')); ?>%</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">Duration:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy"><?php echo e(session('duration')); ?> days</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">Daily Profit:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy">$<?php echo e(number_format(session('daily_profit'), 2)); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">Total Profit:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy">$<?php echo e(number_format(session('total_profit'), 2)); ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="deals__text deals__text--buy">Total Return:</div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy">$<?php echo e(number_format(session('return_amount'), 2)); ?></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-success mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <!-- animation background -->
</div>
	<!-- end about -->

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/mining/purchaseconfirm.blade.php ENDPATH**/ ?>