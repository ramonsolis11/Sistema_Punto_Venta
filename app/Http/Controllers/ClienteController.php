<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {

            $query=trim($request->get('texto'));
            $clientes=DB::table('persona')
                ->where('nombre', 'LIKE', '%' . $query . '%')
                ->where('tipo_persona', '=', 'Cliente')
                ->where('estatus', '=', '1')
                ->orderBy('id_persona', 'desc')
                ->paginate(7);

            return view('ventas.clientes.index', [
                "cliente"=>$clientes,
                "texto"=>$query
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ventas.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteFormRequest $request)
    {
        $cliente = Cliente::create([
            'tipo_persona' => 'Cliente',
            'nombre' => $request->input('nombre'),
            'tipo_documento' => $request->input('tipo_documento'),
            'num_documento' => $request->input('num_documento'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'estatus' => '1',
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente creado con éxito.');
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('ventas.clientes.show', [
            "clientes"=>Cliente::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ventas.clientes.edit', [
            "cliente"=>Cliente::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteFormRequest $request, $id)
    {
        $cliente=Cliente::findOrFail($id);

        $cliente->nombre = $request->input('nombre');
        $cliente->tipo_documento = $request->input('tipo_documento');
        $cliente->num_documento = $request->input('num_documento');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');

        $cliente->update();

        return Redirect::to('ventas/cliente')
            ->with('success', 'Cliente actualizado con éxito');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estatus = '0';
        $cliente->update();

        return redirect()->route('cliente.index')
            ->with('success', 'Cliente eliminado con éxito');
    }
}
