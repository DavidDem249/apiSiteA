<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Carriere;
use Illuminate\Support\Facades\Mail;

class CarriereController extends Controller
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
            'nom' => 'required|min:2',
            'prenom' => 'required|min:3',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|max:255',
            'fichiers' => 'required|mimes:doc,docx,pdf,txt',
        ]);

        $data = $request->all();
        $pdf = $data['fichiers'];

        if($validator->fails()){          
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $pdf_data = $pdf;

        Mail::send('pdf.application',$pdf_data, function ($message) use($pdf_data, $pdf) {
        $message->to('daouda.dembele@agilestelecoms.com', $data["nom"])
            ->subject('RECRUTEMENT')
            ->attachData($pdf->output(), "application_" . $data["name"] . ".pdf");
        });

        //Mail::to('my@mail.com')->send(new NewApplication($application->fresh()));

        return response()->json('OK', 200);

        //dd($request->all());
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
