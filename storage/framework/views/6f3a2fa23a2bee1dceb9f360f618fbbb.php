

<?php $__env->startSection('content'); ?>
<br><br><br><br><br>

<section class="section">
    <div class="container">
        <div class="row">
            <!-- Title -->
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                <div class="section__title">
                    <h2>Mining History</h2>
                    <p>Mining History</p>
                </div>
            </div>
            <!-- End Title -->

            <!-- Total Paid Profit Section -->
       <!-- Total Paid Profit Section -->
       <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>
<div class="col-12">
    <div class="deals">
        <div class="deals__text deals__text--buy">
            <!-- Display Total Paid Profit -->
            <?php if(isset($totalPaidProfit) && $totalPaidProfit > 0): ?>
                <strong>Total Paid Profit: $<?php echo e(number_format($totalPaidProfit, 2)); ?></strong>
                <br></div>
                <!-- Withdraw Profit Button -->
               <div class="deals__text align-right">
                <form action="<?php echo e(route('user.withdraw-profit')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="total_paid_profit" value="<?php echo e($totalPaidProfit); ?>">
                    <button type="submit" class="btn btn-primary">Withdraw Profit</button>
                </form>
            <?php else: ?>
                <p>Total Paid Profit: Not Available</p>
            <?php endif; ?>
        </div></div>
    </div>
            <!-- End Total Paid Profit -->

            <!-- Deals Table -->
            <div class="col-12">
                <div class="deals">
                    <div class="deals__table-wrap">

                        <?php if($purchases->isEmpty()): ?>
                            <p class="text-light text-center">No mining purchases yet.</p>
                        <?php else: ?>
                            <table class="deals__table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Crypto</th>
                                        <th>Hashrate (TH/s)</th>
                                        <th>Invested ($)</th>
                                        <th>Duration (days)</th>
                                        <th>Created At</th>
                                        <th>Mining End Date</th>
                                        <th>Status</th>
                                        <th>Expected Profit ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="deals__text deals__text--buy"><?php echo e($loop->iteration); ?></div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy"><?php echo e($purchase->crypto_type); ?></div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy"><?php echo e($purchase->hashrate); ?></div>
                                            </td>
                                           <td class="crypto-convert" data-usd="<?php echo e($purchase->total_price); ?>" data-crypto="<?php echo e(strtolower($purchase->crypto_type)); ?>">
    <span class="converted-value text-warning"></span>
</td>
                                            <td>
                                                <div class="deals__text deals__text--buy"><?php echo e($purchase->duration_days); ?></div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy"><?php echo e($purchase->created_at->format('d M Y')); ?></div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">
                                                    <?php if($purchase->end_date): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($purchase->end_date)->format('d M Y')); ?>

                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="deals__text deals__text--buy">
                                                    <?php if($purchase->end_date && \Carbon\Carbon::parse($purchase->end_date)->isFuture()): ?>
                                                        Running
                                                    <?php else: ?>
                                                     Mining Ended
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                         <td class="crypto-convert" data-usd="<?php echo e($purchase->expected_profit); ?>" data-crypto="<?php echo e(strtolower($purchase->crypto_type)); ?>">
    <?php if($purchase->expected_profit): ?>
        <span class="converted-value text-warning"></span>
    <?php else: ?>
        N/A
    <?php endif; ?>
</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <!-- End Deals Table -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cells = document.querySelectorAll('.crypto-convert');
    const cryptoSet = new Set();

    // Map full CoinGecko ID to Symbol
    const cryptoSymbolMap = {
        bitcoin: 'BTC',
        ethereum: 'ETH',
        tether: 'USDT',
        solana: 'SOL',
        dogecoin: 'DOGE',
        binancecoin: 'BNB',
        litecoin: 'LTC',
        usdc: 'USDC'
        // Add more if needed
    };

    cells.forEach(cell => {
        const crypto = cell.dataset.crypto;
        if (crypto) cryptoSet.add(crypto);
    });

    if (cryptoSet.size === 0) return;

    const cryptoList = Array.from(cryptoSet).join(',');
    const apiUrl = `https://api.coingecko.com/api/v3/simple/price?ids=${cryptoList}&vs_currencies=usd`;

    fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
            cells.forEach(cell => {
                const usd = parseFloat(cell.dataset.usd);
                const crypto = cell.dataset.crypto;

                if (usd > 0 && data[crypto] && data[crypto].usd) {
                    const price = data[crypto].usd;
                    const converted = (usd / price).toFixed(6);
                    const symbol = cryptoSymbolMap[crypto] || crypto.toUpperCase(); // fallback
                    cell.querySelector('.converted-value').textContent = `${converted} ${symbol}`;
                }
            });
        })
        .catch(error => {
            console.error("Error fetching crypto prices:", error);
        });
});
</script>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/ppelfslx/ppelng.online/resources/views/user/mining/history.blade.php ENDPATH**/ ?>