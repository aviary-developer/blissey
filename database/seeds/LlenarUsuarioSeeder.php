<?php

use Illuminate\Database\Seeder;
use App\Especialidad;
use App\User;
use App\Habitacions;
use App\Paciente;
// require 'C:\xampp\htdocs\blissey\vendor\autoload.php';

class LlenarUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $especialidades=[
        //     'Alergología','Cardiología','Gastroenterología','Geriatría','Infectología',
        //     'Nefrología','Neumología','Neurología','Nutriología','Oftalmología',
        //     'Oncología','Pediatría','Psiquiatría','Urología','Otorrinolaringología',
        //     'Urología','Obstetricia'];
        //     foreach ($especialidades as $key => $e) {
        //         $esp= new Especialidad();
        //         $esp->nombre=$e;
        //         $esp->save();
        //     }
        // $u=new User();
        // $u->name="Farmacia";
        // $u->email="ngrd94@gmail.com";
        // $u->password=bcrypt("ngrd94@gmail.com");
        // $u->nombre="Ingrid María";
        // $u->apellido="Ayala Morales";
        // $u->direccion="Final avenidad 14 de Julio Barrio Guadalupe";
        // $u->fechaNacimiento="1994-07-14";
        // $u->dui="32454354-5";
        // $u->sexo=0;
        // $u->juntaVigilancia="466655644";
        // $u->estado=1;
        // $u->firma="noImgen.jpg";
        // $u->sello="noImgen.jpg";
        // $u->foto="noImgen.jpg";
        // $u->administrador=1;
        // $u->tipoUsuario="Farmacia";
        // $u->save();

        // $u=new User();
        // $u->name="Recepcion";
        // $u->email="recepcion@gmail.com";
        // $u->password=bcrypt("recepcion@gmail.com");
        // $u->nombre="Carlos René";
        // $u->apellido="Ruiz Morazán";
        // $u->direccion="Avenida Cayetano Molina Quiroz";
        // $u->fechaNacimiento="1993-09-3";
        // $u->dui="32434353-6";
        // $u->sexo=1;
        // $u->juntaVigilancia="4637555663";
        // $u->estado=1;
        // $u->firma="noImgen.jpg";
        // $u->sello="noImgen.jpg";
        // $u->foto="noImgen.jpg";
        // $u->administrador=1;
        // $u->tipoUsuario="Recepción";
        // $u->save();

        // $u=new User();
        // $u->name="LabClinico";
        // $u->email="clinico@gmail.com";
        // $u->password=bcrypt("clinico@gmail.com");
        // $u->nombre="Alejandro Antonio";
        // $u->apellido="Henríquez Merino";
        // $u->direccion="Calle Dr. Manuel Pacas, 7a avenida sur";
        // $u->fechaNacimiento="1994-02-17";
        // $u->dui="32434367-0";
        // $u->sexo=1;
        // $u->juntaVigilancia="4637559893";
        // $u->estado=1;
        // $u->firma="noImgen.jpg";
        // $u->sello="noImgen.jpg";
        // $u->foto="noImgen.jpg";
        // $u->administrador=1;
        // $u->tipoUsuario="Laboaratorio";
        // $u->save();


        $faker = Faker\Factory::create('es_ES');

        for($i=0;$i<50;$i++){
            $s=random_int(0,1);
            if($s){
                $n=$faker->firstNameMale." ".$faker->firstNameMale; 
            }else{
                $n=$faker->firstNameFemale." ".$faker->firstNameFemale; 
            }
            $p= new Paciente();
            $p->nombre =$n;
            $p->apellido =   $faker->lastName;
            $p->direccion = $faker->address;
            $p->telefono = random_int(6000,7999).'-'.random_int(0,9999);
            $p->sexo = $s;
            $p->fechaNacimiento = $faker->date($format = 'Y-m-d', $max = '2018-06-01');
            $p->dui =random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).'-'.random_int(0,9);
            $p->pais = null;
            $p->departamento = 'San Vicente';
            $p->municipio = 'San Lorenzo';
            $p->alergia=null;
            $p->estado=1;
            $p->save();
        }

    }
}