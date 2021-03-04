<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\Domain as ResourceDomain;
use App\Http\Resources\DomainCollection;

class DomainController extends Controller
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
        $domains = Domain::orderby('created_at','DESC')->get();
        return ResourceDomain::collection($domains);
        //return new DomainCollection($domains);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $path= $request->file('image');
        // $img = Image::make($path)->resize(1200,695)->encode();
        // $filename = time(). '.' .$path->getClientOriginalExtension();
        // Storage::put($filename);
        // Storage::move($filename, 'public/domain/' . $filename);

        /*
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif',
            'store' => 'required',
        ]);
        */
        if($request->hasFile('image')){

            $photo = $request->file('image');
            $name = $photo->getClientOriginalName();
            $imagePath = $photo->move('domain/photo', $name);

            $link_url_image = asset($imagePath);

            $domain = new Domain();
            $domain->title = $request->input('title');
            $domain->slug = Str::slug($request->input('title'));
            $domain->image = $link_url_image;
            $domain->store_id = $request->input('store');
            $domain->save();

            if($domain->save()){
                return response()->json([
                    'success' => 'La création du domaine effectué avec succès',
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //dd($domain->slug);
        $slug = Domain::where('slug',$domain->slug)->first();
        //dd($slug);
        return new ResourceDomain($slug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        if($domain->update($request->all())){
            return response()->json([
                'success' => "Store modifiée avec succès",
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        if($domain->delete()){
            return response()->json([
                'success' => 'Suppression éffectuée avec succès',
            ]);
        }
    }
}
