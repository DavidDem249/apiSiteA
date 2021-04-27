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

    public function candidater(Request $request)
    {
        // 'details_formation' => 'required|mimes:doc,docx,pdf,txt',
        // 'cv' => 'required|mimes:doc,docx,pdf,txt',
        //dd($request->all());
        $data = $request->validate([
            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'phone' => 'required|min:8',
            'email' => 'required|email|max:255',
            'domaine' => 'required',
            'pays' => 'nullable',
            'ville' => 'nullable',
        ]);
        
        if($data)
        {
           //dd($data);
            $formateur = new Formateur();
            $formateur->nom = $data['nom'];
            $formateur->prenom = $data['prenom'];
            $formateur->phone = $data['phone'];
            $formateur->email = $data['email'];
            $formateur->domaine = $data['domaine'];
            $formateur->pays = $data['pays'];
            $formateur->ville = $data['ville'];
            $formateur->save();


            Mail::to('daouda.dembele@agilestelecoms.com')
                //->cc('daouda.dembele@agilestelecoms.com')
                ->Send(new Message($data));

            return response()->json([
                'success' => true,
                'message' => 'Votre demande a bien été effectuée avec succès',
                'data' => new FormateurResource($formateur),
            ], 200);

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
