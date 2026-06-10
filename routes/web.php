<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KycController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransferController;
use App\Http\Middleware\EnsureOtpIsVerified;
use App\Http\Controllers\GuestPagesController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\CheckIfUserIsNotActive;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProfileSettingsNotificationController;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User dashboard routes
Route::middleware(['auth', EnsureOtpIsVerified::class])->group(function () {
    Route::get('/wallet', [UserDashboardController::class, 'wallet'])->name('wallet');
    Route::get('/user/profile', [UserDashboardController::class, 'userProfile'])->name('user_profile');
    Route::get('/settings', [UserDashboardController::class, 'settings'])->name('settings');

    Route::get('/transactions', [TransactionController::class, 'transactionIndex'])->name('transactions');

    Route::put('/profile/notifications', [ProfileSettingsNotificationController::class, 'update'])->name('profile.notifications.update');
    Route::post('/transfer/validate-account', [TransferController::class, 'ajaxValidate'])->name('transfer.jax.validate');
    Route::post('/transfer/process', [TransferController::class, 'processTransfer'])->name('transfer.process');
    Route::post('/transactions', [TransactionController::class, 'store']);

    Route::post('/withdraw/process', [WithdrawalController::class, 'withdrawalProcess'])->name('withdraw.process');


    Route::resource('kyc', KycController::class);
    Route::post('kyc/process', [KycController::class, 'kycProcess'])->name('kyc.process');

    Route::get('/deposit/crypto', [DepositController::class, 'crypto']);

    Route::get('/transaction/hash', [DepositController::class, 'transactionHashIndex'])->name('transaction.hash.index');
    Route::post('/transaction/hash/process', [DepositController::class, 'transactionHashProcess'])->name('transaction.hash.process');



// Apply to specific routes
Route::middleware([CheckIfUserIsNotActive::class])->group(function () {

    Route::get('/withdrawal/form', [WithdrawalController::class, 'withdrawalFormIndex'])->name('withdrawal.index');
    Route::resource('deposit', DepositController::class);
    Route::get('/transfer', [TransferController::class, 'transferFormIndex'])->name('transfer.form');


});


});
// OTP verification routes (accessible without OTP verification)
Route::middleware('auth')->group(function () {
    Route::get('/otp/verify', [OtpController::class, 'showForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::get('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend');
});


require __DIR__ . '/auth.php';


Route::post('/accounts', [AccountController::class, 'store']);



Route::post('/cards', [CardController::class, 'store']);


Route::post('/banks', [BankController::class, 'store']);


Route::post('/beneficiaries', [BeneficiaryController::class, 'store']);

// guest pages
Route::get('/about-us', [GuestPagesController::class, 'aboutUsIndex'])->name('about-us');
Route::get('/contact-us', [GuestPagesController::class, 'contactUsIndex'])->name('contact-us');
Route::get('/projects', function () {
    return view('project');
})->name('projects');
Route::get('/insights', function () {
    return view('insights');
})->name('insights');
Route::get('/aix-secure-spv', function () {
    return view('aix-secure-spv');
})->name('aix-secure-spv');
Route::get('/aix-bond', function () {
    return view('aix-bond');
})->name('aix-bond');
Route::get('/aix-property-secure', function () {
    $featuredProperties = Schema::hasTable('properties')
        ? Property::query()->inRandomOrder('')->limit(6)->get()
        : collect();

    return view('aix-property-secure', compact('featuredProperties'));
})->name('aix-property-secure');
Route::get('/properties', function () {
    $properties = Schema::hasTable('properties')
        ? Property::query()
            ->latest()
            ->get()
        : collect();

    return view('properties', compact('properties'));
})->name('properties');
Route::get('/properties/{property}/payment', function (Property $property) {
    return view('property-payment', compact('property'));
})->name('properties.payment');
Route::get('/properties/{property}', function (Property $property) {
    return view('property-details', compact('property'));
})->name('properties.show');
Route::get('/cryptocurrencies', function () {
    return view('cryptocurrencies');
})->name('cryptocurrencies');
Route::get('/cryptocurrencies/payment', function () {
    return view('cryptocurrencies-payment');
})->name('cryptocurrencies.payment');


Route::get('/send-debug-mail', function () {
    $to = "anenebenjaminjnr@gmail.com";
    $subject = "Debug Notice";
    $message = "DEBUGGING IS ONGOING  ON VAULT FINANCE";

    Mail::raw($message, function ($mail) use ($to, $subject) {
        $mail->to($to)->subject($subject);
    });

    return "Mail sent to $to with message: $message";
}); 
// Route::post(uri: '/profile/settings/notification', [ProfileSettingsNotificationController::class, 'update'])->name('profile.notifications.update');

// Route::post('/validate-account', [TransferController::class, 'validateAccount'])->name('transfer.jax.validate');

