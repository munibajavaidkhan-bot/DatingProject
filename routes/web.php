<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\MatchesController;
use App\Http\Controllers\Member\ChatController;
use App\Http\Controllers\Member\QuizController;
use App\Http\Controllers\Member\ForumController;
use App\Http\Controllers\Member\BlogController;
use App\Http\Controllers\Member\PlanController;
use App\Http\Controllers\Member\ContentController;
use App\Http\Controllers\Member\NotificationController;
use App\Http\Controllers\Member\LikeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;

// ── Public Routes ─────────────────────────────────────────────
Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/terms', fn() => view('terms'))->name('terms');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');

// ── Authenticated Routes ───────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    // ── Profile ───────────────────────────────────────────────
    Route::get('/complete-profile', [CompleteProfileController::class, 'show'])
         ->name('profile.complete');
    Route::post('/complete-profile', [CompleteProfileController::class, 'store'])
         ->name('profile.complete.store');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])
         ->name('profile.photo');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])
         ->name('profile.show');

    // ── Member Routes ─────────────────────────────────────────
    Route::prefix('member')->name('member.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
             ->name('dashboard');

        // ── Discover / Swipe ──────────────────────────────────
        Route::get('/discover', [LikeController::class, 'index'])
             ->name('discover');
        Route::post('/like/{userId}', [LikeController::class, 'like'])
             ->name('like');
        Route::post('/pass/{userId}', [LikeController::class, 'pass'])
             ->name('pass');
        Route::get('/liked-me', [LikeController::class, 'likedMe'])
             ->name('likedMe');

        // ── Matches ───────────────────────────────────────────
        Route::get('/matches', [MatchesController::class, 'index'])
             ->name('matches');
        Route::post('/matches/{id}/accept', [MatchesController::class, 'accept'])
             ->name('matches.accept');
        Route::post('/matches/{id}/reject', [MatchesController::class, 'reject'])
             ->name('matches.reject');
        Route::get('/matches/{id}/profile', [MatchesController::class, 'viewProfile'])
             ->name('matches.profile');

        // ── Chat ──────────────────────────────────────────────
        Route::get('/chat', [ChatController::class, 'index'])
             ->name('chat');
        Route::get('/chat/{matchId}', [ChatController::class, 'show'])
             ->name('chat.show');
        Route::post('/chat/{matchId}/send', [ChatController::class, 'send'])
             ->name('chat.send');
        Route::post('/chat/{matchId}/read', [ChatController::class, 'markRead'])
             ->name('chat.read');
        Route::get('/chat/{matchId}/poll', [ChatController::class, 'poll'])
             ->name('chat.poll');
        Route::get('/chat/unread/count', [ChatController::class, 'unreadCount'])
             ->name('chat.unread');

        // ── Quiz ──────────────────────────────────────────────
        Route::get('/quiz', [QuizController::class, 'welcome'])
             ->name('quiz');
        Route::get('/quiz/start', [QuizController::class, 'start'])
             ->name('quiz.start');
        Route::post('/quiz/answer', [QuizController::class, 'saveAnswer'])
             ->name('quiz.answer');
        Route::get('/quiz/results', [QuizController::class, 'results'])
             ->name('quiz.results');

        // ── Forum ─────────────────────────────────────────────
        Route::get('/forum', [ForumController::class, 'index'])
             ->name('forum');
        Route::get('/forum/create', [ForumController::class, 'create'])
             ->name('forum.create');
        Route::post('/forum', [ForumController::class, 'store'])
             ->name('forum.store');
        Route::get('/forum/{slug}', [ForumController::class, 'show'])
             ->name('forum.show');
        Route::post('/forum/{id}/reply', [ForumController::class, 'reply'])
             ->name('forum.reply');
        Route::post('/forum/{id}/like', [ForumController::class, 'like'])
             ->name('forum.like');

        // ── Blog ──────────────────────────────────────────────
        Route::get('/blog', [BlogController::class, 'index'])
             ->name('blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])
             ->name('blog.show');
        Route::post('/blog/{id}/comment', [BlogController::class, 'comment'])
             ->name('blog.comment');

        // ── Plans ─────────────────────────────────────────────
        Route::get('/plans', [PlanController::class, 'index'])
             ->name('plans');

        // ── Content (52 Weeks) ────────────────────────────────
        Route::get('/content', [ContentController::class, 'index'])
             ->name('content');
        Route::get('/content/{week}', [ContentController::class, 'show'])
             ->name('content.show');
        Route::post('/content/{week}/complete', [ContentController::class, 'complete'])
             ->name('content.complete');

        // ── Notifications ─────────────────────────────────────
        Route::get('/notifications', [NotificationController::class, 'index'])
             ->name('notifications');
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])
             ->name('notifications.read');
        Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
             ->name('notifications.readAll');
        Route::get('/notifications/unread', [NotificationController::class, 'getUnread'])
             ->name('notifications.unread');

    }); // end member group

    // ── Admin Routes ──────────────────────────────────────────
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
             ->name('dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])
             ->name('users.index');
        Route::get('/users/{id}', [AdminUserController::class, 'show'])
             ->name('users.show');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])
             ->name('users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])
             ->name('users.update');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])
             ->name('users.destroy');
        Route::patch('/users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])
             ->name('users.toggle-status');

        // Admin Content
        Route::get('/content', [AdminContentController::class, 'index'])->name('content.index');
        Route::get('/content/{id}/edit', [AdminContentController::class, 'edit'])->name('content.edit');

        // Admin Blog
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [AdminBlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{id}', [AdminBlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{id}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');

        // Admin Forum
        Route::get('/forum', [AdminForumController::class, 'index'])->name('forum');
        Route::delete('/forum/{id}', [AdminForumController::class, 'deleteThread'])->name('forum.destroy');

    }); // end admin group

    // ── Author Routes ─────────────────────────────────────────
    Route::prefix('author')->name('author.')->middleware('author')->group(function () {

        Route::get('/dashboard', [AuthorDashboardController::class, 'index'])
             ->name('dashboard');

    }); // end author group

}); // end auth group

require __DIR__.'/auth.php';