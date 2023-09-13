<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingController;
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
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('frontend.pages.home');
});
Route::get('/register', function () {
    return redirect()->route("registerPage");
});

Route::get('/admin/dashboard', function () {
    return view('backend.layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Backend Routes
Route::group(["middleware" => ["auth","admin"], "prefix" => "admin"], function () {
    Route::get("/users",[AdminUserController::class,"index"])->name("userPage");
    Route::get("/user-create",[AdminUserController::class,"create"])->name("adminUserCreate");
    Route::post("/user-create",[AdminUserController::class,"store"])->name("userRegistrationAdmin");
    Route::get("/user-update/{id}",[AdminUserController::class,"edit"])->name("userEditAdmin");
    Route::post("/user-update/{id}",[AdminUserController::class,"update"])->name("userUpdateAdmin");
    Route::post("/user-delete/{id}",[AdminUserController::class,"destroy"])->name("userDeleteAdmin");
});


Route::group(["middleware" => ["auth","subadmin"], "prefix" => "admin"], function () {

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

    // product
    Route::resource("/products", ProductController::class);
    Route::post("/search-products", [ProductController::class, "searchProducts"])->name("searchProducts");
    Route::delete("/delete-product-image/{id?}", [ProductController::class, "deleteImage"])->name("deleteProductImage");
    Route::delete("/delete-product-size/{id?}", [ProductController::class, "deleteSize"])->name("deleteProductSize");
    Route::delete("/delete-product-color/{id?}", [ProductController::class, "deleteColor"])->name("deleteProductColor");

    // order
    Route::get("/orders", [OrderController::class, "index"])->name("orderTable");
    Route::post("/filter-orders", [OrderController::class, "filterOrder"])->name("filterOrder");
    Route::get("/contact-form", [OrderController::class, "contact"])->name("contactFormPage");

    // Site setting
    Route::resource("/site-setting", SiteSettingController::class);
    Route::post("/update-order", [OrderController::class, "updateOrder"])->name("updateOrderAdmin");
    Route::get("/download-order/{id}", [OrderController::class, "downloadBill"])->name("downloadBill");
});

// frontend routes
Route::controller(FrontendController::class)->group(function () {
    Route::post("/search-product", "searchProduct")->name("searchProduct");
    Route::get("/shop", "shop")->name("shop");
    Route::get("/shop/category/{slug}", "productCategory")->name("productCategory");
    Route::get("/shop/sub-category/{slug}", "productSubCategory")->name("productSubCategory");
    Route::get("/shop/brand/{id}", "productBrand")->name("productBrand");
    Route::get("/product/{slug}", "productDetail")->name("productDetailPage");
    Route::get("/contact-us", "contactUs")->name("contactUsPage");
    Route::post("/contact-us", "storeContact")->name("storeContact");

    Route::group(["middleware" => "notAuth"], function () {
        Route::get("/login-page", "loginPage")->name("loginPage");
        Route::post("/login-page", "userLogin")->name("userLogin");
        Route::get("/register-page", "registerPage")->name("registerPage");
        Route::post('/register-page', "userRegistration")->name("userRegistration");
    });
    // auth
    Route::group(["middleware" => "authUser"], function () {
        Route::get("/dashboard/{tab?}", "userDashboard")->name("userDashboard");
        Route::post("/update-profile", "updateProfile")->name("updateProfile");
        Route::post("/add-to-cart", "addToCart")->name("addToCart");
        Route::post("/delete-cart/{id}", "deleteFromCart")->name("deleteFromCart");
        Route::get("/cart", "cartPage")->name("cartPage");
        Route::post("/update-cart/{id}", "updateCart")->name("updateCart");
        Route::get("/checkout", "checkoutPage")->name("checkoutPage");
        Route::post("/checkout", "addOrder")->name("addOrder");
        Route::post("/update/order", "updateOrder")->name("updateOrder");
    });
});

