<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    function email()
    {
        $data = ['test_message' => 'This is a test!'];
        Mail::to('ageorge28@gmail.com')->send(new TestEmail($data));
    }

}
