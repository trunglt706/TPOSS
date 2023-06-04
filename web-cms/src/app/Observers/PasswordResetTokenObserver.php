<?php

namespace App\Observers;

use App\Models\PasswordResetToken;
use Carbon\Carbon;

class PasswordResetTokenObserver
{
    /**
     * Handle the PasswordResetToken "created" event.
     */
    public function created(PasswordResetToken $passwordResetToken): void
    {
        $passwordResetToken->token = $passwordResetToken->token ?? generateRandomString(16);
        $passwordResetToken->ip = $passwordResetToken->ip ?? get_ip();
        $passwordResetToken->device = $passwordResetToken->device ?? get_device();
        $passwordResetToken->type = $passwordResetToken->type ?? PasswordResetToken::TYPE_ADMIN;
        $passwordResetToken->expired_at = $passwordResetToken->expired_at ?? Carbon::now()->addMinutes(15);
    }

    /**
     * Handle the PasswordResetToken "updated" event.
     */
    public function updated(PasswordResetToken $passwordResetToken): void
    {
        //
    }

    /**
     * Handle the PasswordResetToken "deleted" event.
     */
    public function deleted(PasswordResetToken $passwordResetToken): void
    {
        //
    }

    /**
     * Handle the PasswordResetToken "restored" event.
     */
    public function restored(PasswordResetToken $passwordResetToken): void
    {
        //
    }

    /**
     * Handle the PasswordResetToken "force deleted" event.
     */
    public function forceDeleted(PasswordResetToken $passwordResetToken): void
    {
        //
    }
}
