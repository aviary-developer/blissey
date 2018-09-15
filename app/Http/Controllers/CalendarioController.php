<?php

namespace App\Http\Controllers;

use App\Calendario;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where('estado',true)->orderBy('apellido')->get();

        $hora_i = Carbon::createFromTime(null, 0, 0);
        $hora_f = Carbon::createFromTime(null, 30, 0);

        return view('Calendario.index',compact(
            'usuarios',
            'hora_i',
            'hora_f'
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
        DB::beginTransaction();
        try{
            $evento = new Calendario;
            $evento->fecha_inicio = $request->fecha_inicio;
            $evento->fecha_final = $request->fecha_final;
            if(Auth::user()->tipoUsuario == "Recepción"){
                if($request->f_usuario != 0){
                    $evento->f_usuario = $request->f_usuario;
                }else{
                    $evento->tipo_usuario = $request->tipo_usuario;
                }
            }else{
                $evento->f_usuario = Auth::user()->id;
            }
            $evento->titulo = $request->titulo;
            $evento->descripcion = $request->descripcion;
            $evento->save();

            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function show(Calendario $calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendario $calendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $evento = Calendario::find($id);
        DB::beginTransaction();
        
        try{
            $evento->titulo = $request->titulo;
            $evento->descripcion = $request->descripcion;
            $evento->save();

            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Calendario::find($id);
        DB::beginTransaction();
        
        try{
            $evento->delete();

            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }
    }

    public function eventos(){
        $todos = Calendario::where('tipo_usuario','=','0')->get();
        $usuario = Calendario::where('f_usuario', Auth::user()->id)->get();
        $tipo = Calendario::where('tipo_usuario',Auth::user()->tipoUsuario)->get();

        $medicos = [];
        if(Auth::user()->tipoUsuario == "Recepción"){
            $ev = Calendario::where('f_usuario','!=',null)->get();
            $i = 0;
            foreach($ev as $e){
                if($e->usuario->tipoUsuario == "Médico" || $e->usuario->tipoUsuario == "Gerencia"){
                    $medicos[$i] = $e;
                    $i++;
                }
            }
        }

        $evento = [];
        $i = 0;
        if($todos != null){
            foreach($todos as $e){
                $evento[$i]['id'] = $e->id;
                $evento[$i]['start'] = $e->fecha_inicio;
                $evento[$i]['end'] = $e->fecha_final;
                $evento[$i]['title'] = $e->titulo;
                $evento[$i]['desc'] = $e->descripcion;
                $evento[$i]['color'] = 'lightseagreen';
                $i++;
            }
        }
        if($usuario != null){
            foreach($usuario as $e){
                $evento[$i]['id'] = $e->id;
                $evento[$i]['start'] = $e->fecha_inicio;
                $evento[$i]['end'] = $e->fecha_final;
                $evento[$i]['title'] = $e->titulo;
                $evento[$i]['desc'] = $e->descripcion;
                $evento[$i]['color'] = 'crimson';
                $i++;
            }
        }
        if($tipo != null){
            foreach($tipo as $e){
                $evento[$i]['id'] = $e->id;
                $evento[$i]['start'] = $e->fecha_inicio;
                $evento[$i]['end'] = $e->fecha_final;
                $evento[$i]['title'] = $e->titulo;
                $evento[$i]['desc'] = $e->descripcion;
                $evento[$i]['color'] = 'dodgerblue';
                $i++;
            }
        }
        if($medicos != null){
            foreach($medicos as $e){
                $evento[$i]['id'] = $e->id;
                $evento[$i]['start'] = $e->fecha_inicio;
                $evento[$i]['end'] = $e->fecha_final;
                $evento[$i]['title'] = $e->titulo;
                $evento[$i]['desc'] = $e->descripcion;
                $evento[$i]['color'] = 'purple';
                $i++;
            }
        }

        return $evento;
    }
}
