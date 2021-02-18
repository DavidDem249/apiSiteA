<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Resources\Module as ResourceModule;

class ModuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Module::orderby('created_at','DESC')->get();
        return ResourceModule::collection($formations);
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
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'stat' => 'required',
            'duration' => 'required',
        ]);

        $path= $request->file('image');
        //$img = Image::make($path)->resize(1200,695)->encode();
        $filename = time(). '.' .$path->getClientOriginalExtension();
        Storage::put($filename);
        Storage::move($filename, 'public/module/' . $filename);
        
        $module = new Module();
        $module->title = $request->input('title');
        $module->slug = Str::slug($request->input('title'));
        $module->image = $filename;
        $module->stat = $request->input('stat'); // Soit Debutant, Intermediare ou Avancé
        $module->duration = $request->input('duration');
        $module->formation_id = $request->input('formation');
        $module->save();

        if($module->save()){
            return response()->json([
                'success' => 'Module créee avec succès',
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        return new ResourceModule($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        if($module->update($request->all())){
            return response()->json([
                'success' => "Module modifiée avec succès",
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        if($formation->delete()){
            return response()->json([
                'success' => 'Suppression éffectuée avec succès',
            ]);
        }
    }
}
