<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\User\PlanController;
use App\Http\Controllers\CryptoWalletController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminWalletController;
use App\Http\Controllers\Admin\AdminCryptoWalletController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\MiningController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AdminMiningController;
use App\Http\Controllers\UserMiningController;
use App\Http\Controllers\UserMinerSettingController;
use App\Http\Controllers\PlanProfitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\Admin\AdminKycController;
use App\Http\Controllers\Admin\ReferralSettingsController;
use App\Http\Controllers\ReferralController;
use App\Models\Plan;
use App\Models\BlogPost;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
// Home route
Route::get('/', function () { return view('home');})->name('home');
Route::get('/about', function () { return view('about');})->name('about');
Route::get('/mining-contracts', function () {
    $plans = Plan::all(); 
return view('mining-contracts', compact('plans'));
})->name('mining.contracts');
Route::view('/protocols', 'pages.protocols')->name('protocols');
Route::view('/terms-and-conditions', 'pages.terms&condition')->name('terms');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');

Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/', function () {
    $plans = Plan::all();
    $cryptoRates = []; // maybe fetch real-time later
    $posts = BlogPost::latest()->take(5)->get();

    return view('home', compact('plans', 'cryptoRates', 'posts'));
})->name('home'); 

// ==================== Authentication ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== Password Reset ====================
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// ==================== Email Verification ====================
// Route::middleware(['auth'])->group(function () {
//     Route::view('/email/verify', 'auth.verify')->name('verification.notice');

Route::middleware(['auth'])->group(function () {
    // Display the verification notice if email is not verified
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

// User Dashboard (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
});
Route::get('/wallet', [WalletController::class, 'index'])->middleware('auth')->name('wallet.index');
// Admin login routes
// Admin login routes
Route::get('/admin60', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin60/login', [AdminController::class, 'login'])->name('admin.login.post');

// Admin-protected routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{id}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Admin user management
    Route::post('/users/{id}/toggle-ban', [AdminController::class, 'toggleBan'])->name('admin.users.toggleBan');
    Route::get('/users/{id}/fund', [AdminController::class, 'fundUserWallet'])->name('admin.users.fund');
    
    // Fund wallet for admin
    Route::get('/fund-wallet', [AdminController::class, 'showFundWallet'])->name('admin.fund.wallet');
    Route::post('/fund-wallet', [AdminController::class, 'fundWallet'])->name('admin.fund.wallet.post');
    
    // Admin plan management
    Route::get('/plans', [AdminPlanController::class, 'index'])->name('admin.plans.index');
    Route::get('/plans/create', [AdminPlanController::class, 'create'])->name('admin.plans.create');
    Route::post('/plans/store', [AdminPlanController::class, 'store'])->name('admin.plans.store');
    Route::get('/plans/edit/{plan}', [AdminPlanController::class, 'edit'])->name('admin.plans.edit');
    Route::put('/plans/update/{plan}', [AdminPlanController::class, 'update'])->name('admin.plans.update');
    Route::delete('/admin/plans/{id}', [AdminPlanController::class, 'destroy'])->name('admin.plans.destroy');

    Route::get('/plans/plancontrol', [AdminPlanController::class, 'planControl'])->name('plan.control');
// admin-mining control

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/mining', [AdminMiningController::class, 'index'])->name('admin.mining.index');
    Route::post('/mining/payout/{miningPurchase}', [AdminMiningController::class, 'payout'])->name('admin.mining.payout');
});

});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('pay-profit/{userPlanId}', [AdminPlanController::class, 'payProfit'])->name('payProfit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.list');
    Route::post('/plans/purchase/{plan}', [PlanController::class, 'purchase'])->name('plans.purchase');
    Route::get('/my/plans', [PlanController::class, 'myPlans'])->name('plans.my');

Route::get('/profit-history', [PlanController::class, 'profitHistory'])->name('profits.history');
 Route::get('/plans/purchase-confirmation', function () { return view('user.plans.purchase-confirmation');
    })->name('plans.purchase-confirmation');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('user.profile');
    Route::put('/profile', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware('verified')->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', function () {
        return redirect()->route('verification.notice');
    });
});
Route::get('/dashboard', [DashboardController::class, 'showForm'])->name('user.dashboard');
Route::put('/dashboard/crypto-wallets/update', [DashboardController::class, 'updateCryptoWallets'])->name('user.crypto.wallets.update');
Route::post('/dashboard/update-wallet', [DashboardController::class, 'updateWallet'])->name('user.update.wallet');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('/user/update-password', [\App\Http\Controllers\DashboardController::class, 'updatePassword'])->name('user.update-password');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/crypto-wallets', [AdminWalletController::class, 'index'])->name('cryptowallets.index');
    Route::post('/crypto-wallets', [AdminWalletController::class, 'store'])->name('cryptowallets.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/deposit/create', [DashboardController::class, 'createDeposit'])->name('user.deposit.create');
    Route::post('/dashboard/deposit/store', [DashboardController::class, 'storeDeposit'])->name('user.deposit.store');
   Route::get('/user/deposit/history', [DepositController::class, 'history'])->name('user.deposit.history');
 Route::get('/user/deposit/history', [DepositController::class, 'history'])->name('user.deposit.history');

});
// Admin Deposit
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');
    Route::post('/deposits/{id}/approve', [AdminDepositController::class, 'approve'])->name('deposits.approve');
    Route::post('/deposits/{id}/fail', [AdminDepositController::class, 'fail'])->name('deposits.fail');
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');
    Route::post('/deposits/{id}/status/{status}', [AdminDepositController::class, 'updateStatus'])->name('deposits.updateStatus');
    Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('withdrawals.index');
  Route::get('/deposits', [AdminController::class, 'deposits'])->name('deposits.index');
});
Route::get('/user/deposit/confirmation/{id}', [DepositController::class, 'confirmation'])->name('user.deposit.confirmation');
Route::post('/user/deposit/confirmation/{id}', [DepositController::class, 'confirm'])->name('user.deposit.confirm');


