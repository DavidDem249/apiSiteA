<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;

class RecaptchaController extends Controller
{
    

    public function recaptcha(Request $request)
    {

    	$secret = \config('captcha.v2-checkbox');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $request['recaptcha'],
        ]);

        // session()->put([
        //     'payload' => $response->body(),
        // ]);

        return response()->json([
          'success' => $response,
      	], 200);

        //return redirect()->route('captchav2-checkbox');
    }
}
