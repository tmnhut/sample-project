<?php

use App\Widget;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Widget::unguard();
        Widget::truncate();
        factory(Widget::class, 30)->create();
        Widget::reguard();
    }
}