Route::middleware(['auth'])->group(function () {
    Route::get('/withdraw', [WithdrawalController::class, 'showForm'])->name('user.withdraw.form');
    Route::post('/withdraw/store', [WithdrawalController::class, 'store'])->name('user.withdraw.store');
    Route::get('/withdraw/confirmation/{id}', [WithdrawalController::class, 'confirmation'])->name('user.withdraw.confirmation');
    Route::post('/withdrawals/{id}/approve', [AdminController::class, 'approveWithdrawal'])->name('admin.withdrawals.approve');
    Route::get('/withdrawals/history', [\App\Http\Controllers\WithdrawalController::class, 'history'])->name('user.withdraw.history');
});

Route::middleware(['auth'])->group(function () {
Route::get('/mining/purchase', [MiningController::class, 'create'])->name('mining.create');
Route::post('/mining/purchase', [MiningController::class, 'store'])->name('mining.store');
Route::get('/api/crypto-prices', [MiningController::class, 'getLivePrices']);
Route::get('/mining/purchase/confirm', function () {
    return view('user.mining.purchaseconfirm');
})->name('mining.purchase.confirm');
Route::get('/mining/history', [MiningController::class, 'miningHistory'])->name('mining.history');

// Route to view mining history
Route::get('/mining-history', [UserMiningController::class, 'index'])->name('user.mining.index');
Route::post('/withdraw-profit', [UserMiningController::class, 'withdrawProfit'])->name('user.withdraw-profit');
Route::get('/user/server-status', [UserMiningController::class, 'checkServerStatus']);
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
});

Route::get('/upload-logo', function () {
    return view('upload-logo');
});

Route::post('/upload-logo', [LogoController::class, 'uploadLogo'])->name('upload.logo');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('miner-data', [App\Http\Controllers\Admin\MinerDataController::class, 'index'])->name('admin.miner-data.index');
    Route::get('miner-data/create', [App\Http\Controllers\Admin\MinerDataController::class, 'create'])->name('admin.miner-data.create');
    Route::post('miner-data/store', [App\Http\Controllers\Admin\MinerDataController::class, 'store'])->name('admin.miner-data.store');
    
    Route::get('miner-data/{id}/edit', [App\Http\Controllers\Admin\MinerDataController::class, 'edit'])->name('admin.miner-data.edit');

    Route::post('miner-data/{id}/update', [App\Http\Controllers\Admin\MinerDataController::class, 'update'])->name('admin.miner-data.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('miner-settings', [UserMinerSettingController::class, 'showMinerSettings'])->name('user.miner.settings');
    Route::post('miner-settings', [UserMinerSettingController::class, 'saveMinerSettings'])->name('user.miner.settings.save');
    Route::get('miner-settings/ip', [UserMinerSettingController::class, 'getMinerIpByLocation'])->name('user.miner.ip');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/user/withdraw-profit', [App\Http\Controllers\PlanProfitController::class, 'withdrawProfit'])->name('user.withdrawProfit');
    Route::get('/user/profit-ledger', [PlanProfitController::class, 'showProfitLedger'])->name('user.profitLedger');
Route::get('/referral-history', [ReferralController::class, 'history'])->name('referral.history');
Route::post('/referral/withdraw', [ReferralController::class, 'withdrawBonus'])->name('referral.withdraw');
});
// User
Route::get('/kyc', [KycController::class, 'form'])->middleware('auth')->name('user.kyc.form');
Route::post('/kyc', [KycController::class, 'submit'])->middleware('auth')->name('user.kyc.submit');

// Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/kyc', [AdminKycController::class, 'index'])->name('kyc.index');
    Route::post('/kyc/{id}/approve', [AdminKycController::class, 'approve'])->name('kyc.approve');
    Route::post('/kyc/{id}/reject', [AdminKycController::class, 'reject'])->name('kyc.reject');
   Route::get('/kyc-document/{filename}', [KycController::class, 'viewDocument'])->name('kyc.document.view');

});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/referral-settings', [ReferralSettingsController::class, 'edit'])->name('admin.referral-settings.edit');
    Route::put('/referral-settings', [ReferralSettingsController::class, 'update'])->name('admin.referral-settings.update');
});

Route::prefix('admin/blogs')->middleware('auth')->group(function () {
  Route::get('admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/{id}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
    Route::get('/admin/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
     Route::resource('blogs', AdminBlogController::class);

});
// Disable the /admin route (so it can't be accessed directly)
Route::get('/admin', function () {
    abort(404);
});




