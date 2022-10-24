<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\Table;
use App\Models\TableOrder;
use App\Models\TableOrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Demo User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);


        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'name' => 'T' . $i,
                'seats' => random_int(4, 10),
            ]);
        }


        $data = json_decode(file_get_contents(__DIR__ . '/food.json'));
        foreach ($data as $item) {

            $category = Category::firstOrCreate([
                'slug' => \Illuminate\Support\Str::slug($item->category),
                'name' => $item->category
            ]);

            $item = Item::create([
                'name' => $item->name,
                'category_id' => $category->id,
                'price' => (float) $item->price,
            ]);
        }
    }
}
