<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/bai-viet/{slug}', [HomeController::class, 'show'])
    ->name('posts.show');

Route::post('/bai-viet/{slug}/binh-luan', [CommentController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('comments.store');

Route::middleware('guest')->group(function () {
    Route::get('/admin/dang-nhap', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/admin/dang-nhap', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');
});

Route::post('/admin/dang-xuat', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/bai-viet', [AdminPostController::class, 'index'])
            ->name('posts.index');

        Route::get('/bai-viet/tao-moi', [AdminPostController::class, 'create'])
            ->name('posts.create');

        Route::post('/bai-viet', [AdminPostController::class, 'store'])
            ->name('posts.store');

        Route::get('/bai-viet/{post}/sua', [AdminPostController::class, 'edit'])
            ->name('posts.edit');

        Route::put('/bai-viet/{post}', [AdminPostController::class, 'update'])
            ->name('posts.update');

        Route::delete('/bai-viet/{post}', [AdminPostController::class, 'destroy'])
            ->name('posts.destroy');

        Route::get('/binh-luan', [AdminCommentController::class, 'index'])
            ->name('comments.index');

        Route::patch('/binh-luan/{comment}/{status}', [
            AdminCommentController::class,
            'updateStatus',
        ])->name('comments.status');

        Route::delete('/binh-luan/{comment}', [
            AdminCommentController::class,
            'destroy',
        ])->name('comments.destroy');
    });
