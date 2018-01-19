<?php

use Illuminate\Database\Seeder;
use App\Models\TechnologyCategory;
use App\Models\Specialization;

class TechnologyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Khoa học tự nhiên', 'khoa học kĩ thuật và công nghệ',
            'khoa học y - dược', 'Khoa học nông nghiệp',
            'Khoa học xã hội', 'Khoa học nhân văn'
        ];
        $specializations = [
            [
                'Toán học', 'Tin học', 'Vật lý', 'Hóa học',
                'Khoa học trái đất', 'Y sinh', 'Cơ học', 'Nông nghiệp'
            ],
            [
                'Kỹ thuật dân dụng', 'Kỹ thuật điện, kỹ thuật điện tử, kỹ thuật thông tin',
                'Kỹ thuật cơ khí', 'Kỹ thuật hóa học', 'Kỹ thuật vật liệu và luyện kim',
                'Kỹ thuật y học', 'Kỹ thuật môi trường', 'Công nghệ sinh học môi trường',
                'Công nghệ sinh học công nghiệp', 'Công nghệ nano',
                'Kỹ thuật thực phẩm và đồ uống', 'Khoa học kỹ thuật và công nghệ khác'
            ],
            [
                'Y học cơ sở', 'Y học lâm sàng', 'Y tế', 'Dược học',
                'Công nghệ sinh học trong y học', 'Khoa học y, dược khác'
            ],
            [
                'Trồng trọt', 'Chăn nuôi', 'Thú y', 'Lâm nghiệp', 'Thuỷ sản',
                'Công nghệ sinh học trong nông nghiệp', 'Khoa học nông nghiệp khác'
            ],
            [
                'Tâm lý học', 'Kinh tế và kinh doanh', 'Khoa học giáo dục', 'Xã hội học',
                'Pháp luật', 'Khoa học chính trị', 'Địa lý kinh tế và xã hội',
                'Thông tin đại chúng và truyền thông', 'Khoa học xã hội khác'
            ],
            [
                'Lịch sử và khảo cổ học', 'Ngôn ngữ học và văn học', 'Triết học, đạo đức học và tôn giáo',
                'Nghệ thuật', 'Khoa học nhân văn khác'
            ],
        ];
        foreach ($names as $key => $name) {
            $tech = TechnologyCategory::create(['name' => $name, 'normalize' => strNormalize($name)]);
            foreach ($specializations[$key] as $specialization) {
                Specialization::create([
                    'name' => $specialization,
                    'technology_category_id' => $tech->id,
                    'normalize' => strNormalize($specialization)
                ]);
            }
        }
    }
}
