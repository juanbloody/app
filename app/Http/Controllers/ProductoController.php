<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$producto= producto::orderBY('id','desc')->paginate(5);

        $producto = producto::orderBY('created_at', 'desc')->get();

        return response()->json($producto);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        for ($i = 1; $i <= 100; $i++) {

            $producto = new producto();

            
            $producto->codigo = null;
            $producto->nombre = 'producto' . $i;
            $producto->valor = $i;
            $producto->cantidad = $i;
            $producto->total = $i;
            $producto->quedaron = $i;
            $producto->valor_quedaron = $i;
            $producto->valor_provedor = $i;
            $producto->valor_unitario = $i;
            $producto->observaciones = null;
            $producto->save();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $producto = new producto();

        
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->valor = $request->valor;
        $producto->cantidad = $request->cantidad;
        $producto->total = $request->total;
        $producto->quedaron = $request->quedaron;
        $producto->valor_quedaron = $request->valor_quedaron;
        $producto->valor_provedor = $request->valor_provedor;
        $producto->valor_unitario = $request->valor_unitario;
        $producto->observaciones = $request->observaciones;
        $producto->save();

        $data = [
            'message' => 'producto creado con exito',
            'productos' => $producto
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->valor = $request->valor;
        $producto->cantidad = $request->cantidad;
        $producto->total = $request->total;
        $producto->quedaron = $request->quedaron;
        $producto->valor_quedaron = $request->valor_quedaron;
        $producto->valor_provedor = $request->valor_provedor;
        $producto->valor_unitario = $request->valor_unitario;
        $producto->observaciones = $request->observaciones;
        $producto->save();

        $data = [
            'message' => 'producto editado con exito',
            'productos' => $producto
        ];

        return response()->json($data);
    }

    public function update2(Request $request)
    {
        $array = $request->input('array');

        foreach ($array as $index => $arr) {

            $producto = Producto::find($arr['producto']['id']);

            
            $producto->codigo = $arr['producto']['codigo'];
            $producto->nombre = $arr['producto']['nombre'];
            $producto->valor = $arr['producto']['valor'];
            $producto->cantidad = $arr['producto']['cantidad'];
            $producto->total = $arr['producto']['total'];
            $producto->quedaron = $arr['producto']['quedaron'];
            $producto->valor_quedaron = $arr['producto']['valor_quedaron'];
            $producto->valor_provedor = $arr['producto']['valor_provedor'];
            $producto->valor_unitario = $arr['producto']['valor_unitario'];
            $producto->observaciones = $arr['producto']['observaciones'];
            $producto->update();
        }

        $data = [
            'message' => 'producto editado con exito',
            'productos' => $producto
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        $data = [
            'message' => 'producto borrado con exito',
            'productos' => $producto
        ];

        return response()->json($data);
    }

    public function buscar($name)
    {
        $producto = producto::where('nombre', 'LIKE', '%' . $name . '%')
            ->orWhere('codigo', 'LIKE', '%' . $name . '%')
            ->get();
        return response()->json($producto);
    }
}
