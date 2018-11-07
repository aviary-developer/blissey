<?php

use Illuminate\Database\Seeder;
use App\Especialidad;
use App\User;

class LlenarUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades=[
            'Alergología','Cardiología','Gastroenterología','Geriatría','Infectología',
            'Nefrología','Neumología','Neurología','Nutriología','Oftalmología',
            'Oncología','Pediatría','Psiquiatría','Urología','Otorrinolaringología',
            'Urología','Obstetricia'];
            foreach ($especialidades as $key => $e) {
                $esp= new Especialidad();
                $esp->nombre=$e;
                $esp->save();
            }
        $u=new User();
        $u->name="Farmacia";
        $u->email="ngrd94@gmail.com";
        $u->password=bcrypt("ngrd94@gmail.com");
        $u->nombre="Ingrid María";
        $u->apellido="Ayala Morales";
        $u->direccion="Final avenidad 14 de Julio Barrio Guadalupe";
        $u->fechaNacimiento="1994-07-14";
        $u->dui="32454354-5";
        $u->sexo=0;
        $u->juntaVigilancia="466655644";
        $u->estado=1;
        $u->firma="noImgen.jpg";
        $u->sello="noImgen.jpg";
        $u->foto="noImgen.jpg";
        $u->administrador=1;
        $u->tipoUsuario="Farmacia";
        $u->save();

        $u=new User();
        $u->name="Recepcion";
        $u->email="recepcion@gmail.com";
        $u->password=bcrypt("recepcion@gmail.com");
        $u->nombre="Carlos René";
        $u->apellido="Ruiz Morazán";
        $u->direccion="Avenida Cayetano Molina Quiroz";
        $u->fechaNacimiento="1993-09-3";
        $u->dui="32434353-6";
        $u->sexo=1;
        $u->juntaVigilancia="4637555663";
        $u->estado=1;
        $u->firma="noImgen.jpg";
        $u->sello="noImgen.jpg";
        $u->foto="noImgen.jpg";
        $u->administrador=1;
        $u->tipoUsuario="Recepción";
        $u->save();

        $u=new User();
        $u->name="LabClinico";
        $u->email="clinico@gmail.com";
        $u->password=bcrypt("clinico@gmail.com");
        $u->nombre="Alejandro Antonio";
        $u->apellido="Henríquez Merino";
        $u->direccion="Calle Dr. Manuel Pacas, 7a avenida sur";
        $u->fechaNacimiento="1994-02-17";
        $u->dui="32434367-0";
        $u->sexo=1;
        $u->juntaVigilancia="4637559893";
        $u->estado=1;
        $u->firma="noImgen.jpg";
        $u->sello="noImgen.jpg";
        $u->foto="noImgen.jpg";
        $u->administrador=1;
        $u->tipoUsuario="Laboratorio Clínico";
        $u->save();
    }
}