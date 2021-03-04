<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Demande as ResourceDemande;
use App\Models\Demande;

class DemandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demande = Demande::orderby('created_at','DESC')->get();
        return ResourceDemande::collection($demande);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'email' => 'bail|required|email',
            'phone' => 'required|min:3',
            'prenom' => 'required|min:3',
            'module' => 'required|numeric',
        ]);
        
        $demandeur = new Demande();
        $demandeur->nom = $request->input('nom');
        $demandeur->prenom = $request->input('prenom');
        $demandeur->email = $request->input('email');
        $demandeur->phone = $request->input('phone');
        $demandeur->module_id = $request->input('module');
        $demandeur->save();

        if($demandeur->save()){
           return response()->json([
              'success' => 'Démande de formation effectué avec succès',
          ], 201);
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
        return new ResourceDemande($id);
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
        if($demande->update($request->all())){
            return response()->json([
                'success' => "Demande modifiée avec succès",
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($demande->delete()){
          return response()->json([
              'success' => 'Suppression éffectuée avec succès',
          ]);
        }
    }
}
