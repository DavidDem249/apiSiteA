<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
//use Validator;
use Illuminate\Support\Facades\Validator;

class RessourceController extends Controller
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

        $validator = Validator::make($request->all(),[ 
            'title' => 'required',
            'illustration' => 'required|mimes:png,jpg,jpeg,gif|max:2305',
            'fichier' => 'required|mimes:doc,docx,pdf,txt|max:2048',
        ]); 

        // $validator = $request->validate([
        //     'title' => 'required',
        //     'illustration' => 'nullable|mimes:png,jpg,jpeg,gif|max:2305',
        //     'fichier' => 'nullable|mimes:doc,docx,pdf,txt|max:2048',
        // ]);

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 

        //dd($validator);

        if($fichier = $request->file('fichier')) {

            if($illust = $request->file('illustration'))
            {

                $pathIllustration = $illust->store('public/agilesRessources/photo');
                //$nameFichier = $fichier->getClientOriginalName();

                $pathFichier = $fichier->store('public/agilesRessources');
                $nameFichier = $fichier->getClientOriginalName();
      
                //store your file into directory and db
                $ressource = new Ressource();
                $ressource->title = $validator['title'];
                $ressource->illustration = $pathIllustration;
                $ressource->fichier= $pathFichier;
                $ressource->name = $nameFichier;
                $ressource->save();
                   
                return response()->json([
                    "success" => true,
                    "message" => "File successfully uploaded",
                    "file" => $file
                ]);
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
