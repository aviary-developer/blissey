<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Illuminate\Console\Command;

class DatabaseRespaldo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'respaldo:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando crea un respaldo de la base de datos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fecha = Carbon::now()->format('d-m-Y_h-i');//pg_dump.exe -h localhost -p 5432 -U postgres -F c -v -d NOMBRE_BD -f RUTA
        $usuario = env('DB_USERNAME');
        $contrasena= env('DB_PASSWORD');
        $base=env('DB_DATABASE');
        $host=env('DB_HOST');
        $puerto=env('DB_PORT');
        $comando="pg_dump.exe -h {$host} -p {$puerto} -U {$usuario} -W {$contrasena} -F c -v -d {$base} -f c:/xampp/htdocs/{$fecha}.dump";
        $proceso = new Process($comando);
        $proceso->start();
    }
}
