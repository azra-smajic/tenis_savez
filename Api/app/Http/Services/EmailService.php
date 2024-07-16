<?php

namespace App\Http\Services;

use App\Constants\MailConstants;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateUserMail;

class EmailService
{
    public static function sendCreateUserMail($receivingEmail, $name, $temporaryPassword)
    {
        $title = MailConstants::CREATE_USER_TITLE;
        Mail::to($receivingEmail)->send(new CreateUserMail($title, $name, $temporaryPassword));
    }
}
