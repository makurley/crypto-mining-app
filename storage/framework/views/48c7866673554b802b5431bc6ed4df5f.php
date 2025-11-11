
<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('content'); ?>
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 row-deck mb-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header py-3 d-flex bg-transparent">
                        <h6 class="mb-0 fw-bold">Create Plan</h6>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
                        
                    <form action="<?php echo e(route('admin.referral-settings.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="bonus_amount" class="form-label">Referral Bonus Amount (%)</label>
            <input type="number" step="0.01" name="bonus_amount" id="bonus_amount" class="form-control" value="<?php echo e(old('bonus_amount', $settings->bonus_amount ?? 0)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="referral_active" class="form-label">Referral Status</label>
            <select name="referral_active" id="referral_active" class="form-control">
                <option value="1" <?php echo e(isset($settings) && $settings->referral_active ? 'selected' : ''); ?>>On</option>
                <option value="0" <?php echo e(isset($settings) && !$settings->referral_active ? 'selected' : ''); ?>>Off</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Settings</button>
    </form>    
                        
                        
                           </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/referral-settings.blade.php ENDPATH**/ ?>