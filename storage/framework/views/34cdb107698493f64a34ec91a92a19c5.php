
<?php $__env->startSection('title', 'Blog'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>All Blog Posts</h2>

    <a href="<?php echo e(route('admin.blogs.create')); ?>" class="btn btn-primary mb-3">Create New Post</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($post->title); ?></td>
                <td><?php echo e($post->slug); ?></td>
                <td><?php echo e($post->published ? 'Published' : 'Draft'); ?></td>
                <td>
                    <?php if($post->image): ?>
                        <img src="<?php echo e(asset('storage/' . $post->image)); ?>" width="80">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.blogs.edit', $post->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($posts->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/blog/index.blade.php ENDPATH**/ ?>