<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainAdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
|
| Name all route in dash-case (kebab-case) for example:
| Route::get('/forgot-password', function () {
|  return view('auth.forgot-password');
| })->middleware('guest')->name('password.request'); */


// Route::get('/', function () {
//     return view('layouts.admin-dashboard.product-table');
// });

Route::get('/', [MainAdminController::class, 'getHome'])->name('home');
Route::get('/customers', [MainAdminController::class, 'getCustomers'])->name('customers');
Route::get('/admin-profile', [MainAdminController::class, 'getAdminProfile'])->name('admin.profile');

Route::get('/orders', [MainAdminController::class, 'getOrders'])->name('orders');
Route::get('/message', [MainAdminController::class, 'getMessage'])->name('message');


Route::get('/category', [MainAdminController::class, 'getCategory'])->name('category');
Route::post('/add-cat', [MainAdminController::class, 'addCat'])->name('add.cat');
Route::post('/edit-category', [MainAdminController::class, 'editCategoryByAjax']);
Route::post('/delete-category-by-id', [MainAdminController::class, 'deleteCategoryById']);

Route::get('/size-table', [MainAdminController::class, 'getSizeTable'])->name('size.table');
Route::post('/edit-size', [MainAdminController::class, 'editSize'])->name('edit.size');
Route::post('/save-size', [MainAdminController::class, 'saveSize'])->name('save.size');
Route::get('/size-delete/{id}', [MainAdminController::class, 'sizeDeleteById'])->name('size.delete');

Route::get('/product', [MainAdminController::class, 'getProduct'])->name('product');
Route::get('/add-product-page', [MainAdminController::class, 'addNewProductPage'])->name('add.product.page');
Route::post('/add-product', [MainAdminController::class, 'addProduct'])->name('add.product');
Route::get('/edit-product-page/{id}', [MainAdminController::class, 'showEditProductById'])->name('edit.product.page');
Route::post('/send-edit-product/{id}', [MainAdminController::class, 'sendEditProduct'])->name('send.edit.product');
Route::get('/product-delete/{id}', [MainAdminController::class, 'productDelete'])->name('product.delete');

Route::get('/discount', [MainAdminController::class, 'getDiscountTable'])->name('discount');
Route::get('/add-discount-page', [MainAdminController::class, 'addNewDiscountPage'])->name('add.discount.page');
Route::post('/add-discount', [MainAdminController::class, 'addNewDiscount'])->name('add.discount');
Route::get('/edit-discount-page/{id}', [MainAdminController::class, 'editDiscountPage'])->name('edit.discount.page');
Route::post('/update-discount/{id}', [MainAdminController::class, 'updateDiscount'])->name('update.discount');
Route::get('/delete-discount/{id}', [MainAdminController::class, 'discountDelete'])->name('delete.discount');

Route::get('/image/upload', [MainAdminController::class, 'showUploadForm'])->name('image.upload');
Route::post('/image/upload', [MainAdminController::class, 'upload'])->name('image.upload.post');
Route::get('/image-delete/{id}/{productId}', [MainAdminController::class, 'imageDeleteById'])->name('image.delete.by.id');

////////////////////////////////////Frontend routes///////////////////////////////////////////////










// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/mc', [MainAdminController::class, 'ifregistered']);


    
});

require __DIR__ . '/auth.php';
