<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DatabaseRespaldo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'respaldo:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando  registra en el Log de Laravel';

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
        Log::info('Mi Comando Funciona!');
    }
}
