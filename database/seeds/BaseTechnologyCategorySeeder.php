<?php

use Illuminate\Database\Seeder;
use App\Models\BaseTechnologyCategory;

class BaseTechnologyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Công nghệ thông tin và truyền thông', 'Công nghệ sinh học',
            'Công nghệ vật liệu mới', 'Công nghệ chế tạo máy - tự động hóa',
            'Công nghệ môi trường', 'Công nghệ năng lượng mới', 'Công nghệ vũ trụ',
            'Công nghệ khác'
        ];
        foreach ($names as $name) {
            BaseTechnologyCategory::create(['name' => $name, 'normalize' => strNormalize($name)]);
        }
    }
}
