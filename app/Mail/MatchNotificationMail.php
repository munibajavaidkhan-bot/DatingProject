<?php

namespace App\Mail;

use App\Models\User;
use App\Models\UserMatch;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MatchNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public User $matchedUser,
        public UserMatch $match
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have a new match! 🎉',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.match',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
