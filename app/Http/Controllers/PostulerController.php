<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostulerResource;
use App\Models\Postuler;
use Illuminate\Support\Facades\Mail;
use App\Models\Annonce;

use App\Mail\MailPostuler;

class PostulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulants = Postuler::orderby('created_at', 'DESC')->get();
        return PostulerResource::collection($postulants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Annonce $annonce)
    {
        $data = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:8',
            'cv' => 'required|mimes:doc,docx,pdf,txt',
            'motivation' => 'nullable',
            //'annonce_id' => 'required',
            'annonce_title' => 'nullable',
        ]);

        $annonce_title = $annonce->title;

        $data['annonce_title'] = $annonce_title;
        
        /*
        $nom = $request->nom;
        $prenom = $request->prenom;
        $phone = $request->phone;
        $email = $request->email;
        //$cv = $request->cv;
        $cv = $request->file('cv');
        //$cv = asset($cv);
        $motivation = $request->motivation;
        //dd($data);
        $description = "<br/><br/>Candidature au poste de : $annonce_title <br/><br/> Numéro : $phone"."<br/><br/> Candidat : $nom $prenom"."<br/><br/> Adresse email : $email"."<br/><br/>Motivation : $motivation <br/><br/>"."<br/><br/>CV : $cv";

        $emailAgile = 'daouda.dembele@agilestelecoms.com';
        */
        if($request->hasFile('cv'))
        {
           
            $cv = $request->file('cv');
            $cvName = $cv->getClientOriginalName();
            $cvPath = $cv->move('postuler/cv', $cvName);
            //dd($cvPath);
            $link_url_cv = asset($cvPath);
            //dd($link_url_cv);

            $postulant = new Postuler();
            $postulant->nom = $data['nom'];
            $postulant->prenom = $data['prenom'];
            $postulant->email = $data['email'];
            $postulant->phone = $data['phone'];

            $postulant->cv = $link_url_cv;
            $postulant->motivation = $data['motivation'];
            $postulant->annonce_id = $annonce->id;

            $postulant->save();

            if($postulant->save())
            {

                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new MailPostuler($data)); 
               /* 
                Mail::send([], [], function ($message) use ($nom,$email,$description,$emailAgile, $cv, $request) {

                    $message->to($emailAgile)
                        ->from($email,$nom)
                        ->replyTo($email)
                        ->subject("AGILES TELECOMS - RECRUTEMENT")
                        ->setBody("<html>$description</html>", 'text/html'); // for HTML rich messages

                    if($request->hasFile('cv')){
                        
                        $message->attach($cv->getRealPath(), array(
                            'as' => $cv->getClientOriginalName(), // If you want you can chnage original name to custom name      
                            'mime' => $cv->getMimeType())
                        );
                    }
                });
                */
                return response()->json([
                    'success' => 'true',
                    'postulant' => $postulant,
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
