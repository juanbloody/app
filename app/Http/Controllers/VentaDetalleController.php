<?php

namespace App\Http\Controllers;

use App\Models\ventaDetalle;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class VentaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $array = $request->input('array');

        $venta_detalle_records = [];

        foreach ($array as $arr) {

            $venta_detalle = new ventaDetalle();

            $venta_detalle->venta_id = $arr['venta_id'];
            $venta_detalle->producto_id = $arr['producto_id'];
            $venta_detalle->unidades = $arr['unidades'];
            $venta_detalle->total = $arr['total'];

            $venta_detalle->save();
            $venta_detalle_records[] = $venta_detalle;
        }

        $data = [
            'message' => 'venta_detalle creada con éxito',
            'productos' => $venta_detalle_records,
            'productos2' => $venta_detalle
        ];

        return response()->json($data);
    }


    /**
     * Display the specified resource.
     */
    public function show(ventaDetalle $ventaDetalle)
    {
        return response()->json($ventaDetalle);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ventaDetalle $ventaDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ventaDetalle $ventaDetalle)
    {
        $ventaDetalle->venta_id = $request->venta_id;
        $ventaDetalle->producto_id = $request->producto_id;
        $ventaDetalle->unidades = $request->unidades;
        $ventaDetalle->total = $request->total;
        $ventaDetalle->save();

        $data = [
            'message' => 'venta_detalle editada con exito',
            'productos' => $ventaDetalle
        ];

        return response()->json($data);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ventaDetalle $ventaDetalle)
    {

        $ventaDetalle->delete();

        $data = [
            'message' => 'venta_detalle borrado con exito',
            'productos' => $ventaDetalle,

        ];

        return response()->json($data);
    }
}
