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
            ['tipo' => 'Ocupacion', 'valor' => 'TAREAS DEL HOGAR', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'ESTUDIANTE', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'ARTESANA(O), OBRERA(O), TRABAJADOR(A)', 'hist_valor' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'EMPLEADA(O) DE OFICINA, TRABAJADOR(A) EN ACTIVIDADES ADMINISTRATIVAS O DE SERVICIOS', 'hist_valor' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'COMERCIANTE O EMPLEADA(O) DE COMERCIO', 'hist_valor' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'JUBILADA(O) / PENSIONADA(O)', 'hist_valor' => '17', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) EN ACTIVIDADES AGRICOLAS', 'hist_valor' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) EN SERVICIOS DOMESTICOS', 'hist_valor' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'VENDEDOR(A) AMBULANTE', 'hist_valor' => '8', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'CONDUCTOR(A) DE MEDIO DE TRANSPORTE', 'hist_valor' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) EN SERVICIOS DE SEGURIDAD Y/O FUERZAS ARMADAS', 'hist_valor' => '11', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'MAESTRA(O), DOCENTE O TRABAJADOR(A) DE LA EDUCACION', 'hist_valor' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'PROFESIONISTA O TECNICA(O) INDEPENDIENTE', 'hist_valor' => '13', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'LIDER O DIRECTIVA DEL SECTOR SOCIAL O CIVIL', 'hist_valor' => '14', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'FUNCIONARIA(O) DEL SECTOR PUBLICO', 'hist_valor' => '15', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'EMPRESARIA(O), GERENTE O DIRECTIVA(O) DE EMPRESA', 'hist_valor' => '16', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'TRABAJADOR(A) POR CUENTA PROPIA', 'hist_valor' => '9', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'DESEMPLEADA(O) / BUSCADOR(A) DE TRABAJO', 'hist_valor' => '18', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'OTRO', 'hist_valor' => '19', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Ocupacion', 'valor' => 'NO SABE', 'hist_valor' => '99', 'created_at' => now(), 'updated_at' => now()],

                // Estado Civil 'hist_valor' => '',
            ['tipo' => 'EstCiv', 'valor' => 'SOLTERO', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'CASADO', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'VIUDO', 'hist_valor' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'UNION LIBRE', 'hist_valor' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'DIVORCIADO', 'hist_valor' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'EstCiv', 'valor' => 'NO SABE', 'hist_valor' => '99', 'created_at' => now(), 'updated_at' => now()],

                //Estudios
            ['tipo' => 'Estudios', 'valor' => 'NINGUNO', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PREESCOLAR', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PRIMARIA', 'hist_valor' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PRIMARIA INCOMPLETA', 'hist_valor' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'SECUNDARIA', 'hist_valor' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'SECUNDARIA INCOMPLETA', 'hist_valor' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PREPARATORIA O BACHILLERATO', 'hist_valor' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PREPARATORIA INCOMPLETA', 'hist_valor' => '8', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'NORMAL', 'hist_valor' => '9', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'CARRERA TÉCNICA / COMERCIAL', 'hist_valor' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'PROFESIONAL', 'hist_valor' => '11', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'MAESTRÍA / DOCTORADO', 'hist_valor' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Estudios', 'valor' => 'NO SABE / SIN RESPUESTA', 'hist_valor' => '99', 'created_at' => now(), 'updated_at' => now()],
            
                //Religión
            ['tipo' => 'Religion', 'valor' => 'CATÓLICA', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'JUDÍA', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'CRISTIANA', 'hist_valor' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'TESTIGO DE JEHOVÁ', 'hist_valor' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'EVANGELISTA', 'hist_valor' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'NINGUNA', 'hist_valor' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Religion', 'valor' => 'OTRO', 'hist_valor' => '', 'created_at' => now(), 'updated_at' => now()],
            
                //Sexo
            ['tipo' => 'Sexo', 'valor' => 'HOMBRE', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Sexo', 'valor' => 'MUJER', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Sexo', 'valor' => 'OTRO', 'hist_valor' => '', 'created_at' => now(), 'updated_at' => now()],

                //Pregunta de seguridad
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE TU MASCOTA?', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE ALGUNA NOVIA?', 'hist_valor' => '11', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿MARCA PREFERIDA DE ROPA?', 'hist_valor' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿FECHA MÁS IMPORTANTE DE TU VIDA?', 'hist_valor' => '14', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿CANCIÓN PREFERIDA?', 'hist_valor' => '9', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿QUIÉN FUE TU PRIMER NOVIO(A)?', 'hist_valor' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE LA PRIMARIA EN LA QUE ESTUDIASTE?', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿MEJOR AMIGO DE LA INFANCIA?', 'hist_valor' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE COMPLETO DE LA MADRE?', 'hist_valor' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿LUGAR DE NACIMIENTO DE LA MADRE?', 'hist_valor' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿LUGAR DE NACIMIENTO DEL PADRE?', 'hist_valor' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿NOMBRE DE TU PRIMERA MASCOTA?', 'hist_valor' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Pregunta', 'valor' => '¿CUÁL ERA TU APODO DE NIÑO?', 'hist_valor' => '8', 'created_at' => now(), 'updated_at' => now()],
            
                //Tipo de donación
            ['tipo' => 'Tipo', 'valor' => 'AMPLIA', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Tipo', 'valor' => 'LIMITADA', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'Tipo', 'valor' => 'NINGUNA', 'hist_valor' => '3', 'created_at' => now(), 'updated_at' => now()],

                //Tipo de Órgano -> Es para el mapeo
            ['tipo' => 'TipoOrg', 'valor' => 'ÓRGANO', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'TipoOrg', 'valor' => 'TEJIDO', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],

                //Estatus del histórico Linea de Captura
            ['tipo' => 'status', 'valor' => 'GENERADA', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'status', 'valor' => 'PAGADA', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],

                //Estatus User
            ['tipo' => 'statusUser', 'valor' => 'ACTIVO', 'hist_valor' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['tipo' => 'statusUser', 'valor' => 'INACTIVO', 'hist_valor' => '2', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('catalogos')->insert($datos);
    }
}
