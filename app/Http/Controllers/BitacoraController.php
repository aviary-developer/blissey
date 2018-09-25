<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use App\User;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Correlativo paginado
        $pagina = ($request->get('page')!=null)?$request->get('page'):1;
        $pagina--;
        $pagina *= 10;
        $usuarioRequest = $request->get('usuario');
        if($usuarioRequest == 0){
            $usuarioRequest = null;
        }
        $fechaMaxRequest = $request->get('fecha_max');
        $fechaMinRequest = $request->get('fecha_min');

        $fechaInicial = Bitacora::orderBy('created_at','asc')->first();
        $fechaFinal = Bitacora::orderBy('created_at','desc')->first();

        if($fechaMaxRequest == null){
            $fechaMaxRequest = $fechaFinal->created_at->format('Y-m-d H:i:s');

            $storeRequest = 1;
            $updateRequest = 1;
            $destroyRequest = 1;
            $activateRequest = 1;
            $desactivateRequest = 1;
            $loginRequest = 1;
            $logoutRequest = 1;
        }else{
            $aux = explode(':',$fechaMaxRequest);
            $aux[1]++;
            $fechaMaxRequest = $aux[0].':'.$aux[1];

            $storeRequest = $request->get('store');
            $updateRequest = $request->get('update');
            $destroyRequest = $request->get('destroy');
            $activateRequest = $request->get('activate');
            $desactivateRequest = $request->get('desactivate');
            $loginRequest = $request->get('login');
            $logoutRequest = $request->get('logout');
        }
        if($fechaMinRequest == null){
            $fechaMinRequest = $fechaInicial->created_at->format('Y-m-d H:i:s');
        }
        
        $bitacoras = Bitacora::buscar(
            $usuarioRequest,
            $fechaMinRequest,
            $fechaMaxRequest,
            $storeRequest,
            $updateRequest,
            $destroyRequest,
            $activateRequest,
            $desactivateRequest,
            $loginRequest,
            $logoutRequest
        );
        $usuarios = User::orderBy('apellido')->get();
        return view('Bitacoras.index',compact(
            'bitacoras',
            'usuarios',
            'fechaInicial',
            'fechaFinal',
            'fechaMinRequest',
            'fechaMaxRequest',
            'pagina'
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
