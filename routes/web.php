<?php

use App\Http\Controllers\KSummaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\KApplicationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ChiefController;
use App\Http\Controllers\PurchaseController;
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
// Route::get('/users/create', [UserController::class, 'create']);
// Route::post('/users', [UserController::class, 'store']);
Route::get('/', function(){
    return redirect('/dashboard');
});
Route::middleware(['auth.check'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('kapplications', KApplicationController::class);
    Route::resource('chiefs', ChiefController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('ksummaries', KSummaryController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoicespdf/{id}', [InvoiceController::class, 'makePDF']);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('ingredients', IngredientController::class);
    Route::resource('users', UserController::class);
    Route::get('company/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::post('company/update', [SettingController::class, 'update'])->name('setting.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/aapplications', [ApplicationController::class, 'aa_index'])->name('applications.aa_index');
    Route::get('/aapplications/{id}/edit', [ApplicationController::class, 'aa_edit']);
    Route::put('/aapplications/{id}', [ApplicationController::class, 'aa_update']);
    Route::get('/aapplications/{id}', [ApplicationController::class, 'aa_show']);
    Route::get('/applications-table', [ApplicationController::class, 'table'])->name('applications.table');
    Route::get('/ksummaries-table', [KSummaryController::class, 'table'])->name('ksummaries.table');
    Route::get('/ingredients-table', [IngredientController::class, 'table'])->name('ingredients.table');
    Route::get('/dashboard', function(){
        return view('dashboard');
    });
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);

// Route::prefix('admin')->group(function () {

// });