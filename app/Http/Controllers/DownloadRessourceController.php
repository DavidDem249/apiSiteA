<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DownloadRessource;
use App\Models\Ressource;

use App\Mail\SendMailSuccess;
use Illuminate\Support\Facades\Mail;

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

        $data = $request->all();
        
        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        } 

        $resource_id = Ressource::find($resource_id)->first();
        //dd($resource_id->fichier);
        $saving = New DownloadRessource();
        $saving->name = $request->name;
        $saving->firstname = $request->firstname;
        $saving->email = $request->email;
        $saving->profession = $request->profession;
        $saving->save();

        //$file = realPath($resource_id->fichier);
        $filename = $resource_id->name;
        $file = asset($resource_id->fichier);
        //dd($file);
        //$filename = 'temp-image.jpg';
        

        //$file = '/var/www/html/api-agilestelecoms/storage/app/public/'.$resource_id->fichier;
        //$file = public_path('storage').'/agilesRessources/DOIgWtWDXlQIYAgKYeHmZ84mSfGSOPRyCdLqxqx6.pdf';
        //dd($file);

        if($saving->save()) {

            // return response()->json([
            //     "success" => true,
            //     "message" => "Données enregistrée avec succès",
            //     "fichier" => $saving
            // ]);
            Mail::to('david.kouakou@agilestelecoms.com')
                ->cc('daouda.dembele@agilestelecoms.com')
                ->Send(new SendMailSuccess($data));

            //$tempImage = tempnam(sys_get_temp_dir(), $filename);
            //dd($tempImage);
            //copy(realPath($resource_id->fichier), $tempImage);

            //return response()->download($tempImage, $filename);
            //return response()->download($file);
        
            return response()->json([
                'link_ressoure' => $file
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
