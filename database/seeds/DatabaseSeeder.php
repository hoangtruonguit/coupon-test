<?php

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
         factory(App\Member::class, 1000)->create();
         factory(App\Coupon::class, 1000)->create();
         factory(App\MemberCoupon::class, 1000)->create();

    }
}
