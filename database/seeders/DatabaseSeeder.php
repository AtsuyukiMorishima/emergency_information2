<?php

namespace Database\Seeders;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
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
        EmergencyEvent::factory(5)->create();
        SiteUrl::factory(15)->create();
        User::factory()->create();
    }
}
