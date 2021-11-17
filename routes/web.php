<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\OrderController as UserOrderController;
//use App\Http\Controllers\ReportController;
//use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Auth::routes();
Route::middleware('auth')->group( function(){
    // Admin
    Route::group(['middleware' => 'admin'], function (){
        Route::get('/admin/order', [AdminOrderController::class, 'index'])->name('admin.order.index');
        Route::get('/admin/order/approve/{order}', [AdminOrderController::class, 'approveOrder'])->name('admin.order.change.approved');
        Route::get('/admin/order/edit/{order}', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
        Route::put('/admin/order/update/{order}', [AdminOrderController::class, 'update'])->name('admin.order.update');
    });
    // User
    Route::resource('/order', OrderController::class)->only([
        'store',
        'create',
        'update',
        'edit',
        'destroy'
    ]);    
    Route::get('/user/order', [UserOrderController::class, 'index'])->name('user.order');
    // User Settings
    Route::get('user/setting',[ UserSettingController::class, 'index'])->name('user.setting.index');
    Route::post('user/setting/password/update', [ UserSettingController::class, 'updatePassword'])->name('user.password.update');
    Route::post('user/setting/email/update', [ UserSettingController::class, 'updateEmail'])->name('user.email.update');
    // Reports
    Route::get('/report/index', [ReportController::class, 'index'])->name('report.index');
    Route::post('/report/store/{order}', [ReportController::class, 'store'])->name('report.store');
    Route::get('/report/show/{report}', [ReportController::class, 'show'])->name('report.show');
    // Message Ticket System
    Route::post('/report/message/store/{report}', [ReportController::class ,'reportMessageStore'])->name('report.message.store');
    // Review
//    Route::post('/review/store/{book}', [ReviewController::class, 'store'])->name('review.store');
//    Route::post('/review/index/{book}', [ReviewController::class, 'index'])->name('review.index');

});
// Guest
Route::resource('/order', OrderController::class)->only([
    'index',
    'show'
]);
// Root
Route::get('/', function(){
    return redirect()->route('order.index');
});
