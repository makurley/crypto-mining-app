

<?php $__env->startSection('content'); ?>

<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                <div class="section__title">
                    <h1>Withdrawal Confirmation</h1>
                </div>
            </div>

            <div class="section section--pb">
                <div class="container">
                    <div class="row row--relative">
                            <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                                <div class="about">
                                    <h3 class="about__text">
                                        <strong>Recieving Wallet Type:</strong> <?php echo e(ucfirst($withdrawal->wallet_type)); ?></h3>
                                         <p class="about__text"> <strong>Wallet Address:</strong><?php echo e($withdrawal->wallet_address); ?></p>
                                         <p class="about__text"> <strong>Amount:</strong> $<?php echo e(number_format($withdrawal->amount, 2)); ?></p>
                                         <p class="about__text"><strong>Status:</strong> <?php echo e(ucfirst($withdrawal->status)); ?></p>
                                    <br>

                                    <input type="text" name="user_confirm" id="user_confirm" class="apool__input" value="I've made payment" hidden>

                                    <div class="col-12 text-center"> <!-- Centering the button -->
                                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary mt-3">Back to Dashboard</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- Animation background -->
            </div>
            <!-- End Title -->
        </div>
    </div>
</div>
<!-- End Head -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/withdraw/confirmation.blade.php ENDPATH**/ ?>