<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Resources\Formation as ResourceFormation;

class FormationController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth', ['except' => ['index','show','store','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Formation::orderby('created_at','DESC')->get();
        return ResourceFormation::collection($formations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $path= $request->file('image');
        //$img = Image::make($path)->resize(1200,695)->encode();
        $filename = time(). '.' .$path->getClientOriginalExtension();
        Storage::put($filename);
        Storage::move($filename, 'public/formation/' . $filename);

        $formation = new Formation();
        $formation->title = $request->input('title');
        $formation->slug = Str::slug($request->input('title'));
        $formation->image = $filename;
        $formation->domain_id = $request->input('domain');
        $formation->save();

        if($formation->save()){
            return response()->json([
                'success' => 'Formation créee avec succès',
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        return new ResourceFormation($formation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        if($formation->update($request->all())){
            return response()->json([
                'success' => "Formation modifiée avec succès",
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        if($formation->delete()){
            return response()->json([
                'success' => 'Suppression éffectuée avec succès',
            ]);
        }
    }
}
