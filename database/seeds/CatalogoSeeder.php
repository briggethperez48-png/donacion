<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogos')->truncate();

        $datos = [
                //Donadores
            
            // Ocupación
            ['tipo' => 'Ocupacion', 'valor' => 'TAREAS DEL HOGAR', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'ESTUDIANTE', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'ARTESANA(O), OBRERA(O), TRABAJADOR(A)', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'EMPLEADA(O) DE OFICINA, TRABAJADOR(A) EN ACTIVIDADES ADMINISTRATIVAS O DE SERVICIOS', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'COMERCIANTE O EMPLEADA(O) DE COMERCIO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'JUBILADA(O) / PENSIONADA(O)', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) EN ACTIVIDADES AGRICOLAS', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) EN SERVICIOS DOMESTICOS', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'VENDEDOR(A) AMBULANTE', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'CONDUCTOR(A) DE MEDIO DE TRANSPORTE', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) EN SERVICIOS DE SEGURIDAD Y/O FUERZAS ARMADAS', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'MAESTRA(O), DOCENTE O TRABAJADOR(A) DE LA EDUCACION', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'PROFESIONISTA O TECNICA(O) INDEPENDIENTE', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'LIDER O DIRECTIVA DEL SECTOR SOCIAL O CIVIL', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'FUNCIONARIA(O) DEL SECTOR PUBLICO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'EMPRESARIA(O), GERENTE O DIRECTIVA(O) DE EMPRESA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) POR CUENTA PROPIA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'DESEMPLEADA(O) / BUSCADOR(A) DE TRABAJO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'OTRO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'NO SABE', 'created_at' => now(), 'updated_at' => now()],

                // Estado Civil
            ['tipo' => 'EstCiv', 'valor' => 'SOLTERO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'CASADO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'VIUDO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'UNION LIBRE', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'DIVORCIADO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'NO SABE', 'created_at' => now(), 'updated_at' => now()],

                //Estudios
            ['tipo' => 'Estudios', 'valor' => 'NINGUNO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PREESCOLAR', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PRIMARIA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PRIMARIA INCOMPLETA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'SECUNDARIA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'SECUNDARIA INCOMPLETA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PREPARATORIA O BACHILLERATO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PREPARATORIA INCOMPLETA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'NORMAL', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'CARRERA TÉCNICA / COMERCIAL', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PROFESIONAL', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'MAESTRÍA / DOCTORADO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'NO SABE / SIN RESPUESTA', 'created_at' => now(), 'updated_at' => now()],
            
                //Religión
            ['tipo' => 'Religion', 'valor' => 'CATÓLICA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'JUDÍA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'CRISTIANA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'TESTIGO DE JEHOVÁ', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'EVANGELISTA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'NINGUNA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'OTRO', 'created_at' => now(), 'updated_at' => now()],
            
                //Sexo
            ['tipo' => 'Sexo', 'valor' => 'HOMBRE', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Sexo', 'valor' => 'MUJER', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Sexo', 'valor' => 'OTRO', 'created_at' => now(), 'updated_at' => now()],

                //Pregunta de seguridad
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE TU MASCOTA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE ALGUNA NOVIA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿MARCA PREFERIDA DE ROPA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿FECHA MÁS IMPORTANTE DE TU VIDA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿CANCIÓN PREFERIDA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿QUIÉN FUE TU PRIMER NOVIO(A)?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE LA PRIMARIA EN LA QUE ESTUDIASTE?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿MEJOR AMIGO DE LA INFANCIA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE COMPLETO DE LA MADRE?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿LUGAR DE NACIMIENTO DE LA MADRE?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿LUGAR DE NACIMIENTO DEL PADRE?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE TU PRIMERA MASCOTA?', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿CUÁL ERA TU APODO DE NIÑO?', 'created_at' => now(), 'updated_at' => now()],
            
                //Tipo de donación
            ['tipo' => 'Tipo', 'valor' => 'AMPLIA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Tipo', 'valor' => 'LIMITADA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Tipo', 'valor' => 'NINGUNA', 'created_at' => now(), 'updated_at' => now()],

                //Tipo de Órgano -> Es para el mapeo
            ['tipo' => 'TipoOrg', 'valor' => 'ÓRGANO', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'TipoOrg', 'valor' => 'TEJIDO', 'created_at' => now(), 'updated_at' => now()],

                //Estatus del histórico Linea de Captura
            ['tipo' => 'status', 'valor' => 'GENERADA', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'status', 'valor' => 'PAGADA', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('catalogos')->insert($datos);
    }
}
