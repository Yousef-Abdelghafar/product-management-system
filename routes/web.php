<?php

use Illuminate\Support\Facades\Route;
// 1. غيرنا دي عشان تشاور على الكنترولر الجديد
use App\Http\Controllers\ProductController;

// 2. ضفنا السطر ده عشان أول ما تفتح الموقع يروح لصفحة المنتجات
Route::get('/', function () {
    return redirect('products');
});

// 3. غيرنا دي عشان تبقى بتاعة المنتجات
Route::resource('products', ProductController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
