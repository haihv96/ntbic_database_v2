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
        $this->call(ProvinceSeeder::class);
        $this->call(AcademicTitleSeeder::class);
        $this->call(TechnologyCategorySeeder::class);
        $this->call(BaseTechnologyCategorySeeder::class);
        $this->call(PatentTypeSeeder::class);
    }
}
