<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
//use Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RessourceR;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $resources = Ressource::orderby('created_at','DESC')->get();;
        return RessourceR::collection($resources);
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
            'fichier' => 'required|mimes:doc,docx,pdf,txt,pptx,png,jpg,jpeg|max:2048',
        ]); 

        // $validator = $request->validate([
        //     'title' => 'required',
        //     'illustration' => 'nullable|mimes:png,jpg,jpeg,gif|max:2305',
        //     'fichier' => 'nullable|mimes:doc,docx,pdf,txt|max:2048',
        // ]);

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 

        
        if($fichier = $request->file('fichier')) {

            

            if($illust = $request->file('illustration'))
            {
                //dd($illust);

                $pathIllustration = $illust->store('public/agilesRessources/photo');

                //$nameFichier = $fichier->getClientOriginalName();

                $pathFichier = $fichier->store('agilesRessources','public');
                $nameFichier = $fichier->getClientOriginalName();

                //dd($pathFichier);
      
                //store your file into directory and db
                $ressource = new Ressource();
                $ressource->title = $request->title;
                $ressource->illustration = $pathIllustration;
                $ressource->fichier= $pathFichier;
                $ressource->name = $nameFichier;
                $ressource->save();

                //dd($ressource);
                return response()->json([
                    "success" => true,
                    "message" => "File successfully uploaded",
                   // "fichier" => $pathFichier
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
    public function show(Ressource $resource)
    {

        return new RessourceR($resource);
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
