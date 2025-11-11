

<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>


	<!-- page wrap -->
	<div class="section section--content">
		<div class="section__content">

			<!-- form -->
		 <form method="POST" class="form form--content" action="<?php echo e(route('password.email')); ?>">
		     		     
<?php echo csrf_field(); ?>
				<div class="form__logo-wrap">
					<a href="" class="form__logo">
						<img src="<?php echo e(asset('assets/img/logo.svg')); ?>" alt="">
					</a>
					<span class="form__tagline">Cloud Phanton</span>
				</div>
	  <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
				<div class="form__group">
				    <label class="form__label">Forgot Password</label>
					<input type="email" class="form__input" name="email" placeholder="Email" required>
				</div>
				
				<button class="form__btn" type="submit">FORGOT PASSWORD</button>
                	<span class="form__text form__text--center">Remember password? <a href="<?php echo e(route('login')); ?>">Login</a></span>
			
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
<?php echo $__env->make('auth.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>