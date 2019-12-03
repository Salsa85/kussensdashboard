<?php

namespace App\Http\Controllers;

use App\Error;
use Illuminate\Http\Request;
use App\Mail\errorOverview;
use Mail;

class EmailController extends Controller
{
    public function htmlEmail()
{
    $errors = Error::get();
    $data = [
        'name'      => 'Biggus Dickus',
        'message'   => 'The life of brian',
        'subject'   => 'Laravel Plain Email',
        'from'      => 'info@local.com',
        'from_name' => 'Laravel HTML Email',
    ];

    Mail::to('info@zencule.com', 'Chappie')->send(new errorOverview($errors));

    return "HTML Email Sent. Check your inbox.";
}
}
