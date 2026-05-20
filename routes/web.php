<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\CreateClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Middleware\checkFreeLimit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/auth/redirect/google', function(){
    //use with() to request a refresh token for offline access later
    return Socialite::driver('google')->with(['access_type' =>'offline', 'prompt' => 'consent'])->redirect();
});

Route::get('/auth/callback/google', function(){
    // google related info must be explicitly stored because it is not defined in fillable. 
    //This is to avoid mass-assignment vulnerability.
    $google_user = Socialite::driver('google')->user();

    $user = User::firstorNew(['email' => $google_user->getEmail()]);
    $user->signup_method = 'google';
    $user->name = $google_user->getName();
    $user->google_id = $google_user->getId();
    $user->google_token = $google_user->token;

    $user->google_refresh_token = $google_user->refreshToken;
    $user->google_avatar= $google_user->getAvatar();

    $user->save();

    Auth::login($user);

    return redirect()->intended('/dashboard');
});

Route::get('/invoices/{invoice}/pdf-view', [InvoiceController::class, 'pdfView'])
    ->name('invoices.pdf.view')
    ->middleware('signed'); 
//end

Route::middleware(['auth'])->group(function(){
    Route::get('/invoices/invoice-{invoice}/pdf', [invoiceController::class, 'downloadInvoicePdf'])->name('invoices.pdf');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'fetchDashboardStats'])->name('pages.dashboard');

    Route::get('/clients', [CreateClientController::class, 'fetchClients']);

    Route::get('/invoices', [invoiceController::class, 'fetchInvoices'])->name('invoices.index');

    Route::get('/invoices/show-invoice-{invoice}', [invoiceController::class, 'show'])->name('invoices.show');

    Route::get('/invoices/create', [invoiceController::class, 'getClientsAndBusinesses'])->name('invoices.create.get')->middleware(checkFreeLimit::class);
    
    Route::get('/business-profile-settings', [BusinessProfileController::class, 'loadPage'])->middleware(checkFreeLimit::class);

    Route::get('/business-profile', [BusinessProfileController::class, 'showBusinessProfile']);

    Route::get('/billing/upgrade', [BillingController::class, 'loadBillingPage'])->name('billing.upgrade');

    Route::get('/subscriptions', [SubscriptionsController::class, 'loadSubscriptionsPage'])->name('pages.subscriptions');
});


Route::middleware(['auth', 'verified'])->group(function() {
    Route::post('/business/create-business-profile', [BusinessProfileController::class, 'createBusiness']);

    Route::post('/client/create-client', [CreateClientController::class, 'createClient'])->middleware(checkFreeLimit::class);

    Route::post('/invoices/create', [invoiceController::class, 'createInvoice'])->name('invoices.create.post');

    Route::patch('/invoices/update-invoice-{invoice}', [invoiceController::class, 'updateInvoice'])->name('invoices.update');

});

Route::prefix('payments')->name('payments.')->group(function(){
    Route::post('/initialize', [BillingController::class, 'initializePayment'])->name('initialize');
    Route::get('/callback', [BillingController::class, 'callBack'])->name('callback');

    Route::get('/success', [BillingController::class, 'success'])->name('success');
    Route::get('/failed', [BillingController::class, 'failed'])->name('failed');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
