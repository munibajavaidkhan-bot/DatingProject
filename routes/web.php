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
use App\Http\Controllers\Member\PoemController;
use App\Http\Controllers\Member\ArticleController;
use App\Http\Controllers\Member\StoryController;
use App\Http\Controllers\Public\JourneyController;
use App\Http\Controllers\Public\AuthorPageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PoemController as AdminPoemController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\StoryController as AdminStoryController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use App\Http\Controllers\Author\BlogController as AuthorBlogController;
use App\Http\Controllers\Author\PoemController as AuthorPoemController;
use App\Http\Controllers\Author\ArticleController as AuthorArticleController;
use App\Http\Controllers\Author\StoryController as AuthorStoryController;

// ── Public Routes ─────────────────────────────────────────────
Route::get('/', fn() => view('welcome'))->name('welcome');
Route::post('/verify-age', function () {
    session(['age_verified' => true]);
    return response()->json(['success' => true]);
})->name('verify.age');
Route::get('/pricing', [PlanController::class, 'publicIndex'])->name('pricing');
Route::get('/terms', fn() => view('terms'))->name('terms');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');

// ── Poems (public) ────────────────────────────────────────────
Route::get('/poems', [PoemController::class, 'index'])->name('poems.index');
Route::get('/poems/{slug}', [PoemController::class, 'show'])->name('poems.show');

// ── Articles (public) ─────────────────────────────────────────
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// ── Stories (public) ──────────────────────────────────────────
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{slug}', [StoryController::class, 'show'])->name('stories.show');

// ── 52-Week Journey (public preview) ──────────────────────────
Route::get('/journey', [JourneyController::class, 'index'])->name('journey');

// ── Author Page (public) ─────────────────────────────────────
Route::get('/author/{slug}', [AuthorPageController::class, 'show'])->name('author.page');

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
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
         ->name('profile.password');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])
         ->name('profile.show');
    Route::get('/profile-pending', function () {
        return view('profile.pending');
    })->name('profile.pending');

    // ── Member Routes ─────────────────────────────────────────
    Route::prefix('member')->name('member.')->middleware('profile.complete')->group(function () {

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
        Route::post('/chat/accept-disclaimer', [ChatController::class, 'acceptSafetyDisclaimer'])
             ->name('chat.accept-disclaimer');
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
        Route::post('/chat/message/{messageId}/reaction', [ChatController::class, 'toggleReaction'])
             ->name('chat.reaction');
        Route::get('/chat/message/{messageId}/reactions', [ChatController::class, 'getReactions'])
             ->name('chat.reactions');

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

        // Profile Approvals
        Route::get('/approvals', [AdminUserController::class, 'pendingApprovals'])->name('approvals');
        Route::post('/approvals/{profileId}/approve', [AdminUserController::class, 'approveProfile'])->name('approvals.approve');
        Route::post('/approvals/{profileId}/reject', [AdminUserController::class, 'rejectProfile'])->name('approvals.reject');

        // Admin Content
        Route::get('/content', [AdminContentController::class, 'index'])->name('content.index');
        Route::get('/content/{id}/edit', [AdminContentController::class, 'edit'])->name('content.edit');
        Route::put('/content/{id}', [AdminContentController::class, 'update'])->name('content.update');

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

        // Admin Poems
        Route::get('/poems', [AdminPoemController::class, 'index'])->name('poems.index');
        Route::get('/poems/create', [AdminPoemController::class, 'create'])->name('poems.create');
        Route::post('/poems', [AdminPoemController::class, 'store'])->name('poems.store');
        Route::get('/poems/{id}/edit', [AdminPoemController::class, 'edit'])->name('poems.edit');
        Route::put('/poems/{id}', [AdminPoemController::class, 'update'])->name('poems.update');
        Route::delete('/poems/{id}', [AdminPoemController::class, 'destroy'])->name('poems.destroy');

        // Admin Articles
        Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
        Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

        // Admin Stories
        Route::get('/stories', [AdminStoryController::class, 'index'])->name('stories.index');
        Route::get('/stories/create', [AdminStoryController::class, 'create'])->name('stories.create');
        Route::post('/stories', [AdminStoryController::class, 'store'])->name('stories.store');
        Route::get('/stories/{id}/edit', [AdminStoryController::class, 'edit'])->name('stories.edit');
        Route::put('/stories/{id}', [AdminStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{id}', [AdminStoryController::class, 'destroy'])->name('stories.destroy');

        // Admin Chat
        Route::get('/chat', [AdminChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/{matchId}', [AdminChatController::class, 'show'])->name('chat.show');
        Route::delete('/chat/message/{messageId}', [AdminChatController::class, 'destroyMessage'])->name('chat.message.destroy');
        Route::delete('/chat/{matchId}', [AdminChatController::class, 'destroyMatch'])->name('chat.destroy');

        // Admin Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    }); // end admin group

    // ── Author Routes ─────────────────────────────────────────
    Route::prefix('author')->name('author.')->middleware('author')->group(function () {

        Route::get('/dashboard', [AuthorDashboardController::class, 'index'])
             ->name('dashboard');

        Route::get('/blog', [AuthorBlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [AuthorBlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [AuthorBlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{id}/edit', [AuthorBlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{id}', [AuthorBlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{id}', [AuthorBlogController::class, 'destroy'])->name('blog.destroy');
        Route::patch('/blog/{id}/publish', [AuthorBlogController::class, 'publish'])->name('blog.publish');

        // Author Poems
        Route::get('/poems', [AuthorPoemController::class, 'index'])->name('poems.index');
        Route::get('/poems/create', [AuthorPoemController::class, 'create'])->name('poems.create');
        Route::post('/poems', [AuthorPoemController::class, 'store'])->name('poems.store');
        Route::get('/poems/{id}/edit', [AuthorPoemController::class, 'edit'])->name('poems.edit');
        Route::put('/poems/{id}', [AuthorPoemController::class, 'update'])->name('poems.update');
        Route::delete('/poems/{id}', [AuthorPoemController::class, 'destroy'])->name('poems.destroy');
        Route::patch('/poems/{id}/publish', [AuthorPoemController::class, 'publish'])->name('poems.publish');

        // Author Articles
        Route::get('/articles', [AuthorArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [AuthorArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [AuthorArticleController::class, 'store'])->name('articles.store');
        Route::get('/articles/{id}/edit', [AuthorArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{id}', [AuthorArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{id}', [AuthorArticleController::class, 'destroy'])->name('articles.destroy');
        Route::patch('/articles/{id}/publish', [AuthorArticleController::class, 'publish'])->name('articles.publish');

        // Author Stories
        Route::get('/stories', [AuthorStoryController::class, 'index'])->name('stories.index');
        Route::get('/stories/create', [AuthorStoryController::class, 'create'])->name('stories.create');
        Route::post('/stories', [AuthorStoryController::class, 'store'])->name('stories.store');
        Route::get('/stories/{id}/edit', [AuthorStoryController::class, 'edit'])->name('stories.edit');
        Route::put('/stories/{id}', [AuthorStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{id}', [AuthorStoryController::class, 'destroy'])->name('stories.destroy');
        Route::patch('/stories/{id}/publish', [AuthorStoryController::class, 'publish'])->name('stories.publish');

    }); // end author group

}); // end auth group

require __DIR__.'/auth.php';