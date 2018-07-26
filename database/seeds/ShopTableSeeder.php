<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop')->insert([
            'name' => 'Mylife Coffee Bến Bạch Đằng, Quận 1',
            'phone' => '028.36201553',
            'address' => 'Bến Bạch Đằng',
            'district' => 'Quận 1',
            'lat' => '10.7721907',
            'lng' => '106.7065245',
            'image' => 'http://mylifecoffee.vn/storage/stores/December2017/9RYuHcKISmnc9ntr46Pe.jpg',
            'type' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'Mylife Coffee Công viên Lê Lai, Quận 1',
            'phone' => '028.66539005',
            'address' => 'Công viên Lê Lai',
            'district' => 'Quận 1',
            'lat' => '10.7684613',
            'lng' => '106.6897036',
            'image' => 'http://mylifecoffee.vn/storage/stores/December2017/fKnHaT403YeDMR2d3aq4.jpg',
            'type' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'Mylife Coffee Lê Duẩn',
            'phone' => '028.38256756',
            'address' => '2B Lê Duẩn',
            'district' => 'Quận 1',
            'lat' => '10.7833371',
            'lng' => '106.7012455',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/xqWtcMKGZIghx5WsA07D.jpg',
            'type' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'Mylife Coffee Trần Hưng Đạo',
            'phone' => '028.38364514',
            'address' => '257 Trần Hưng Đạo',
            'district' => 'Quận 1',
            'lat' => '10.7642871',
            'lng' => '106.6900962',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/qgzT3kPCkbPZWBRdCCdT.JPG',
            'type' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'Mylife Coffee Nguyễn Cư Trinh',
            'phone' => '028.38360673',
            'address' => '160 Nguyễn Cư Trinh',
            'district' => 'Quận 1',
            'lat' => '10.7635063',
            'lng' => '106.6865163',
            'image' => 'http://mylifecoffee.vn/storage/stores/December2017/t2UfZzx7GojuUo2xZuVE.jpg',
            'type' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'Mylife Coffee Trương Định',
            'phone' => '028.39301690',
            'address' => '22A Trương Định',
            'district' => 'Quận 3',
            'lat' => '10.77815',
            'lng' => '106.6872802',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/pz7UAZplAlXdopTKI7Ma.JPG',
            'type' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'YEN SUSHI & SAKE PUB 1',
            'phone' => '028.39330167',
            'address' => '15A Lê Quý Đôn, P.6',
            'district' => 'Quận 3',
            'lat' => '10.7804016',
            'lng' => '106.6909334',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/pz7UAZplAlXdopTKI7Ma.JPG',
            'type' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'YEN SUSHI & SAKE PUB 2',
            'phone' => '028.38218586',
            'address' => '92 Nam Kì Khởi Nghĩa',
            'district' => 'Quận 1',
            'lat' => '10.7721217',
            'lng' => '106.700688',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/pz7UAZplAlXdopTKI7Ma.JPG',
            'type' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'YEN SUSHI & SAKE PUB 3',
            'phone' => '028.54125316',
            'address' => '185 Nguyễn Đức Cảnh',
            'district' => 'Quận 7',
            'lat' => '10.7215033',
            'lng' => '106.712027',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/pz7UAZplAlXdopTKI7Ma.JPG',
            'type' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'YEN SUSHI & SAKE PUB 4',
            'phone' => '028.36368688',
            'address' => '8 Đồng Khởi, P. Bến Nghé',
            'district' => 'Quận 1',
            'lat' => '10.774157',
            'lng' => '106.7055903',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/pz7UAZplAlXdopTKI7Ma.JPG',
            'type' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);

        DB::table('shop')->insert([
            'name' => 'YEN SUSHI PREMIUM',
            'phone' => '028.39318828',
            'address' => '123 Bà Huyện Thanh Quan',
            'district' => 'Quận 3',
            'lat' => '10.7812011',
            'lng' => '106.682003',
            'image' => 'http://mylifecoffee.vn/storage/stores/September2017/pz7UAZplAlXdopTKI7Ma.JPG',
            'type' => 3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'openTime' => '{"mon-friday":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}],"weekend":[{"start":"10:30","end":"14:00"},{"start":"17:00","end":"22:00"}]}'
        ]);
    }
}
