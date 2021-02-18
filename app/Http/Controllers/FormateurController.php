<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur; 
use App\Http\Resources\FormateurResource;
use App\Mail\Message;
use Illuminate\Support\Facades\Mail;


class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formateur = Formateur::orderby('created_at','DESC')->get();
        //dd($formateur);
        return FormateurResource::collection($formateur);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'phone' => 'required|min:20',
            'email' => 'required|email|max:255',
            'lien_linkdin' => 'required|url',
            'domaine' => 'required|url',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);

        $secret = \config('captcha.v2-checkbox');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
              'secret' => $secret,
              'response' => $request['g-recaptcha-response'],
        ]);

        session()->put([
            'payload' => $response->body(),
        ]);

        if($validate)
        {
            if($response->success)
            {
                Formateur::create($request->all());
                Mail::to('info@agilestelecoms.com')->Send(new Message($data));

                return response()->json([
                    'success' => 'Votre demande a bien été effectuée avec succès',
                ], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
