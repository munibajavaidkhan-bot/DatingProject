<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Author\DashboardController as AuthorDashboard;
use App\Http\Controllers\Member\DashboardController as MemberDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CompleteProfileController; // ✅ ADD THIS LINE
Use App\Http\Controllers\Member\QuizController as MemberQuiz;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Serve profile photos from storage when the public symlink isn't available
Route::get('/profile-photo/{filename}', [App\Http\Controllers\ProfileController::class, 'photo'])
    ->where('filename', '.*')
    ->name('profile.photo');

// After login — redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isAuthor()) {
        return redirect()->route('author.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// ✅ Authenticated routes group
Route::middleware(['auth'])->group(function () {

    // 🔹 COMPLETE PROFILE ROUTES  ✅ ADD THESE TWO
    Route::get('/complete-profile', [CompleteProfileController::class, 'show'])
        ->name('profile.complete');
    Route::post('/complete-profile', [CompleteProfileController::class, 'store'])
        ->name('profile.complete.store');

    // 🔹 ADMIN PANEL
    Route::get('/admin/dashboard', function () {
        $user = auth()->user();
        if (!$user->isAdmin()) {
            abort(403, 'Unauthorized Access');
        }
        return app(AdminDashboard::class)->index();
    })->name('admin.dashboard');

    // 🔹 AUTHOR PANEL
    Route::get('/author/dashboard', function () {
        $user = auth()->user();
        if (!$user->isAuthor()) {
            abort(403, 'Unauthorized Access');
        }
        return app(AuthorDashboard::class)->index();
    })->name('author.dashboard');

    // 🔹 USER PANEL
    Route::get('/user/dashboard', [MemberDashboard::class, 'index'])
    ->middleware(['auth'])
    ->name('user.dashboard');

    // Route::get('/user/dashboard', function () {
    //     $user = auth()->user();
    //     if (!$user->isUser()) {
    //         abort(403, 'Unauthorized Access');
    //     }
    //     return app(MemberDashboard::class)->index();
    // })->name('user.dashboard');

    // 🔹 Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------------------------
// Additional routes for editing any user
// ------------------------------------------
Route::get('/profile/{id}/edit', [ProfileController::class, 'editById'])->name('profile.editById');
Route::patch('/profile/{id}', [ProfileController::class, 'updateById'])->name('profile.updateById');


    // 🔹 User Pages
    Route::get('/user/quiz', function () {
        return view('user.quiz');
    })->name('user.quiz');

    Route::get('/user/matches', function () {
        return view('user.matches');
    })->name('user.matches');

    Route::get('/user/forum', function () {
        return view('user.forum');
    })->name('user.forum');

    Route::middleware('auth')->group(function () {
    Route::get('/quiz', [MemberQuiz::class, 'index'])->name('quiz.index');
    Route::get('/quiz/{id}', [MemberQuiz::class, 'show'])->name('quiz.show');
    Route::post('/quiz', [MemberQuiz::class, 'store'])->name('quiz.store');
});
});
// routes/web.php


require __DIR__.'/auth.php';
