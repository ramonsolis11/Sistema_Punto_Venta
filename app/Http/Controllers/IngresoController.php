<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Models\Ingreso;
use App\Models\DetalleIngreso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;


class IngresoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = trim($request->get('texto'));
        $ingresos = DB::table('ingreso as i') // Tabla ingreso
            ->join('persona as p', 'i.id_proveedor', '=', 'p.id_persona')
            ->join('detalle_ingreso as di', 'i.id_ingreso', '=', 'di.id_ingreso')
            ->select('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.num_comprobante', 'LIKE', '%' . $query . '%')
            ->orderBy('i.id_ingreso', 'desc')
            ->groupBy('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
            ->paginate(7);

        return view('compras.ingreso.index', ['ingresos' => $ingresos, 'texto' => $query]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
