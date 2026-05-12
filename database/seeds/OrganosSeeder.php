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
        $nombres = ['PULMONES','HUESO','CORAZON','CORNEAS','RIÑON','VALVULAS','PIEL','PANCREAS','TENDONES','HIGADO'];
        foreach ($nombres as $nombre) {
            Organo::create(['nombre' => $nombre]);
        }
    }
}
