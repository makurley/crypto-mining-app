

<?php $__env->startSection('content'); ?>
<br><br><br><br><br>

<section class="section">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Profit Ledger</h2>
                    <p>Mining Profit History</p>
                </div>
            </div>
            <!-- End Title -->
<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>
            <!-- Deals Table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">
                        
                        
<?php if($profits->isEmpty()): ?>
    <p class="text-light text-center">No profit history available.</p>
<?php else: ?>
<div class="text-light text-end mb-3">
    <strong>Total Paid Profit:</strong> $<?php echo e(number_format($totalProfit, 2)); ?>

    <form action="<?php echo e(route('user.withdrawProfit')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <br>
    <button type="submit" class="btn btn-success mb-3">
        Withdraw Profit
    </button>
</form>
</div>


   <table class="deals__table">
    <thead>
        <tr>
             <th>Transaction ID</th>
            <th>Plan</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $profits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                
                <td>
                    <div class="deals__text deals__text--buy"><?php echo e($profit->transaction_id); ?></div>
                </td>
                <td>
                    <?php if($profit->userPlan && $profit->userPlan->plan): ?>
                        <div class="deals__text deals__text--buy"><?php echo e($profit->userPlan->plan->name); ?></div>
                    <?php else: ?>
                        <div class="deals__text deals__text--buy">N/A</div>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="deals__text deals__text--buy">
                        <i class="ti ti-currency-dollar"></i><?php echo e(number_format($profit->amount, 2)); ?>

                    </div>
                </td>
                <td>
                    <div class="deals__text deals__text--buy"><?php echo e($profit->description); ?></div>
                </td>
                <td>
                    <div class="deals__text deals__text--buy"><?php echo e($profit->created_at->format('Y-m-d')); ?></div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>

                    </div>

                    <!-- Design Elements -->
                    <span class="screw screw--lines-bl"></span>
                    <span class="screw screw--lines-br"></span>
                    <span class="screw screw--lines-tr"></span>
                    <span class="screw screw--lines-tl"></span>
                </div>
            </div>
            <!-- End Deals Table -->

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/plans/profit_history.blade.php ENDPATH**/ ?>