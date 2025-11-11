


<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>


	<!-- page wrap -->
	<div class="section section--content">
		<div class="section__content">
		    
		    		<!-- form -->
		<!-- form -->
<!-- Success/Error Notification -->
<form method="POST" class="form form--content" action="<?php echo e(route('verification.send')); ?>">
    <?php echo csrf_field(); ?>

    
    <?php if(session('status')): ?>
        <div class="alert alert-success text-success text-center mb-3">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger text-white text-center mb-3">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="form__logo-wrap">
        <a href="" class="form__logo">
            <img src="<?php echo e(url('/' . $settings->logo)); ?>" alt="Site Logo" class="header__logo">
        </a>
    </div>

    <button class="form__btn" type="submit">Resend Verification Email</button>

    <!-- design elements -->
    <span class="block-icon block-icon--purple">
        <i class="ti ti-login"></i>
    </span>
    <span class="screw screw--big-tr"></span>
    <span class="screw screw--big-bl"></span>
    <span class="screw screw--big-br"></span>
</form>


			<!-- end form -->
		</div>

		<!-- animation background -->
	</div>
	<!-- end page wrap -->

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/auth/verify.blade.php ENDPATH**/ ?>