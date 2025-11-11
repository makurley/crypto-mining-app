
<?php $__env->startSection('title', 'home'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Crypto Deposits</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Crypto</th>
                <th>Amount (Fiat)</th>
                <th>Crypto Amount</th>
                <th>Wallet Address</th>
                <th>Status</th>
                <th>User Confirm</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($deposit->user->username ?? 'User Deleted'); ?></td>
                    <td><?php echo e($deposit->crypto_type); ?></td>
                    <td>$<?php echo e(number_format($deposit->amount, 2)); ?></td>
                    <td><?php echo e($deposit->crypto_amount); ?> <?php echo e($deposit->crypto_type); ?></td>
                    <td><?php echo e($deposit->wallet_address); ?></td>
                    <td>
                        <?php if($deposit->status == 'pending'): ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php elseif($deposit->status == 'approved'): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Unsuccessful</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($deposit->user_confirm ?? '—'); ?></td>
                    <td>
                        <?php if($deposit->status === 'pending'): ?>
                            <form action="<?php echo e(route('admin.deposits.updateStatus', ['id' => $deposit->id, 'status' => 'approved'])); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-success" onclick="return confirm('Approve this deposit?')">Approve</button>
                            </form>

                            <form action="<?php echo e(route('admin.deposits.updateStatus', ['id' => $deposit->id, 'status' => 'unsuccessful'])); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Mark as unsuccessful?')">Unsuccessful</button>
                            </form>
                        <?php else: ?>
                            <button class="btn btn-sm btn-secondary" disabled>Action Taken</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/deposits/index.blade.php ENDPATH**/ ?>