
<?php $__env->startSection('title', 'Edit Blog'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Blog Post</h2>

    <form method="POST" action="<?php echo e(route('admin.blogs.update', $post->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label>Title</label>
           <input type="text" name="title" value="<?php echo e(old('title', $post->title)); ?>" required>
        </div>
<div class="mb-3">
    <label>Category</label>
    <input type="text" name="category" value="<?php echo e(old('category', $post->category)); ?>" class="form-control" required>
</div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required><?php echo e($post->body); ?></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label><br>
            <?php if($post->image): ?>
                <img src="<?php echo e(asset('storage/' . $post->image)); ?>" width="100" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="published" value="1" class="form-check-input" <?php echo e($post->published ? 'checked' : ''); ?>>
            <label class="form-check-label">Published</label>
        </div>

        <button type="submit" class="btn btn-success">Update Post</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/blog/edit.blade.php ENDPATH**/ ?>