<?php



use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/gifts', [GiftController::class, 'index'])->name('gifts.index');

Route::post('/auth/send-otp', [AuthController::class, 'sendOtp'])->name('auth.send-otp');
Route::post('/auth/verify-otp', [AuthController::class, 'verifyOtp'])->name('auth.verify-otp');
Route::post('/auth/update-profile', [AuthController::class, 'updateProfile'])->name('auth.update-profile');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Coin Store & Payment
Route::get('/coins', [PaymentController::class, 'index'])->name('coins.index');
Route::post('/payment/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
Route::post('/gifts/send', [GiftController::class, 'send'])->name('gifts.send');

Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'show'])->defaults('slug', 'privacy-policy')->name('page.privacy');
Route::get('/terms-of-service', [App\Http\Controllers\PageController::class, 'show'])->defaults('slug', 'terms-of-service')->name('page.terms');
Route::get('/refund-policy', [App\Http\Controllers\PageController::class, 'show'])->defaults('slug', 'refund-policy')->name('page.refund');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\PageController::class, 'submitContact'])->name('contact.submit');

// Admin Routes
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('login'); // Named login for auth middleware redirection
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.login.submit');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\AdminController::class, 'updateSettings'])->name('settings.update');
});

