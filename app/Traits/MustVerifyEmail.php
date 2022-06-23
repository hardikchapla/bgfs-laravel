<?php

namespace App\Traits;

use App\Notifications\VerifyEmail;
use App\Notifications\WelcomeEmail;
use App\Notifications\ForgetPassword;

trait MustVerifyEmail
{
    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }
    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
    /**
     * Send the welcome notification.
     *
     * @return void
     */
    public function sendEmailWelcomeNotification()
    {
        $this->notify(new WelcomeEmail);
    }
    /**
     * Send the forget password verification notification.
     *
     * @return void
     */
    public function sendEmailForgetPasswordNotification()
    {
        $this->notify(new ForgetPassword);
    }
    
    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }
}
