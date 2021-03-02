<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Carriere;
use Illuminate\Support\Facades\Mail;

class CarriereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'nom' => 'required|min:2',
            'prenom' => 'required|min:3',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|max:255',
            'fichiers' => 'required|mimes:doc,docx,pdf,txt',
        ]);

        $nom = $request->nom;
        $prenom = $request->prenom;
        $phone = $request->phone;
        $email = $request->email;
        $fichiers = $request->fichiers;

        $description = "<br/><br/> Numéro : $phone"."<br/><br/> Candidat : $nom $prenom"."<br/><br/> Adresse email : $email"."<br/><br/> Cv: $fichiers";

        $emailAgile = 'david.kouakou@agilestelecoms.com';

        //$file = $request->file('cv');
        Mail::send([], [], function ($message) use ($nom,$email,$description,$emailAgile, $fichiers, $request) {
            $message->to($emailAgile)
                ->from($email,$nom)
                ->replyTo($email)
                ->subject("AGILES TELECOMS - RECRUTEMENT")
                ->setBody("<html>$description</html>", 'text/html'); // for HTML rich messages

            if($request->hasFile('fichiers')){
                
                $message->attach($fichiers->getRealPath(), array(
                    'as' => $fichiers->getClientOriginalName(), // If you want you can chnage original name to custom name      
                    'mime' => $fichiers->getMimeType())
                );
            }
        });
        
        return response()->json('OK', 200);
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
