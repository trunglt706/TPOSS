<?php

namespace App\Observers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Modules\Admins\Entities\RegisterUsing;
use Illuminate\Support\Str;
use Modules\Admins\Emails\EmailValidateRegister;

class RegisterUsingObserver
{
    public function creating(RegisterUsing $register)
    {
        $register->ip = $_SERVER['SERVER_ADDR'];
        $register->device = $_SERVER['HTTP_USER_AGENT'];
        $register->verify_code = strtoupper(Str::uuid());
        $register->expired_code = Carbon::now()->addHour()->format('Y-m-d H:i:s');
    }

    public function created(RegisterUsing $register)
    {
        // send email or phone to customer to verify
        try {
            Mail::to($register->email)->send(new EmailValidateRegister($register));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updating(RegisterUsing $register)
    {
    }

    public function updated(RegisterUsing $register)
    {
    }

    public function deleted(RegisterUsing $register)
    {
    }

    public function restored(RegisterUsing $register)
    {
        //
    }

    public function forceDeleted(RegisterUsing $register)
    {
        //
    }
}
