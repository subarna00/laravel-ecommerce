<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Backend Routes
Route::group(["middleware" => "auth", "prefix" => "admin"], function () {
    // banner
    Route::resource("/banner", BannerController::class);
    Route::post("/search-banner", [BannerController::class, "searchBanner"])->name("searchBanner");

    // brand
    Route::resource("/brands", BrandController::class);
    Route::post("/search-brand", [BrandController::class, "searchBrand"])->name("searchBrand");

    // partners
    Route::resource("/partners", PartnerController::class);
    Route::post("/search-partner", [PartnerController::class, "searchPartner"])->name("searchPartner");

    // ads
    Route::resource("/ads", AdController::class);
    Route::post("/search-ads", [AdController::class, "searchAds"])->name("searchAds");

    // category
    Route::resource("/categories", CategoryController::class);
    Route::post("/search-category", [CategoryController::class, "searchCategory"])->name("searchCategory");

    // sub category
    Route::resource("/sub-categories", SubCategoryController::class);
    Route::post("/search-sub-categories", [SubCategoryController::class, "searchSubCategories"])->name("searchSubCategories");
});
require __DIR__ . '/auth.php';
