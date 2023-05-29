<?php

namespace Modules\Admins\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class EmailAdminActive extends Mailable
{
    use Queueable, SerializesModels;
    private $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin)
    {
        $this->admin = $admin;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Kích hoạt tài khoản quản lý',
        );
    }

    public function content()
    {
        return new Content(
            view: 'Distribute.Email.reset_password',
        );
    }
}
