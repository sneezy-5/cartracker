<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleEmail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $to = $request->input('to');
        dispatch(new SendEmail($to));

        return response()->json(['message'=>'send success'],200);
    }
}

