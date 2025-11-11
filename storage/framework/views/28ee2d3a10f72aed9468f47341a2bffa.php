

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
        <th>Plan</th>
        <th>Hashrate</th>
        <th>Price</th>
        <th>Duration</th>
        <th>ROI Type</th>
        <th>Badge</th>
        <th>Expected Profit</th> <!-- New column for Expected Profit -->
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($plan->name); ?></td>
        <td><?php echo e($plan->hashrate); ?></td>
        <td>$<?php echo e(number_format($plan->price, 2)); ?></td>
        <td><?php echo e($plan->duration); ?> days</td>
        <td><?php echo e(ucfirst($plan->roi_type)); ?></td>
        <td><span class="badge bg-success"><?php echo e($plan->badge ?? 'N/A'); ?></span></td>

        <!-- Calculate Expected Profit -->
          <td>$<?php echo e(number_format($plan->expected_profit, 2)); ?></td>

        <td>
            <a href="<?php echo e(route('admin.plans.edit', $plan->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
          <form action="<?php echo e(route('admin.plans.destroy', $plan->id)); ?>" method="POST" style="display:inline;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
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

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/plans/index.blade.php ENDPATH**/ ?>