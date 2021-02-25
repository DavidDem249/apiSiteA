<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DownloadRessource;
use App\Models\Ressource;

class DownloadRessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ressource $resource_id)
    {
        $validator = Validator::make($request->all(),[ 
            'name' => 'required|min:2',
            'firstname' => 'required|min:3',
            'email' => 'required|email|max:255',
            'profession' => 'required',
        ]);

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 

        $resource_id = Ressource::find($resource_id);
        dd($resource_id);
        $saving = New DownloadRessource();
        $saving->name = $request->name;
        $saving->firstname = $request->firstname;
        $saving->email = $request->email;
        $saving->profession = $request->profession;
        $saving->save();

        if($saving->save()) {

            return response()->json([
                "success" => true,
                "message" => "Données enregistrée avec succès",
                "data" => $saving
            ]);

        }else{
            return response()->json([
                "success" => false,
                "message" => "échec d'enregistrement",
            ]);
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