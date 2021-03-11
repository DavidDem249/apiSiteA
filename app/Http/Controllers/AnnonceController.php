<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Annonce;
use App\Mail\MailAnnonce;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\AnnonceResource;

class AnnonceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annonces = Annonce::orderby('created_at', 'DESC')->where('status',1)->get();
        return AnnonceResource::collection($annonces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[ 
            'title' => 'required|min:2',
            'entreprise' => 'required|min:3',
            'phone' => 'required|min:7',
            'duration' => 'required',
            'marge_salaire' => 'nullable',
            //'description_profil' => 'required',
            'description_dossier' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,svg',
            'localisation' => 'nullable',
            'email' => 'required|email|max:255',
            'date' => 'required',
            'contrat_type' => 'required',
            'marge_salarial' => 'nullable',
            'description_annonce' => 'required',
            'type_travail' => 'nullable', 
            'diplome' => 'nullable',
            'dure_experience' => 'nullable',
            'comp_tech' => 'nullable',
            'aptitude_pro' => 'nullable',
        ]);  

        //dd($validator);

        
        //dd($data);

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 

        $data = $request->all();

        //dd($data);

        if(request('image'))
        {
            if($request->hasFile('image'))
            {

                $photo = $request->file('image');
                $name = $photo->getClientOriginalName();
                $imagePath = $photo->move('annonce/photo', $name);
                
                $link_url_image = asset($imagePath);
                //dd($link_url_image);
                //$data['image'] = $link_url_image;
                //dd($data);
                //dd($imagePath);

                $annonce = new Annonce();
                $annonce->title = $request->title;
                $annonce->entreprise = $request->entreprise;
                $annonce->phone = $request->phone;
                $annonce->duration = $request->duration;
                $annonce->marge_salaire = $request->marge_salaire;
                //$annonce->description_profil = $request->description_profil;
                $annonce->description_dossier = $request->description_dossier;
                $annonce->image = $link_url_image;
                $annonce->localisation = $request->localisation;
                $annonce->email = $request->email;
                $annonce->date = $request->date;
                $annonce->contrat_type = $request->contrat_type;
                $annonce->marge_salarial = $request->marge_salarial;
                $annonce->description_annonce = $request->description_annonce;
                $annonce->type_travail = $request->type_travail;
                $annonce->diplome = $request->diplome;
                $annonce->dure_experience = $request->dure_experience;
                $annonce->comp_tech = $request->comp_tech;
                $annonce->aptitude_pro = $request->aptitude_pro;

                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new MailAnnonce($data)); 

                $annonce->save();
                
                if($annonce->save())
                {
                    //dd($annonce);

                    return response()->json([
                        "success" => true,
                        "message" => "Annonce publiée avec succès",
                        "annonces" => $annonce
                    ], 200);
                }
            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Veilliez choisir une image",
                ], 201);
            }
        }else{


            $annonce = new Annonce();
            $annonce->title = $request->title;
            $annonce->entreprise = $request->entreprise;
            $annonce->phone = $request->phone;
            $annonce->duration = $request->duration;
            $annonce->marge_salaire = $request->marge_salaire;
            //$annonce->description_profil = $request->description_profil;
            $annonce->description_dossier = $request->description_dossier;
            $annonce->localisation = $request->localisation;
            $annonce->email = $request->email;
            $annonce->date = $request->date;
            $annonce->contrat_type = $request->contrat_type;
            $annonce->marge_salarial = $request->marge_salarial;
            $annonce->description_annonce = $request->description_annonce;
            $annonce->type_travail = $request->type_travail;
            $annonce->diplome = $request->diplome;
            $annonce->dure_experience = $request->dure_experience;
            $annonce->comp_tech = $request->comp_tech;
            $annonce->aptitude_pro = $request->aptitude_pro;

            Mail::to('david.kouakou@agilestelecoms.com')
                ->cc('daouda.dembele@agilestelecoms.com')
                ->Send(new MailAnnonce($data)); 

            $annonce->save();
            
            if($annonce->save())
            {
                //dd($annonce);

                return response()->json([
                    "success" => true,
                    "message" => "Annonce publiée avec succès",
                    "annonces" => $annonce
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
    public function show(Annonce $annonce_id)
    {
        //$annonce_id = Annonce::find($annonce_id);
        //dd($annonce_id);
        return new AnnonceResource($annonce_id);
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
    public function destroy(Annonce $annonce_id)
    {
        if($annonce_id->delete()){
          return response()->json([
              'success' => 'Suppression éffectuée avec succès',
          ]);
        }
    }
}
