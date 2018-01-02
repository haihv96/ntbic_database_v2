<?php

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['An Giang', 'Bà Rịa - Vũng Tàu', 'Bắc Giang', 'Bắc Kạn',
            'Bạc Liêu', 'Bắc Ninh', 'Bến Tre', 'Bình Dương', 'Bình Phước',
            'Bình Thuận', 'Bình Định', 'Cà Mau', 'Cần Thơ', 'Cao Bằng', 'Cửu Long',
            'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Nội', 'Hà Tĩnh', 'Hải Dương',
            'Hải Phòng', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa',
            'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng', 'Lạng Sơn',
            'Lào Cai', 'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình',
            'Ninh Thuận', 'Phú Thọ', 'Phú Yên', 'Quảng Bình', 'Quảng Nam',
            'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La',
            'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thừa Thiên Huế',
            'Tiền Giang', 'TP. HCM', 'TP. Nha trang', 'Trà Vinh', 'Tuyên Quang',
            'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái', 'Đà Nẵng', 'Đắk Lắc',
            'Đắk Nông', 'Điện Biên', 'Đồng Nai', 'Đồng Tháp'];
        foreach ($names as $name) {
            Province::create(['name' => $name]);
        }
    }
}
