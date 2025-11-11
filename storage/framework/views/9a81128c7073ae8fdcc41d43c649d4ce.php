<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" />
			<link rel="stylesheet" href="<?php echo e(asset('assets/css/splide.min.css')); ?>" />
			<link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>" />

	<!-- Icon font -->
	<link rel="stylesheet" href="<?php echo e(asset('assets/webfont/tabler-icons.min.css')); ?>" />
	<!-- Favicons -->
<link rel="icon" href="<?php echo e(url('public/' . $settings->favicon)); ?>" type="image/png">

	<meta name="description" content="<?php echo e($settings->description); ?>">
	<meta name="keywords" content="">
		<style>
        /* Preloader Styling */
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #16142a;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #preloader img {
            width: 100px;
        }
    </style>
	<title><?php echo e($settings->title); ?></title>
</head>

<body class="body">
	<!-- header -->
  <div id="preloader">
    <img src="<?php echo e(url('public/' . $settings->logo)); ?>" alt="Site Logo" class="" width="50">
  <img src="<?php echo e(asset('public/assets/img/preloader.gif')); ?>" alt="Site Logo" class="" >
</div>

	<!-- end header -->
	
	  <?php echo $__env->yieldContent('content'); ?>


	<!-- footer -->
	<!-- end footer -->

	<!-- ask modal -->
	<div class="modal modal--auto fade" id="modal-ask" tabindex="-1" aria-labelledby="modal-ask" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<button class="modal__close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>

					<h4 class="modal__title">Ask a question</h4>

					<p class="modal__text">Our support team is always on call, and ready to help with all your questions!</p>

					<form action="#" class="modal__form">
						<div class="form__group">
							<input name="name" type="text" class="form__input" placeholder="Name">
						</div>

						<div class="form__group">
							<input name="mail" type="text" class="form__input" placeholder="Email">
						</div>

						<div class="form__group">
							<textarea name="question" class="form__textarea" placeholder="Your question"></textarea>
						</div>

						<button class="form__btn" type="button">Send</button>
					</form>

					<!-- design elements -->
					<span class="screw screw--big-tl"></span>
					<span class="screw screw--big-bl"></span>
					<span class="screw screw--big-br"></span>
				</div>
			</div>
		</div>
	</div>
	<!-- end ask modal -->

	<!-- JS -->
	<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/smooth-scrollbar.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/splide.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/three.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/vanta.fog.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/smooth-scrollbar.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/splide.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/three.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/vanta.fog.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
	<script>
    window.addEventListener("load", function () {
        // Enforce a minimum 5-second delay before showing content
        setTimeout(function () {
            const preloader = document.getElementById("preloader");
            const content = document.getElementById("main-content");

            preloader.style.opacity = "0";
            preloader.style.transition = "opacity 0.1s ease";

            setTimeout(function () {
                preloader.style.display = "none";
                content.style.display = "block";
            }, 500); // Give fade-out time
        }, 2000); // 5 seconds delay
    });
</script>
</body>

</html><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/auth/layouts/main.blade.php ENDPATH**/ ?>