<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\Paciente::class,50)->create();
        // $this->call(LlenarProductoSeeder::class);
        // $this->call(LlenarUsuarioSeeder::class);
        $this->call(InventarioSeeder::class);
    }
}
