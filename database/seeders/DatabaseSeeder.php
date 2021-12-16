<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SessionApp;
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
        // \App\Models\User::factory(10)->create();
        School::factory(1)->create();
        SessionApp::factory(1)->create();
    }
}
