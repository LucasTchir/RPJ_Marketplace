<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecommendedController;
use App\Http\Controllers\NotificationController;

// Domovska stranka
Route::get("/", [ListingController::class, "index"]);
Route::get('/home/search', [ListingController::class, 'show_search']);
// Prihlasenie 
Route::get("/login", [UserController::class, "login"])->name("login")->middleware("guest");
Route::post("/users/authenticate", [UserController::class, "authenticate"]);
// Registracia
Route::get("/register", [UserController::class, "create"])->name("register")->middleware("guest");
Route::post("/users", [UserController::class, "store"]);
// Vytvorenie inzeratu
Route::get("/create", [ListingController::class, "create"])->middleware("auth");
Route::post("/home", [ListingController::class, "store"]);
// Upravenie usera a inzeratu a sprava inzeratov
Route::get("/profile/edit/{user}", [UserController::class, "edit"])->middleware("auth");
Route::put("/profile/{user}", [UserController::class, "update"])->middleware("auth");
Route::get("/profile/manage", [ListingController::class, "manage"])->middleware("auth");
Route::delete("/profile/delete/{listing}", [ListingController::class, "destroy"])->middleware("auth");
Route::put("/listing/manage/edit/{listing}", [ListingController::class, "update"])->middleware("auth");
Route::get("/listing/edit/{listing}", [ListingController::class, "edit"])->middleware("auth");
Route::delete('/delete/profile/{id}', [UserController::class, 'destroy'])->middleware("auth");
// Odhlasenie
Route::post("/logout", [UserController::class, "logout"])->middleware("auth");
// Zobrazenie usera
Route::get("/users/{username}", [UserController::class, "show"]);
// Zobrazenie inzeratu
Route::get("/listings/{id}", [ListingController::class, "show"]);
// Admin panel
Route::get("/dashboard", [DashboardController::class, "show"])->middleware(IsAdmin::class);
Route::get("/dashboard/listings", [DashboardController::class, "show_listings"])->middleware(IsAdmin::class);
Route::get("/dashboard/users", [DashboardController::class, "show_users"])->middleware(IsAdmin::class);
Route::get("/dashboard/categories", [DashboardController::class, "show_categories"])->middleware(IsAdmin::class);
Route::put("/dashboard/profile/{user}", [DashboardController::class, "update"])->middleware("auth");
Route::delete("/dashboard/delete/listings/{listing}", [DashboardController::class, "destroy_listing"])->middleware(IsAdmin::class);
Route::get("/dashboard/edit/listing/{listing}", [DashboardController::class, "edit_listing"])->middleware(IsAdmin::class); 
Route::get("/dashboard/edit/profile/{user}", [DashboardController::class, "edit_user"])->middleware(IsAdmin::class); 
Route::delete("/dashboard/delete/users/{user}", [DashboardController::class, "destroy_user"])->middleware(IsAdmin::class);
Route::delete("/dashboard/delete/categories/{category}", [DashboardController::class, "destroy_category"])->middleware(IsAdmin::class);
// Kategorie 
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get("/category/create/new", [CategoryController::class, "create"])->middleware(IsAdmin::class);
Route::post("/category/new", [CategoryController::class, "store"])->middleware(IsAdmin::class);
// Predajcovia
Route::get("/home/sellers", [ListingController::class, "showSellers"]);
// Sledovanie uzivatela
Route::post('/follow/{user}', [FollowController::class, 'follow'])->middleware("auth");
Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->middleware("auth");
// Upozornenia a spravy
Route::get("/home/notifications", [NotificationController::class, "show"])->middleware("auth");
Route::delete('/notification/delete/{notification}', [NotificationController::class, 'destroy'])->middleware("auth");
Route::delete('/message/delete/{message}', [NotificationController::class, 'destroy_message'])->middleware("auth");
// Odporucane
Route::post('/recommend/{category_id}', [RecommendedController::class, 'recommend'])->middleware("auth");
Route::get('/setup/{user}', [RecommendedController::class, 'show'])->middleware("auth");
Route::post('/setup/store/{user}', [RecommendedController::class, 'store'])->middleware("auth");
Route::get('/interest/{listing}', [NotificationController::class, 'interest'])->middleware('auth');
// Hodnotenie
Route::post('/rate', [RatingController::class, 'store'])->middleware("auth");
// Zmena hesla
Route::get('/change-password', [UserController::class, 'changePassword'])->middleware("auth");
Route::post('/change-password-save', [UserController::class, 'changePasswordSave'])->middleware("auth");
// Nahlásenie
Route::get('/listing/report/{id}', [NotificationController::class, 'report'])->middleware("auth");

Route::post('/categories/update-selection', [RecommendedController::class, 'updateSelection'])
    ->name('categories.updateSelection')
    ->middleware('auth');
