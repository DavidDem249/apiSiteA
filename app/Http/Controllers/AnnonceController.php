<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Annonce;
use App\Mail\MailAnnonce;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\AnnonceResource;

Use Carbon\Carbon;

class AnnonceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = request()->validate([
            'search' => 'nullable|min:3',
        ]);
        //dd($data['search']);
        if($data && !is_null($data['search']))
        {
            $text = request()->input('search');

            $annonces = Annonce::where('category', 'like', "%$text%")
                        ->orderBy('created_at', 'DESC')
                        ->where('title', 'like', "%$text%")->get();
        }else{

            $annonces = Annonce::orderby('created_at', 'DESC')->where('status',1)->get();
        }
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
            'title' => 'nullable|min:2',
            'entreprise' => 'nullable|min:3',
            'phone' => 'nullable|min:7',
            'duration' => 'nullable',
            'marge_salaire' => 'nullable',
            //'description_profil' => 'required',
            'description_dossier' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,svg',
            'localisation' => 'nullable',
            'email' => 'required|email|max:255',
            'date' => 'nullable',
            'contrat_type' => 'nullable',
            'marge_salarial' => 'nullable',
            'description_annonce' => 'nullable',
            'type_travail' => 'nullable', 
            'diplome' => 'nullable',
            'dure_experience' => 'nullable',
            'comp_tech' => 'nullable',
            'aptitude_pro' => 'nullable',
            'category' => 'nullable',
            'place' => 'nullable',
        ]);  

        //dd($validator);

        
        //dd($data);

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 

        $data = $request->all();

        //dd($data);

        $now = Carbon::now();
        $date_now = $now->format('d-m-Y');

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
                $annonce->date = $date_now;
                $annonce->contrat_type = $request->contrat_type;
                $annonce->marge_salarial = $request->marge_salarial;
                $annonce->description_annonce = $request->description_annonce;
                $annonce->type_travail = $request->type_travail;
                $annonce->diplome = $request->diplome;
                $annonce->dure_experience = $request->dure_experience;
                $annonce->comp_tech = $request->comp_tech;
                $annonce->aptitude_pro = $request->aptitude_pro;
                $annonce->category = $request->category;
                $annonce->place = $request->place;
                $annonce->save();

                /*
                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new MailAnnonce($data));
                */
                //Send Mail Online
                Mail::to('rh@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->bcc('david.kouakou@agilestelecoms.com')   
                    ->Send(new MailAnnonce($data));  

                return response()->json([
                    "success" => true,
                    "message" => "Annonce publiée avec succès",
                    "annonces" => $annonce
                ], 200);

                /*if($annonce->save())
                {
                    
                }*/

            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Veilliez choisir une image",
                ], 201);
            }
        }else{

            // $now = Carbon::now();
            // $date_now = $now->format('d-m-Y');

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
            $annonce->date = $date_now;
            $annonce->contrat_type = $request->contrat_type;
            $annonce->marge_salarial = $request->marge_salarial;
            $annonce->description_annonce = $request->description_annonce;
            $annonce->type_travail = $request->type_travail;
            $annonce->diplome = $request->diplome;
            $annonce->dure_experience = $request->dure_experience;
            $annonce->comp_tech = $request->comp_tech;
            $annonce->aptitude_pro = $request->aptitude_pro;
            $annonce->category = $request->category;
            $annonce->place = $request->place;
            $annonce->save();

            /* 
            Mail::to('daouda.dembele@agilestelecoms.com')
                ->cc('david.kouakou@agilestelecoms.com')
                ->Send(new MailAnnonce($data));
            */
            //Send Mail Online
             
            Mail::to('daouda.dembele@agilestelecoms.com')
                ->cc('david.kouakou@agilestelecoms.com')
                ->Send(new MailAnnonce($data));  

            return response()->json([
                "success" => true,
                "message" => "Annonce publiée avec succès",
                "annonces" => $annonce
            ], 200);
            
            /*if($annonce->save())
            {
                
            }*/
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response */
     
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
    public function update(Request $request, Annonce $annonce_id)
    {
        $validator = Validator::make($request->all(),[ 
            'title' => 'nullable|min:2',
            'entreprise' => 'nullable|min:3',
            'phone' => 'nullable|min:7',
            'duration' => 'nullable',
            'marge_salaire' => 'nullable',
            //'description_profil' => 'required',
            'description_dossier' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,svg',
            'localisation' => 'nullable',
            'email' => 'nullable|email|max:255',
            'date' => 'nullable',
            'contrat_type' => 'nullable',
            'marge_salarial' => 'nullable',
            'description_annonce' => 'nullable',
            'type_travail' => 'nullable', 
            'diplome' => 'nullable',
            'dure_experience' => 'nullable',
            'comp_tech' => 'nullable',
            'aptitude_pro' => 'nullable',
            'category' => 'nullable',
            'place' => 'nullable',
        ]);  
        
        $id_annonce = $annonce_id->id;
        //dd($id_annonce);
        //dd($data);

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 



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

                Annonce::whereId($id_annonce)->update([
                    "title" => $request->title,
                    "entreprise" => $request->entreprise,
                    "phone" => $request->phone,
                    "duration" => $request->duration,
                    "marge_salaire" => $request->marge_salaire,
                    "description_dossier" => $request->description_dossier,
                    "image" => $link_url_image,
                    "localisation" => $request->localisation,
                    "email" => $request->email,
                    "date" => $request->date,
                    "contrat_type" => $request->contrat_type,
                    "marge_salarial" => $request->marge_salarial,
                    "description_annonce" => $request->description_annonce,
                    "type_travail" => $request->type_travail,
                    "diplome" => $request->diplome,
                    "dure_experience" => $request->dure_experience,
                    "comp_tech" => $request->comp_tech,
                    "aptitude_pro" => $request->aptitude_pro,
                    "category" => $request->category,
                    "place" => $request->place,
                ]);
                /*
                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new MailAnnonce($data)); 
                
                $annonce->save();
                */
                return response()->json([
                    "success" => true,
                    "message" => "Annonce publiée avec succès",
                    "annonces" => $annonce
                ], 200);
            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Veilliez choisir une image",
                ], 201);
            }
        }else{

            Annonce::whereId($id_annonce)->update([
                "title" => $request->title,
                "entreprise" => $request->entreprise,
                "phone" => $request->phone,
                "duration" => $request->duration,
                "marge_salaire" => $request->marge_salaire,
                "description_dossier" => $request->description_dossier,
                "localisation" => $request->localisation,
                "email" => $request->email,
                "date" => $request->date,
                "contrat_type" => $request->contrat_type,
                "marge_salarial" => $request->marge_salarial,
                "description_annonce" => $request->description_annonce,
                "type_travail" => $request->type_travail,
                "diplome" => $request->diplome,
                "dure_experience" => $request->dure_experience,
                "comp_tech" => $request->comp_tech,
                "aptitude_pro" => $request->aptitude_pro,
                "category" => $request->category,
                "place" => $request->place,
            ]);
            /*
            Mail::to('david.kouakou@agilestelecoms.com')
                ->cc('daouda.dembele@agilestelecoms.com')
                ->Send(new MailAnnonce($data)); 

            $annonce->save();
            */
            return response()->json([
                "success" => true,
                "message" => "Annonce publiée avec succès",
                "annonces" => $annonce
            ], 200);
           
        }
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
