<?php


use Illuminate\Database\Seeder;
use App\Coupone;

class CouponesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupone::create([
          'code' => 'aaaaa',
          'type' => 'fixed',
          'value' => 30,
        ]);

        Coupone::create([
          'code' => 'sssss',
          'type' => 'percent',
          'percent_off' => 50,
        ]);
    }
}
