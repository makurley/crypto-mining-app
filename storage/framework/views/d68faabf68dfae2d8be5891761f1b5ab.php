

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
     <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php elseif(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Miners</h6> 
                                </div>
                                <div class="card-body">
                                  <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Crypto Type</th>
                                        <th>Hashrate (TH/s)</th>
                                        <th>Total Price ($)</th>
                                        <th>Duration (days)</th>
                                        <th>Mining End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $miningPurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($purchase->user->username); ?></td>
                                            <td><?php echo e($purchase->crypto_type); ?></td>
                                            <td><?php echo e($purchase->hashrate); ?> TH/s</td>
                                            <td>$<?php echo e(number_format($purchase->total_price, 2)); ?></td>
                                            <td><?php echo e($purchase->duration_days); ?> days</td>
                                            <td><?php echo e(\Carbon\Carbon::parse($purchase->end_date)->format('d M Y')); ?></td>
                                            <td>
                                                <?php if($purchase->end_date <= now()): ?>
                                                    <span class="status pending">Expired</span>
                                                <?php else: ?>
                                                    <span class="status running">Running</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($purchase->end_date <= now()): ?>
                                                    <form action="<?php echo e(route('admin.mining.payout', $purchase)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-success">Payout</button>
                                                    </form>
                                                <?php else: ?>
                                                    <button class="btn btn-secondary" disabled>Running</button>
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

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/mining/index.blade.php ENDPATH**/ ?>