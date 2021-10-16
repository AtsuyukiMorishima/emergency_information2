<?php

namespace Database\Seeders;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
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
        EmergencyEvent::factory(5)->create();
        SiteUrl::factory(15)->create();
    }
}
