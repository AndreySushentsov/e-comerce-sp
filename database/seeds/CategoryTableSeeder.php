<?php

use Carbon\Carbon;
use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = Carbon::now()->toDateTimeString();
        Category::insert([
          ['name'=> 'BCAA', 'slug'=> 'bcaa', 'created_at' => $now, 'updated_at' => $now],
          ['name'=> 'Протеин', 'slug'=> 'protein', 'created_at' => $now, 'updated_at' => $now],
          ['name'=> 'Витамины', 'slug'=> 'vitaminy', 'created_at' => $now, 'updated_at' => $now],
          ['name'=> 'L-Carnetine', 'slug'=> 'l-carnetine', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
