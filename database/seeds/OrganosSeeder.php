<?php

use Illuminate\Database\Seeder;
use App\Organo;

class OrganosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $organos = ['RIÑÓN','PULMONES','PÁNCREAS','HÍGADO','CORAZÓN','CORNEAS','PIEL','TENDONES','VÁLVULAS','HUESO'];
        // foreach ($organos as $organo) {
        //     Organo::create(['organo' => $organo]);
        // }
        Organo::create([
            'id_organo' => '1',
            'organo' => 'RIÑÓN',
            'id_tipo_organo' => '1'
        ]);
        Organo::create([
            'id_organo' => '2',
            'organo' => 'PULMONES',
            'id_tipo_organo' => '1'
        ]);
        Organo::create([
            'id_organo' => '3',
            'organo' => 'PÁNCREAS',
            'id_tipo_organo' => '1'
        ]);
        Organo::create([
            'id_organo' => '4',
            'organo' => 'HÍGADO',
            'id_tipo_organo' => '1'
        ]);
        Organo::create([
            'id_organo' => '5',
            'organo' => 'CORAZÓN',
            'id_tipo_organo' => '1'
        ]);
        Organo::create([
            'id_organo' => '6',
            'organo' => 'CORNEAS',
            'id_tipo_organo' => '2'
        ]);
        Organo::create([
            'id_organo' => '7',
            'organo' => 'PIEL',
            'id_tipo_organo' => '2'
        ]);
        Organo::create([
            'id_organo' => '8',
            'organo' => 'TENDONES',
            'id_tipo_organo' => '2'
        ]);
        Organo::create([
            'id_organo' => '9',
            'organo' => 'VÁLVULAS',
            'id_tipo_organo' => '2'
        ]);
        Organo::create([
            'id_organo' => '10',
            'organo' => 'HUESO',
            'id_tipo_organo' => '2'
        ]);
    }
}
