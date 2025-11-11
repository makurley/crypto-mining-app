

<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>


	<!-- page wrap -->
	<div class="section section--content">
		<div class="section__content">
			<!-- form -->
		 <form method="POST" class="form form--content" action="<?php echo e(route('login.post')); ?>">
		     
	   <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        
		      <?php echo csrf_field(); ?>
				<div class="form__logo-wrap">
					<a href="" class="form__logo">
						<img src="<?php echo e(url('public/' . $settings->logo)); ?>" alt="Site Logo" style="width: 150px; height: auto;">
					</a></div>
					 <div class="form__group">
<span class="form__text form__text--center">Sign in</span></div>

				<div class="form__group">
					<input type="email" class="form__input" name="email" placeholder="Email" required>
				</div>

				<div class="form__group">
					<input type="password" name="password" class="form__input" placeholder="Password" required>
				</div>

				<div class="form__group form__group--checkbox">
					<input id="remember" name="remember" type="checkbox">
					<label for="remember">Remember Me</label>
				</div>
				
				<button class="form__btn" type="submit">Sign in</button>

				<span class="form__delimiter">or</span>

				<div class="form__social">
					<a class="fb" href="#"><i class="ti ti-brand-facebook"></i></a>
					<a class="tw" href="#"><i class="ti ti-brand-x"></i></a>
					<a class="gl" href="#"><i class="ti ti-brand-google"></i></a>
				</div>

				<span class="form__text form__text--center">Don't have an account? <a href="<?php echo e(route('register')); ?>">Sign up!</a><br> <a href="<?php echo e(route('password.request')); ?>">Forgot password?</a><br> <a href="<?php echo e(route('home')); ?>">Home</a></span>
                
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
<?php echo $__env->make('auth.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/auth/login.blade.php ENDPATH**/ ?>