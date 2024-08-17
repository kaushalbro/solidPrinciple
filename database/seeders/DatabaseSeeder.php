<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [];

        for ($i = 100010; $i < 2000000; $i++) {
            $users= [
                'name' => 'name_' . $i,
                'email' => 'official.cyberbar11+' . $i . '@gmail.com',
                'email_verified_at' => null,
                'password' =>'$2y$10$u53dA8KZ/dF72AqKh8461OLOQMx5XdPyJOvHJWoyszDrtFmU7PPja',
                'remember_token' => Str::random(32),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 1,
                'super_admin' => 0,
            ];
            DB::table('users')->insert($users);
        }
        try {
//            DB::table('users')->updateOrInsert($users);
        }catch (\Exception $exception){
            dd($exception);
        }

        // \App\Models\User::factory(10)->create();
    }
}
