<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Carriere;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailRecrutement;

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
        $data = $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:3',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|max:255',
            'fichiers' => 'required|mimes:doc,docx,pdf,txt',
        ]);
       

        if($request->hasFile('fichiers')){
            
            $cv = $request->file('fichiers');
            $name = $cv->getClientOriginalName();
            $CvPath = $cv->move('recrutement/cv', $name);
            $link_url_cv = asset($CvPath);
            //dd($link_url_cv);

            $spontanne = new Carriere();
            $spontanne->nom = $request->nom;
            $spontanne->prenom = $request->prenom;
            $spontanne->phone = $request->phone;
            $spontanne->email = $request->email;
            $spontanne->fichiers = $link_url_cv;
            $spontanne->save();

            if($spontanne->save())
            {

                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new MailRecrutement($data)); 

                return response()->json([
                    'success' => 'true',
                    'postulant' => $spontanne,
                ], 200);
            }
        }
        /*});*/
        
        
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
