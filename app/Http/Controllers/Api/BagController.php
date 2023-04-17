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
     * Crea un Bag con sus parametros
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
     * Display all the bags
     * 
     */
    public function read($id)
    {
        $bag = Bag::findOrFail($id);
        return $bag;
    }

    /**
     * Actualiza el registro del Bag por id
     */
    public function update(Request $request, Bag $bag)
    {
        $request->validate([
            'id'=> 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'material',
        ]);
        $id =$request->get('id');
        $registroBag = Bag::find($id);
        if (!$registroBag) {
            return "No existe un bag con este id";
        }
        $registroBag->name = $request->input('name');
        $registroBag->price = $request->input('price');
        $registroBag->material = $request->input('material');
        $registroBag->save();
        return response()->json([
            'message'=> 'Bag actualizado correctamente',
            'bag'=>$registroBag
        ],201);
    }

    /**
     * Elimina el Bag por ID
     */
function delete(Bag $bag, $id)
    {
        $bag = Bag::find($id);
        if(!$bag){
            return "No se ha encontrado ningun bag con este id";
        }
        $bag->delete();
        return response()->json([
            'message'=> 'Bag eliminado correctamente',
            'bag'=>$bag
        ],201);

    }
}
