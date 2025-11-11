


<?php $__env->startSection('content'); ?>


      <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Users</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
 <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">User Table</h6> 
                                </div>
                                 <!-- Success Notification -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

                           <div class="card-body">
    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Wallet (₦)</th>
                <th>Status</th>
                <th>User Online</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($user->name ?? 'N/A'); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>₦<?php echo e(number_format($user->wallet, 2)); ?></td>
                    <td>
                        <?php if($user->is_banned): ?>
                            <span class="badge bg-danger">Banned</span>
                        <?php else: ?>
                            <span class="badge bg-success">Active</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($user->online === 'online'): ?>
                            <span class="badge bg-success">Online</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Offline</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Toggle Ban Form -->
                        <form method="POST" action="<?php echo e(route('admin.users.toggleBan', $user->id)); ?>" style="display:inline-block">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-sm btn-warning">
                                <?php echo e($user->is_banned ? 'Unban' : 'Ban'); ?>

                            </button>
                        </form>

                        <!-- Fund Wallet Button -->
                        <a href="<?php echo e(route('admin.fund.wallet')); ?>?user_id=<?php echo e($user->id); ?>" class="btn btn-sm btn-info">Fund Wallet</a>

                        <!-- Delete User Form -->
                        <form method="POST" action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

                            </div>
                        </div>
                    </div><!-- Row end  -->
                    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/users/index.blade.php ENDPATH**/ ?>