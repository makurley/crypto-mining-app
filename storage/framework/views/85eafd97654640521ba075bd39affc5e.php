

<?php $__env->startSection('content'); ?>
<br><br><br><br><br>

<section class="section">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Refeeral Bonus</h2>
                    <p>Bonus Withdrawal History</p>
                </div>
            </div>
            <!-- End Title -->

            <!-- Total Paid Profit Section -->
       <!-- Total Paid Profit Section -->
            <!-- End Total Paid Profit -->

            <!-- Deals Table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">
  <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($history->isEmpty()): ?>
        <p>No referral bonus history available.</p>
    <?php else: ?>
                            <table class="deals__table">
                                <thead>
                                 <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <div class="deals__text deals__text--buy"><?php echo e($index + 1); ?></div></td>
                            <td> <div class="deals__text deals__text--buy"><?php echo e($history->description); ?></div></td>
                            <td> <div class="deals__text deals__text--buy">$<?php echo e(number_format($history->amount, 2)); ?></div></td>
                            <td> <div class="deals__text deals__text--buy"><?php echo e($history->created_at->format('d M, Y h:i A')); ?></div></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                            </table>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <!-- End Deals Table -->


        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/referral-history.blade.php ENDPATH**/ ?>