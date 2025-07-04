<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Spatie\MailTemplates\TemplateMailable;

class TeamAccountCreatedMail extends TemplateMailable
{
    use Queueable, SerializesModels;

    public $username;
    public $password;
    public $email;
    public $full_name;
    public $login_url;
    public $support_email;
    public $created_at;
    public $created_by;

    public function __construct(User $user, string $temporaryPassword, string $createdBy = null)
    {
        $this->username = $user->username ?? $user->email;
        $this->password = $temporaryPassword;
        $this->email = $user->email;
        $this->full_name = $user->name;
        $this->login_url = config('app.url') . '/login';
        $this->created_at = now()->format('M j, Y \a\t g:i A T');
        $this->created_by = $createdBy ?? 'System Administrator';
    }

    public function getHtmlLayout(): string
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Account Created</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #4f46e5; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background-color: #f9fafb; }
                .credentials { background-color: #e5e7eb; padding: 15px; border-radius: 5px; margin: 20px 0; }
                .button { display: inline-block; background-color: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin: 10px 0; }
                .footer { text-align: center; color: #6b7280; font-size: 12px; padding: 20px; }
                .queue-info { background-color: #dbeafe; padding: 10px; border-radius: 3px; font-size: 11px; color: #1e40af; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Welcome to Our Platform</h1>
                </div>
                <div class="content">
                    {{{ body }}}
                </div>
                <div class="footer">
                    <div class="queue-info">
                        Account created: {{ created_at }} | Created by: {{ created_by }}
                    </div>
                    <p>&copy; 2025 Your Company Name. All rights reserved.</p>
                    <p>Need help? Contact us at {{ support_email }}</p>
                </div>
            </div>
        </body>
        </html>';
    }
}
