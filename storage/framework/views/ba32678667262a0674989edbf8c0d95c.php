
<?php $__env->startSection('title', 'Edit plan'); ?>

<?php $__env->startSection('content'); ?>
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 row-deck mb-3">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header py-3 d-flex bg-transparent">
                        <h6 class="mb-0 fw-bold">Create Plan</h6>
                    </div>
                    <div class="card-body">
                        <!-- Error Notification -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    <form action="<?php echo e(route('admin.plans.update', $plan->id)); ?>" method="POST">
   <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="name">Plan Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $plan->name)); ?>" required>
    </div>
    <div class="form-group">
        <label for="hashrate">Hashrate</label>
        <input type="text" class="form-control" id="hashrate" name="hashrate" value="<?php echo e($plan->hashrate); ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
<input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo e($plan->price); ?>" required>
    </div>
    <div class="form-group">
        <label for="duration">Duration (Months)</label>
        <input type="number" class="form-control" id="duration" name="duration" value="<?php echo e($plan->duration); ?>" required>

    </div>
    <div class="form-group">
        <label for="roi_value">ROI Value</label>
       <input type="number" step="0.01" class="form-control" id="roi_value" name="roi_value" value="<?php echo e($plan->roi_value); ?>" required>

    </div>
    <div class="form-group">
        <label for="roi_type">ROI Type</label>
        <select class="form-control" id="roi_type" name="roi_type" value="">
            <option value="percentage">Percentage</option>
            <option value="fixed">Fixed</option>
        </select>
    </div>
      <div class="form-group">
       <label for="expected_profit" class="form-label">Expected Profit</label>
   <input type="number" step="0.01" name="expected_profit" class="form-control" value="<?php echo e($plan->expected_profit); ?>" required>

    </div>
    <div class="form-group">
    <label for="sold_out">Sold Out?</label>
    <select name="sold_out" id="sold_out" class="form-control">
        <option value="0" <?php echo e(old('sold_out', $plan->sold_out ?? 0) == 0 ? 'selected' : ''); ?>>No</option>
        <option value="1" <?php echo e(old('sold_out', $plan->sold_out ?? 0) == 1 ? 'selected' : ''); ?>>Yes</option>
    </select>
</div>
  <div class="form-group">
    <label for="power_charge">Power Charge ($)</label>
    <input type="number" name="power_charge" class="form-control" step="0.01"
           value="">
</div>
    <div class="form-group">
        <label for="badge">Badge</label>
        <select class="form-control" id="badge" name="badge">
            <option value="popular">Popular</option>
            <option value="recommended">Recommended</option>
            <option value="starters">Starters</option>
        </select>
    </div>
<br>
    <button type="submit" class="btn btn-primary">Update Plan</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/plans/edit.blade.php ENDPATH**/ ?>