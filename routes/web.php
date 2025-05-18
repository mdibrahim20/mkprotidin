<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\PrivacyPolicyController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

    // Article Management (Automatically uses `admin.articles.index`, `admin.articles.create`, etc.)
    Route::resource('articles', ArticleController::class);
    // Pending articles list
    Route::get('articles-pending', [ArticleController::class, 'pending'])->name('articles.pending');
    
    // Approve & Deactivate Articles
    Route::put('articles/{id}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::put('articles/{id}/deactivate', [ArticleController::class, 'deactivate'])->name('articles.deactivate');
    Route::get('articles/{id}/json', [ArticleController::class, 'getArticle'])->name('admin.articles.get');
    Route::put('articles/{id}/toggle-status', [ArticleController::class, 'toggleStatus'])
    ->name('articles.toggleStatus');
    Route::put('users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('users.toggleStatus');




    

    // Category Management (Automatically uses `admin.categories.index`, `admin.categories.create`, etc.)
    Route::resource('categories', CategoryController::class);

    Route::resource('gallery', GalleryController::class);

    Route::resource('video-gallery', VideoGalleryController::class);


    Route::middleware(['can:admin'])->group(function () {
        Route::resource('users', AdminController::class);
    });

});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/seo', [SEOController::class, 'index'])->name('admin.seo.index');
    Route::post('/seo/update', [SEOController::class, 'update'])->name('admin.seo.update');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/ads', AdController::class)->names([
        'index' => 'admin.ads.index',
        'create' => 'admin.ads.create',
        'store' => 'admin.ads.store',
        'edit' => 'admin.ads.edit',
        'update' => 'admin.ads.update',
        'destroy' => 'admin.ads.destroy',
    ]);
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::post('/comments/{id}/approve', [CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [HomeController::class, 'show'])->name('category.show');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/search', [ArticleController::class, 'search'])->name('search');
Route::post('/article/{id}/comment', [CommentController::class, 'store'])->name('article.comment.store');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.page');
Route::get('/archive', [ArticleController::class, 'archive'])->name('article.archive');
// Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('video.gallery');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy.policy');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});