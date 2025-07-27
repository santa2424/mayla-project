<?php

use App\Http\Controllers\Admin\ContactMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CheckoutController;

use App\Http\Middleware\LanguageMiddleware;


use App\Http\Controllers\PurchaseController;

Route::get('/', [GalleryController::class, 'home'])->name('home');

// صفحة التواصل
Route::get('/contact', function () {
 return view('Pages.contact');
})->name('contact');

// تغيير اللغة (للمستخدم العام)
Route::middleware([LanguageMiddleware::class])->group(function () {
    Route::post('/switch-language', [LanguageController::class, 'switchLanguage'])->name('switch.language');
});

// عرض المنتجات
Route::get('/products', [GalleryController::class, 'index'])->name('products');

// بحث عن منتج
Route::get('/products/search', [GalleryController::class, 'search'])->name('search');


// تفاصيل منتج
Route::get('/products/{product}', [GalleryController::class, 'show'])->name('products.detailes');

// تقييم منتج
Route::post('/products/{product}/rate', [ProductController::class, 'rate'])->name('product.rate');

/*
|--------------------------------------------------------------------------
| cart
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->group(function () {
    Route::post('/', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/remove-one/{product}', [CartController::class, 'removeOne'])->name('cart.remove_one');
    Route::post('/remove-all/{product}', [CartController::class, 'removeAll'])->name('cart.remove_all');
Route::post('/purchase-selected', [CartController::class, 'purchaseSelected'])->name('cart.purchaseSelected');

});



/*
|--------------------------------------------------------------------------
| 🔔 الإشعارات (للمستخدم المسجل)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});

/*
|--------------------------------------------------------------------------
| dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // لوحة التحكم
    Route::get('/dashboard', function () {
        return view('themes.content');
    })->name('dashboard');

    // تغيير اللغة داخل لوحة التحكم
    

    // التقارير
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
   

    // إدارة الخصومات
    Route::get('/discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
    Route::post('/discounts/store', [DiscountController::class, 'store'])->name('discounts.store');

     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
     Route::resource('products', ProductController::class);
      Route::resource('categories', CategoryController::class);
      Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
      Route::get('/send-notification', [AdminController::class, 'showNotificationForm'])->name('notification.form');
      Route::post('/send-notification', [AdminController::class, 'sendPromotionalNotification'])->name('notification.send');

       Route::put('/orders/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirmPayment');
       Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

});
// routes/web.php
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');




Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');





// credit card
Route::get('/checkout', [PurchaseController::class, 'creditCheckout'])->name('credit.checkout');
Route::post('/checkout', [PurchaseController::class, 'purchase'])->name('products.purchase');
Route::post('/checkout/cash', [PurchaseController::class, 'cashCheckout'])->name('cash.checkout');




