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
        //dd($request->all());
        $validate = $request->validate([
            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'phone' => 'required|min:20',
            'email' => 'required|email|max:255',
            'lien_linkdin' => 'required',
            'domaine' => 'required',
            'technologie' => 'required',
            'titre_formation' => 'required',
            'details_formation' => 'required',
            //'g-recaptcha-response' => 'required|recaptcha'
        ]);

        // $secret = \config('captcha.v2-checkbox');

        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
        //       'secret' => $secret,
        //       'response' => $request['g-recaptcha-response'],
        // ]);

        // session()->put([
        //     'payload' => $response->body(),
        // ]);

        if($validate)
        {
            // if($response->success)
            // {
            Formateur::create($request->all());
            Mail::to('daouda.dembele@agilestelecoms.com')->Send(new Message($data));

            return response()->json([
                'success' => true,
                'message' => 'Votre demande a bien été effectuée avec succès',
            ], 200);
            // }
        }
    }

    public function candidater(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'phone' => 'required|min:8',
            'email' => 'required|email|max:255',
            'lien_linkdin' => 'nullable',
            'domaine' => 'required',
            'technologie' => 'required',
            'titre_formation' => 'required',
            'details_formation' => 'required|mimes:doc,docx,pdf,txt',
            'cv' => 'required|mimes:doc,docx,pdf,txt',
            //'g-recaptcha-response' => 'required|recaptcha'
        ]);
        
        if($data)
        {
            // 
            if($request->hasFile('cv')){

                $cv = $data['cv'];
                $detail = $data['details_formation'];
                //$nameCv = $cv->getClientOriginalName();
                $cvName = date('YmdHis') . "." . $cv->getClientOriginalExtension();
                $detailName = date('YmdHis') . "." . $detail->getClientOriginalExtension();

                $pathCv = $cv->move('agilesRessources/formateurCv', $cvName);
                $pathDetail = $detail->move('agilesRessources/detailsFormation', $detailName);

                $link_url_cv = asset($pathCv);
                $link_url_detail = asset($pathDetail);

                $data['cv'] = $link_url_cv;
                $data['details_formation'] = $link_url_detail;
                
                $formateur = new Formateur();
                $formateur->nom = $data['nom'];
                $formateur->prenom = $data['prenom'];
                $formateur->phone = $data['phone'];
                $formateur->email = $data['email'];
                $formateur->lien_linkdin = $data['lien_linkdin'] ?? "";
                $formateur->domaine = $data['domaine'];
                $formateur->technologie = $data['technologie'];
                $formateur->titre_formation = $data['titre_formation'];
                $formateur->details_formation = $link_url_detail;
                $formateur->cv = $link_url_cv;
                $formateur->save();


                Mail::to('david.kouakou@agilestelecoms.com')
                    ->cc('daouda.dembele@agilestelecoms.com')
                    ->Send(new Message($data));

                return response()->json([
                    'success' => true,
                    'message' => 'Votre demande a bien été effectuée avec succès',
                ], 200);


            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Veilliez choisir un fichier valide svp',
                ], 400);
            }

        }else{
            return response()->json([
                'success' => false,
                'message' => 'Veilliez bien remplir les champs',
            ], 400);
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
