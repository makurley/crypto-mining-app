

<?php $__env->startSection('content'); ?>


      <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Withdraw management</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    
                     <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
 <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                           <tr>
                <th>User</th>
                <th>Wallet Type</th>
                <th>Wallet Address</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Action</th>
            </tr>
                                        </thead>
                                        <tbody>
                                               <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($withdrawal->user->name ?? 'N/A'); ?></td>
                <td><?php echo e($withdrawal->wallet_type); ?></td>
                <td><?php echo e($withdrawal->wallet_address); ?></td>
                <td>$<?php echo e(number_format($withdrawal->amount, 2)); ?></td>
                <td><?php echo e(ucfirst($withdrawal->status)); ?></td>
                <td><?php echo e($withdrawal->created_at->format('d M Y h:i A')); ?></td>
                <td>
                    <?php if($withdrawal->status === 'pending'): ?>
                        <form action="<?php echo e(route('admin.withdrawals.approve', $withdrawal->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-success btn-sm" type="submit">Approve</button>
                        </form>
                    <?php else: ?>
                        <span class="badge bg-success">Approved</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7">No withdrawals found.</td></tr>
        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/withdrawals/index.blade.php ENDPATH**/ ?>