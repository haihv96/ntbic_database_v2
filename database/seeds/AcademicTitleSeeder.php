<?php

use Illuminate\Database\Seeder;
use App\Models\AcademicTitle;

class AcademicTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['GS', 'GS.TSKH', 'GS.TS', 'PGS', 'PGS.TSKH', 'PGS.TS',
            'TSKH', 'TS', 'NCS', 'Ths', 'CN', 'KS'];

        foreach ($names as $name) {
            AcademicTitle::create(['name' => $name]);
        }
    }
}
