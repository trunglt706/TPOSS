<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\BusinessType;

class SeedBusinessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed business type
        BusinessType::truncate();
        BusinessType::create([
            'name' => 'Quán cà phê',
            'description' => 'Quản lý quán từ xa tiện lợi, tính tiền nhanh',
        ]);
        BusinessType::create([
            'name' => 'Quán ăn',
            'description' => 'Tận dụng được mọi thiết bị sẵn có, giao diện đơn giản, dễ dùng',
        ]);
        BusinessType::create([
            'name' => 'Trà sữa',
            'description' => 'Định lượng đường đá, topping, in tem nhãn, hóa đơn bán hàng',
        ]);
        BusinessType::create([
            'name' => 'Bar - Pub',
            'description' => 'Hạn chế tối đa tình trạng gian lận, phân quyền chi tiết',
        ]);
        BusinessType::create([
            'name' => 'Karaoke - Billard',
            'description' => 'Quản lý phòng hát/bàn trống, đặt lịch, tính tiền theo giờ',
        ]);
        BusinessType::create([
            'name' => 'Nhà hàng',
            'description' => 'Hoạt động ổn định dù mất kết nối Internet hoặc nhiều thiết bị truy cập đồng thời',
        ]);
        BusinessType::create([
            'name' => 'Đồ ăn nhanh',
            'description' => 'Quản lý quán từ xa tiện lợi, tính tiền nhanh chính xác',
        ]);
    }
}
