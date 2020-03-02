<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Artisan;
use Log;
use Illuminate\Http\Request;
use App\Bitacora;

class RespaldoController extends Controller
{
    public function index()
    {
      $disco = Storage::disk('local');
      $archivos = $disco->files('\Respaldos');
      $respaldos = [];
      foreach ($archivos as $k => $f) {
      if ($disco->exists($f)) {
                $respaldos[] = [
                    'directorio' => $f,
                    'nombre' => str_replace('Respaldos'. '/', '', $f),
                    'tamanio' => $disco->size($f),
                    'fecha' => $disco->lastModified($f),
                ];
              }
            }
      return view('Respaldos.index',compact('respaldos'));
    }

    public function crear()
    {
      $string="respaldo_".Carbon::now()->format('Y-m-d_h_i_s_a').".sql";
      try {
          // start the backup process
          Artisan::call("db:backup", [
            "--database" => "mysql", // This missed
            "--destination" => "local",
            "--destinationPath" => "/".$string,
            "--compression" => "null",
          ]);
          $output = Artisan::output();
          // log the results
          Log::info("Se inició un respaldo desde la aplicación \r\n" . $output);
          Log::info("Respaldo completado con exito");
          // return the results as a response to the ajax call
          Bitacora::bitacora('store','respaldos','respaldos',0);
          return redirect()->back()->with('mensaje', '¡Respaldo creado!');
      } catch (Exception $e) {
          Flash::error($e->getMessage());
          return redirect()->back();
      }
    }
    public function restaurar($file_name)
    {
      set_time_limit(300);//5 minutes
      $respaldo = $file_name;
      try {
          // start the backup process
          Artisan::call("db:restore", [
            "--source" => "local",
            "--sourcePath" => "/".$respaldo,
            "--database" => "mysql", // This missed
            "--compression" => "null",
          ]);
          $output = Artisan::output();
          // log the results
          Log::info("Se inició una restauración desde la aplicación \r\n" . $output);
          Log::info("Restauración completado con exito");
          // return the results as a response to the ajax call
          Bitacora::bitacora('update','respaldos','respaldos',0);
          return redirect()->back()->with('mensaje', '¡Restauración completada!');
      } catch (Exception $e) {
          Flash::error($e->getMessage());
          return redirect()->back();
      }
    }

    public function subir(Request $request)
    {
      $file = $request->file('subirRespaldo');
      $nombre = $file->getClientOriginalName();
      Storage::disk('local')->put('/Respaldos/'.$nombre,\File::get($file));
      Bitacora::bitacora('store','respaldos','respaldos',0);
      return redirect()->back()->with('mensaje', '¡Respaldo agregado!');
    }

    public function descargar($file_name)
    {
        $file = '/Respaldos/' . $file_name;
        $disk = Storage::disk('local');
        if ($disk->exists($file)) {
            $fs = Storage::disk('local')->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function eliminar($file_name)
    {
        $disk = Storage::disk('local');
        if ($disk->exists('/Respaldos/' . $file_name)) {
            $disk->delete('/Respaldos/' . $file_name);
            Bitacora::bitacora('destroy','respaldos','respaldos',0);
            return redirect()->back()->with('mensaje', '¡Respaldo eliminado!');
        } else {
            abort(404, "El Respaldo no existe!");
        }
    }
}
