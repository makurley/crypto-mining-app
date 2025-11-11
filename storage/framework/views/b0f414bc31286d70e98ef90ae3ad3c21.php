
<?php $__env->startSection('title', $settings->title . ' Blog'); ?>

<?php $__env->startSection('content'); ?>
<div class="section section--head">
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12">
                <div class="section__title">
                    <h1><?php echo e($settings->title); ?> Blog</h1>
                    <p>Stay informed with the latest updates from MineWatts. Explore news about our mining 
                    infrastructure developments, industry insights, cryptocurrency trends, investment opportunities, 
                    promotional offers, token launches, platform updates, and much more—all in one place.</p>
                </div>
            </div>
            <!-- end title -->
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <!-- post -->
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="post">
                    <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="post__img">
                        <?php if($post->image): ?>
                         <img src="<?php echo e(asset('public/storage/' . $post->image)); ?>">

                        <?php endif; ?>
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category"><?php echo e($post->category); ?></a>
                        <h3 class="post__title text-white">
                            <a href="<?php echo e(route('blog.show', $post->slug)); ?>"><?php echo e($post->title); ?></a>
                        </h3>
                        <div class="post__meta">
                            <span class="post__date">
                                <i class="ti ti-calendar-up"></i> <?php echo e($post->created_at->format('d.m.y')); ?>

                            </span>
                            <span class="post__views">
                                <i class="ti ti-eye"></i> <?php echo e(rand(10, 100)); ?> <!-- Replace with real views logic if needed -->
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- end post -->
        </div>

        <!-- pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <?php echo e($posts->links()); ?>

            </div>
        </div>
        <!-- end pagination -->
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/blog/index.blade.php ENDPATH**/ ?>