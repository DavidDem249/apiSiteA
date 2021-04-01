<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostulerResource;
use App\Models\Postuler;
use Illuminate\Support\Facades\Mail;
use App\Models\Annonce;

use App\Mail\MailPostuler;
use App\Mail\ResponseMailPostuler;

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
       
        
        if($request->hasFile('cv'))
        {
            //basename 
            $cv = $data['cv'];

            //====== NEW =========
            $size = filesize($cv);

            if($size<2300000)
            {
                //dd($cv);
                $time = time();

                //$cvName = $cv->getClientOriginalName();
                //$cvExtension = $cv->getClientOriginalExtension();
                $cvName = date('YmdHis') . "." . $cv->getClientOriginalExtension();
                //dd($cvExtension);
                $cvPath = $cv->move('recrutement/cv', $cvName);
                //dd($cvPath);
                $link_url_cv = asset($cvPath);
                //dd($link_url_cv);

                $data['cv'] = $link_url_cv;
                //dd($data);

                $postulant = new Postuler();
                $postulant->nom = $data['nom'];
                $postulant->prenom = $data['prenom'];
                $postulant->email = $data['email'];
                $postulant->phone = $data['phone'];

                $postulant->cv = $link_url_cv;
                //$postulant->motivation = $data['motivation'];
                $postulant->annonce_id = $annonce->id;

                $postulant->save();

            }else{
                //dd($l);
                return response()->json([
                    'code' =>0,
                    'file' => "Votre fichier ne doit pas dépasser 2.2 MO",
                ], 401);
            }

            //==============END==========
           

            if($postulant->save())
            {
                /*
                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new MailPostuler($data)); */
                //Mail::to($data['email'])->send(new ResponseMailPostuler($data));
                //Send Mail Online
                
                Mail::to('rh@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->bcc('david.kouakou@agilestelecoms.com')
                    ->Send(new MailPostuler($data)); 

                Mail::to($data['email'])->send(new ResponseMailPostuler($data));
                
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
    public function show(Postuler $postulant)
    {
        return new PostulerResource($postulant);
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
