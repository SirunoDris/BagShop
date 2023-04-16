<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bag;
use Illuminate\Http\Request;

class BagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bag = Bag::All();
        return $bag;
    }

    /**
     * Create a new Bag.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'material' => 'required',
            'user_id' => 'required',
        ]);
    
        $bag = new Bag;
        $bag->name = $request->name;
        $bag->price = $request->price;
        $bag->material = $request->material;
        $bag->user_id = $request->user_id;
        $bag->save();

        return response()->json([
            'message'=> 'Bag creado correctamente',
            'bag'=>$bag
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bag  $bag
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        $bag = Bag::findOrFail($id);
        return $bag;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bag  $bag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bag $bag)
    {
        //Esta mal ¡, lo que esta jacienddo es crea rmas bolso
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'material' => 'required',
            'user_id' => 'required',
        ]);

        $bag->name = $request->name;
        $bag->price = $request ->price;
        $bag->material = $request ->material;
        $bag->user_id = $request->user_id;
        $bag->save();

        //$bags = Bag::update($request);
        return response()->json([
            'message'=> 'Bag actualizado correctamente',
            'bag'=>$bag
        ],201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bag  $bag
     * @return \Illuminate\Http\Response
     */
    public function delete(Bag $bag)
    {
        $bag->delete();
        return response()->json([
            'message'=> 'Bag eliminado correctamente',
            'bag'=>$bag
        ],201);

    }
}
