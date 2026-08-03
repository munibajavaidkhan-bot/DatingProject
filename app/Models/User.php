<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\Models\QuizQuestion;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'role', 'status',
        'gender', 'dob', 'location', 'bio', 'profile_picture',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ─── Role Constants ───────────────────────────────────────
    const ROLE_ADMIN  = 'admin';
    const ROLE_AUTHOR = 'author';
    const ROLE_USER   = 'user';

    // ─── Role Helpers ─────────────────────────────────────────
    public function isAdmin(): bool  { return $this->role === self::ROLE_ADMIN; }
    public function isAuthor(): bool { return $this->role === self::ROLE_AUTHOR; }
    public function isUser(): bool   { return $this->role === self::ROLE_USER; }

    public function isActive(): bool { return $this->status === 'active'; }

    // ─── Relationships ────────────────────────────────────────
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function matchesAsUserOne()
    {
        return $this->hasMany(UserMatch::class, 'user_one_id');
    }

    public function matchesAsUserTwo()
    {
        return $this->hasMany(UserMatch::class, 'user_two_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function quizAnswers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function contentProgress()
    {
        return $this->hasMany(UserContentProgress::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function forumThreads()
    {
        return $this->hasMany(ForumThread::class);
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    // ─── Helpers ──────────────────────────────────────────────
    public function getAllMatches()
    {
        return UserMatch::where('user_one_id', $this->id)
            ->orWhere('user_two_id', $this->id);
    }

    public function getUnreadMessagesCount(): int
    {
        return Message::where('receiver_id', $this->id)
            ->where('is_read', false)
            ->count();
    }

    public function getUnreadNotificationsCount(): int
    {
        return $this->notifications()->unread()->count();
    }

    public function getAvatarUrl(): string
    {
        if ($this->profile && $this->profile->profile_picture) {
            return asset('storage/' . $this->profile->profile_picture);
        }
        $name = urlencode($this->name ?? 'User');
        return "https://ui-avatars.com/api/?name={$name}&background=ec4899&color=fff&size=200&bold=true";
    }

    public function getAge(): ?int
    {
        return $this->profile?->age
            ?? ($this->dob ? Carbon::parse($this->dob)->age : null);
    }

    public function getCurrentWeek(): int
    {
        $completed = $this->contentProgress()
            ->where('is_completed', true)
            ->count();
        return min($completed + 1, 52);
    }

    public function getProgressPercent(): float
    {
        $completed = $this->contentProgress()
            ->where('is_completed', true)
            ->count();
        return round(($completed / 52) * 100, 1);
    }

    public function hasCompletedQuiz(): bool
    {
        $total = QuizQuestion::where('is_active', true)->count();

        return $total > 0 && $this->quizAnswers()->count() >= $total;
    }

    public function isPremium(): bool
    {
        $sub = $this->subscription()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->first();

        return $sub !== null;
    }
}