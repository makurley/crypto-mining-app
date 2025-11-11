
<?php $__env->startSection('title', 'Kyc'); ?>
<?php $__env->startSection('content'); ?>


       


 <div class="body-header border-bottom d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <!-- Pretitle -->
                            <h1 class="h4 mt-1">KYC Management</h1>
                        </div>
                        <div class="col-12 col-md-6 text-md-end">
                            <a href="#" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                            <button type="button" class="btn btn-dark lift">Generate Report</button>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card no-bg">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0 align-items-center">
                                    <p class="mb-0 fw-bold ">SUBMITED KYC DATA</p> 
                                </div>
                                
    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
                                <div class="card-body">
                                    
                                    <table id="myProjectTable" class="priceTable table table-hover custom-table table-bordered align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                    <th>Document Type</th>
                    <th>Status</th>
                    <th>Document</th>
                    <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $kycUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($user->name); ?><br><small><?php echo e($user->email); ?></small></td>
                        <td><?php echo e(str_replace('_', ' ', $user->kyc_document_type)); ?></td>
                        <td>
                            <?php if($user->kyc_status == 'approved'): ?>
                                <span class="text-green-600 font-semibold">Approved</span>
                            <?php elseif($user->kyc_status == 'pending'): ?>
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            <?php else: ?>
                                <span class="text-red-600 font-semibold">Rejected</span><br>
                                <small><?php echo e($user->kyc_rejection_reason); ?></small>
                            <?php endif; ?>
                        </td>
                       <td>
 <a href="<?php echo e(route('admin.kyc.document.view', basename($user->kyc_document))); ?>" target="_blank" class="text-blue-600 underline"> <button class="btn btn-light-danger">View Document</button></a>



</td>

                       <td>
                            <?php if($user->kyc_status !== 'approved'): ?>
                                <form action="<?php echo e(route('admin.kyc.approve', $user->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-light-success">Approve</button>
                                </form>

                                <!-- Reject button with prompt -->
                                <form action="<?php echo e(route('admin.kyc.reject', $user->id)); ?>" method="POST" class="inline" onsubmit="return confirmReject(this)">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="reason">
                                    <button type="submit" class="btn btn-light-danger">Reject</button>
                                </form>
                            <?php else: ?>
                                <span class="text-sm text-gray-500">No actions</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">No KYC submissions yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        


<script>
function confirmReject(form) {
    const reason = prompt("Enter reason for rejection:");
    if (reason === null || reason.trim() === "") {
        return false;
    }
    form.querySelector('input[name="reason"]').value = reason;
    return true;
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/admin/kyc/index.blade.php ENDPATH**/ ?>