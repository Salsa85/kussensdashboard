<?php

namespace App\Http\Controllers;

use App\Error;
use Illuminate\Http\Request;
use App\Mail\ErrorOverview;
use Mail;

class EmailController extends Controller
{
    public function htmlEmail()
{
    $errors = Error::where(['paid' => 0])->get();

    if ($errors->isNotEmpty()) {
        Mail::to('info@termopol.nl')
        ->bcc('info@kussens.nu')
        ->send(new ErrorOverview($errors));
        return "send";

    } else {

        return "Not send";
    }


}
}
