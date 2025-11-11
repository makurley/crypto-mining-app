


<?php $__env->startSection('title', 'Post details'); ?>
<?php $__env->startSection('content'); ?>
<div class="section section--head">
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<div class="section__title">
						<h1><?php echo e($post->title); ?></h1>	</div>
				</div>
				<!-- end title -->
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-10 offset-xl-1">
					<div class="article">
						<!-- article content -->
						<div class="article__content">
							<div class="article__meta">
								<a href="#" class="article__category text-red"><?php echo e($post->category); ?></a>

								<span class="article__date"><i class="ti ti-calendar-up"></i><?php echo e($post->created_at->format('d M Y')); ?></span>
							</div>
							<?php if($post->image): ?>
   <img src="<?php echo e(asset('public/storage/' . $post->image)); ?>">
<?php endif; ?>

						
							    <p><?php echo nl2br(e($post->body)); ?></p>
							  
							
						</div>
						<!-- end article content -->

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end article -->
		<?php $__env->stopSection(); ?>
	
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/blog/show.blade.php ENDPATH**/ ?>