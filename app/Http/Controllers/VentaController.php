<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$ventas = venta::with('ventaDetalle')->orderBy('created_at', 'desc')->get();
        $ventas = Venta::with('ventaDetalle.producto')->orderBy('created_at', 'desc')->get();


        return response()->json($ventas);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $venta = new venta();

        
        $venta->costo = $request->costo;
        $venta->ganado = $request->ganado;


        $venta->save();

        $data = [
            'message' => 'venta creada con exito',
            'venta' => $venta
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        return response()->json($venta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        
        $venta->costo = $request->costo;
        $venta->ganado = $request->ganado;

        $venta->save();

        $data = [
            'message' => 'venta editada con exito',
            'productos' => $venta
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */

    
    public function destroy(Venta $venta)
    {
        $venta->ventaDetalle()->delete();
        $venta->delete();

        $data = [
            'message' => 'venta borrado con exito',
            'productos' => $venta,
            
        ];

        return response()->json($data);
    }
    
    public function show_detail($id)
    {
        $venta = venta::find($id);

        return response()->json($venta->ventaDetalle);
    }

    public function buscar($fecha1, $fecha2 = null)
    {
        if ($fecha2) {
            //$venta = venta::whereBetween('created_at', [$fecha1, $fecha2 . ' ' . '23:59:59'])->get();

            $venta = Venta::with('ventaDetalle.producto')
                ->whereBetween('created_at', [$fecha2, $fecha1 . ' ' . '23:59:59'])
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
           // $venta = venta::whereDate('created_at', $fecha1)->get();
           $venta=Venta::with('ventaDetalle.producto')->whereDate('created_at', $fecha1)->get();
           
           
        }



        return response()->json($venta);
    }
}
