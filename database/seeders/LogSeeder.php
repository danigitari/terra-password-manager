<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\log;
use Carbon\Carbon;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        log::create([
            'user_id' => 1,
            'last_login' => Carbon::now(),
            'all_logins' => [Carbon::now(), Carbon::now()],
            'last_credential_copied' => "",
            'all_credentials_copied' => "",

        ]);

       }
}
