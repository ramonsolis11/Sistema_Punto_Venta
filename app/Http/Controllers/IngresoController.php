<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Models\Ingreso;
use App\Models\DetalleIngreso;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;




class IngresoController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index(Request $request)
{
    if ($request) {
        $query = trim($request->get('texto'));
        $ingresos = DB::table('ingreso as i')
            ->join('persona as p', 'i.id_proveedor', '=', 'p.id_persona')
            ->join('detalle_ingreso as di', 'di.id_ingreso', '=', 'i.id_ingreso')
            ->select('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->where('i.num_comprobante', 'LIKE', '%' . $query . '%')
            ->groupBy('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
            ->orderBy('i.id_ingreso', 'desc')
            ->paginate(15);

        return view('compras.ingreso.index', ["ingresos" => $ingresos, "texto" => $query]);
    }
}

public function create()
{
    $personas = DB::table('persona')->where('tipo_persona', '=', 'Proveedor')->get();
    $ingreso = Ingreso::all();
    $productos = DB::table('producto as p')
        ->select(DB::raw('CONCAT(p.codigo, " ", p.nombre) AS Articulo'), 'p.id_articulo', 'p.stock', 'p.unidad')
        ->where('p.estatus', '=', 'Activo')
        ->get();

    return view('compras.ingreso.create', ["personas" => $personas, "productos" => $productos, "ingreso" => $ingreso]);
}

public function store(Request $request)
{
    try {
        DB::beginTransaction();
        $ingreso = new Ingreso();
        $ingreso->id_proveedor = $request->get('id_proveedor');
        $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
        $ingreso->num_comprobante = $request->get('num_comprobante');
        $mytime = Carbon::now('America/Tegucigalpa');
        $ingreso->fecha_hora = $mytime->toDateTimeString();
        $ingreso->impuesto = '15';
        $ingreso->estado = 'A';
        $ingreso->save();

        $id_producto = $request->get('id_producto');
        $cantidad = $request->get('cantidad');
        $precio_compra = $request->get('precio_compra');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while ($cont < count($id_producto)) {
            $detalle = new DetalleIngreso();
            $detalle->id_ingreso = $ingreso->id_ingreso;
            $detalle->id_producto = $id_producto[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio_compra = $precio_compra[$cont];
            $detalle->precio_venta = $precio_venta[$cont];
            $detalle->save();
            $cont = $cont + 1;
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
    }

    return Redirect::to('compras/ingreso');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ingreso = DB::table('ingreso as i')
            ->join('persona as p', 'i.id_proveedor', '=', 'p.id_persona')
            ->join('detalle_ingreso as di', 'di.id_ingreso', '=', 'i.id_ingreso')
            ->select('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->where('i.id_ingreso', '=', $id)
            ->groupBy('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('producto as p', 'd.id_producto', '=', 'p.id_producto')
            ->select('p.nombre as producto', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')
            ->where('d.id_ingreso', '=', $id)
            ->get();

        return view('compras.ingreso.show', ["ingreso" => $ingreso, "detalles" => $detalles]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->estado = 'C';
        $ingreso->update();

        return Redirect::to('compras/ingreso');
    }
};

