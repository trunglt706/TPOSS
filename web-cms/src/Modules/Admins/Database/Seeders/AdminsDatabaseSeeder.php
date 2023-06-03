<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Entities\AdminGroup;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\Area;
use Modules\Admins\Entities\BusinessType;

class AdminsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed group
        AdminGroup::truncate();
        $group = AdminGroup::create([
            'name' => 'Quản trị viên',
            'description' => 'Có toàn quyền',
            'status' => AdminGroup::STATUS_ACTIVE,
            'order' => 0,
            'created_by' => 1
        ]);

        // seed admin
        Admins::truncate();
        Admins::create([
            'name' => 'Super admin',
            'email' => 'tpos_admin@gmail.com',
            'phone' => '0909000999',
            'group_id' => $group->id,
            'status' => Admins::STATUS_ACTIVE,
            'root' => Admins::IS_ROOT,
            'supper' => Admins::IS_SUPPER,
        ]);

        // seed area
        Area::truncate();
        Area::create([
            'name' => 'Miền Bắc',
        ]);
        Area::create([
            'name' => 'Miền Trung',
        ]);
        Area::create([
            'name' => 'Miền Nam',
        ]);

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
