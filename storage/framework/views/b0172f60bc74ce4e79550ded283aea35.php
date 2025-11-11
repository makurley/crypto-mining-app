

<?php $__env->startSection('content'); ?>


      <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Mining Plans</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
 <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                 <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
    <thead>
        <tr>
            <th>User</th>
            <th>Plan</th>
            <th>Status</th>
            <th>Expected Profit</th>
            <th>Expires At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $userPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $isExpired = \Carbon\Carbon::now()->greaterThan($plan->expires_at);
        ?>
        <tr>
            <td><?php echo e($plan->user->name); ?></td>
            <td><?php echo e($plan->plan->name ?? 'N/A'); ?></td>
            <td>
                <?php if($plan->status === 'active' && !$isExpired): ?>
                    <span class="badge bg-success">Active</span>
                <?php elseif($isExpired): ?>
                    <span class="badge bg-danger">Expired</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Completed</span>
                <?php endif; ?>
            </td>
            <td><?php echo e($plan->expected_profit); ?></td>
            <td><?php echo e($plan->expires_at->format('Y-m-d')); ?></td>
            <td>
                <?php if($plan->status === 'completed'): ?>
                    <span class="badge bg-secondary">Completed</span>
                <?php elseif(!$isExpired): ?>
                    <button class="btn btn-warning btn-sm" disabled>In Progress</button>
                <?php else: ?>
                    <form action="<?php echo e(route('admin.payProfit', $plan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-success btn-sm">Pay Profit</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>



                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/plans/plancontrol.blade.php ENDPATH**/ ?>