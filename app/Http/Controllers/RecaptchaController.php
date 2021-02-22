<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;

class RecaptchaController extends Controller
{
    

    public function recaptcha(Request $request)
    {

    	$secret = \config('captcha.v2-checkbox');
    	//dd($secret);
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' =>  $request['recaptcha'],
        ]);

        //dd($response->body());
        // session()->put([
        //     'payload' => $response->body(),
        // ]);

        return response()->json([
          'success' => $response->body(),
      	], 200);

        //return redirect()->route('captchav2-checkbox');
    }
}
