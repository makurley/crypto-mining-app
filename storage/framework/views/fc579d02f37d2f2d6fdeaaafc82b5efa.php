

<?php $__env->startSection('content'); ?>
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 row-deck mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3 bg-transparent d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">All Miners</h6>
                        <a href="<?php echo e(route('admin.miner-data.create')); ?>" class="btn btn-sm btn-primary">Add New Miner</a>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>IP</th>
                                        <th>Uptime</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $miners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $miner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($miner->miner_location); ?></td>
                                            <td><?php echo e($miner->miner_ip); ?></td>
                                            <td><?php echo e($miner->up_time); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo e($miner->status === 'active' ? 'success' : ($miner->status === 'down' ? 'danger' : 'warning')); ?>">
                                                    <?php echo e(ucfirst($miner->status)); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('admin.miner-data.edit', $miner->id)); ?>" class="btn btn-sm btn-secondary">Edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6">No miner data available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <?php echo e($miners->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/miner-data/index.blade.php ENDPATH**/ ?>