<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Demande as ResourceDemande;
use App\Models\Demande;

class DemandesController extends Controller 
{

  public function __construct()
  {
      $this->middleware('auth', ['except' => ['index','show','store']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $demande = Demande::orderby('created_at','DESC')->get();
      return ResourceDemande::collection($demande);
  }

  
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
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
          ], 200);
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Demande $demande)
  {
       return new ResourceDemande($demande);
  }

  
  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Demande $demande)
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
   * @return Response
   */
  public function destroy(Demande $demande)
  {
      if($demande->delete()){
          return response()->json([
              'success' => 'Suppression éffectuée avec succès',
          ]);
      }
  }
  
}

?>