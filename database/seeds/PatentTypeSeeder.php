<?php

use Illuminate\Database\Seeder;
use App\Models\PatentType;

class PatentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Lựa chọn', 'Sáng chế', 'Phát minh', 'Giải pháp hữu ích', 'Khác'
        ];
        foreach ($names as $name) {
            PatentType::create(['name' => $name, 'normalize' => strNormalize($name)]);
        }
    }
}
