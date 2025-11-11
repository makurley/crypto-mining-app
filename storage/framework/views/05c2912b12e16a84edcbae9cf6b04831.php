
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

                  <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="row">
        <div class="col-md-6">
            <label>Title</label>
            <input name="title" class="form-control" value="<?php echo e($settings->title); ?>">
        </div>
        <div class="col-md-6">
            <label>Description</label>
            <input name="description" class="form-control" value="<?php echo e($settings->description); ?>">
        </div>
        <div class="col-md-6">
            <label>Phone</label>
            <input name="phone" class="form-control" value="<?php echo e($settings->phone); ?>">
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input name="email" class="form-control" value="<?php echo e($settings->email); ?>">
        </div>
        <div class="col-md-6">
            <label>Address</label>
            <input name="address" class="form-control" value="<?php echo e($settings->address); ?>">
        </div>

        <div class="col-md-4">
            <label>Touch Icon</label>
            <input type="file" name="touch_icon" class="form-control">
        </div>
        <div class="col-md-4">
            <img src="<?php echo e(url('public/' . $settings->favicon)); ?>" alt="Site Logo" class="header__logo" width="50">

            <label>Favicon</label>
            <input type="file" name="favicon" class="form-control">
        </div>
        <div class="col-md-4">
<img src="<?php echo e(url('public/' . $settings->logo)); ?>" alt="Site Logo" class="header__logo" width="50">

            <label>Logo</label>
             <input type="file" name="logo" accept="image/*">
        </div>

        <div class="col-md-6">
            <label>Facebook</label>
            <input name="facebook" class="form-control" value="<?php echo e($settings->facebook); ?>">
        </div>
        <div class="col-md-6">
            <label>Twitter</label>
            <input name="twitter" class="form-control" value="<?php echo e($settings->twitter); ?>">
        </div>
        <div class="col-md-6">
            <label>Instagram</label>
            <input name="instagram" class="form-control" value="<?php echo e($settings->instagram); ?>">
        </div>
        <div class="col-md-6">
            <label>Telegram</label>
            <input name="telegram" class="form-control" value="<?php echo e($settings->telegram); ?>">
        </div>
        <div class="col-md-6">
            <label>WhatsApp</label>
            <input name="whatsapp" class="form-control" value="<?php echo e($settings->whatsapp); ?>">
        </div>

        <div class="col-md-6">
            <label>Currency</label>
            <input name="currency" class="form-control" value="<?php echo e($settings->currency); ?>">
        </div>
        <div class="col-md-6">
            <label>Currency Code</label>
            <input name="currency_code" class="form-control" value="<?php echo e($settings->currency_code); ?>">
        </div>

        <div class="col-md-6">
            <label>Primary Color</label>
            <input type="color" name="primary_color" class="form-control" value="<?php echo e($settings->primary_color); ?>">
        </div>

        <div class="col-md-12">
            <label>Custom CSS</label>
            <textarea name="custom_css" class="form-control"><?php echo e($settings->custom_css); ?></textarea>
        </div>
        <div class="col-md-12">
            <label>Custom JS</label>
            <textarea name="custom_js" class="form-control"><?php echo e($settings->custom_js); ?></textarea>
        </div>

        <div class="col-md-12 mt-3">
            <div class="form-check">
                <input type="checkbox" name="is_announcement" class="form-check-input" <?php echo e($settings->is_announcement ? 'checked' : ''); ?>>
                <label class="form-check-label">Enable Announcement</label>
            </div>
            <textarea name="announcement" class="form-control mt-2"><?php echo e($settings->announcement); ?></textarea>
        </div>

        <div class="col-md-12 mt-3">
            <div class="form-check">
                <input type="checkbox" name="is_adsense" class="form-check-input" <?php echo e($settings->is_adsense ? 'checked' : ''); ?>>
                <label class="form-check-label">Enable Adsense</label>
            </div>
            <textarea name="google_adsense" class="form-control mt-2"><?php echo e($settings->google_adsense); ?></textarea>
        </div>

        <div class="col-md-12 mt-3">
            <div class="form-check">
                <input type="checkbox" name="is_analytics" class="form-check-input" <?php echo e($settings->is_analytics ? 'checked' : ''); ?>>
                <label class="form-check-label">Enable Google Analytics</label>
            </div>
            <input name="google_analytics_id" class="form-control mt-2" value="<?php echo e($settings->google_analytics_id); ?>">
        </div>

        <div class="col-md-12 mt-3">
            <div class="form-check">
                <input type="checkbox" name="is_youtube_link" class="form-check-input" <?php echo e($settings->is_youtube_link ? 'checked' : ''); ?>>
                <label class="form-check-label">Enable YouTube Link</label>
            </div>
            <input name="youtube_link" class="form-control mt-2" value="<?php echo e($settings->youtube_link); ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Update Settings</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>