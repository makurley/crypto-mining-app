
<?php $__env->startSection('title', 'Create Post'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Create Blog Post</h2>
<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
    <form method="POST" action="<?php echo e(route('admin.blogs.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
<div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" class="form-control" required>
</div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="published" value="1" class="form-check-input">
            <label class="form-check-label">Publish</label>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/blog/create.blade.php ENDPATH**/ ?>