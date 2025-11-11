

<?php $__env->startSection('content'); ?>
<br><br><br><br><br>
    
<section class="section">
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Active Miners</h2>
                    <p>Active Mining Plans</p>
                </div>
            </div>
            <!-- end title -->

            <!-- deals table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">
                        <table class="deals__table">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Capital</th>
                                    <th>Expected Profit</th>
                                    <th>Status</th>
                                    <th>Expiry Date</th>
                                    <th>Countdown</th> <!-- New column for countdown -->
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $userPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userPlan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="deals__text"><?php echo e($userPlan->plan->name); ?></div>
                                    </td>
                                    <td>
                                        <div class="deals__exchange">
                                            <span class="green">$<?php echo e(number_format($userPlan->price, 2)); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy"><i class="ti ti-currency-dollar"></i><?php echo e(number_format($userPlan->expected_profit, 2)); ?></div>
                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--buy"><?php if($userPlan->status === 'processing'): ?>
    <span class="badge bg-warning text-dark">Processing</span>
<?php elseif($userPlan->status === 'active'): ?>
    <span class="badge bg-success">Active</span>
<?php elseif($userPlan->status === 'completed'): ?>
    <span class="badge bg-secondary">Completed</span>
<?php else: ?>
    <span class="badge bg-danger">Expired</span>
<?php endif; ?></div>
                                    </td>
                                    <td>
                                     <div class="deals__text deals__text--sell"><?php echo e($userPlan->expires_at->timezone('UTC')->format('Y-m-d H:i:s')); ?></div>

                                    </td>
                                    <td>
                                        <div class="deals__text deals__text--sell" id="countdown-<?php echo e($userPlan->id); ?>"></div> <!-- Countdown timer -->
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- design elements -->
                    <span class="screw screw--lines-bl"></span>
                    <span class="screw screw--lines-br"></span>
                    <span class="screw screw--lines-tr"></span>
                    <span class="screw screw--lines-tl"></span>
                </div>
            </div>
            <!-- end deals table -->
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php $__currentLoopData = $userPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userPlan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            // Ensure the expiration date is in a valid format (e.g., '2025-05-30 15:30:00')
            var countDownDate<?php echo e($userPlan->id); ?> = new Date("<?php echo e($userPlan->expires_at->toIso8601String()); ?>").getTime();

            // Update the countdown every 1 second
            var x<?php echo e($userPlan->id); ?> = setInterval(function() {
                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the countdown date
                var distance = countDownDate<?php echo e($userPlan->id); ?> - now;

                // Time calculations for days, hours, minutes, and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the countdown element
                document.getElementById("countdown-<?php echo e($userPlan->id); ?>").innerHTML =
                    days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                // If the countdown is over, display a message
                if (distance < 0) {
                    clearInterval(x<?php echo e($userPlan->id); ?>);
                    document.getElementById("countdown-<?php echo e($userPlan->id); ?>").innerHTML = "EXPIRED";
                }
            }, 1000);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/plans/my_plans.blade.php ENDPATH**/ ?>