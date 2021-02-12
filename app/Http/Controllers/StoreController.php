<?php

namespace App\Http\Controllers;
use App\Http\Resources\Store as ResourceStore;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return ResourceStore::collection(Store::orderBy('id','DESC')->limit(2)->get());
        $store = Store::orderby('created_at','DESC')->get();
        return ResourceStore::collection($store);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(Store::create($request->all())){
        //     return response()->json([
        //         'success' => 'Store crée avec succès',
        //     ], 200);
        // }
        
        $path= $request->file('image');
        //$img = Image::make($path)->resize(1200,695)->encode();
        $filename = time(). '.' .$path->getClientOriginalExtension();
        Storage::put($filename);
        Storage::move($filename, 'public/store/' . $filename);

        $store = new Store();
        $store->title = $request->input('title');
        $store->slug = Str::slug($request->input('title'));
        $store->image = $filename;
        $store->save();

        if($store->save()){
            return response()->json([
                'success' => 'La création du store effectué avec succès',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return new ResourceStore($store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        if($store->update($request->all())){
            return response()->json([
                'success' => "Store modifiée avec succès",
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if($store->delete()){
            return response()->json([
                'success' => 'Suppression éffectuée avec succès',
            ]);
        }
    }
}
