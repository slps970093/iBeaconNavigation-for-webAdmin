<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserEloquent::create([
            'username' => 'admin',
            'password' => Hash::make('secret'),
            'name' => 'System Admin',
            'email' => 'admin@admin.com'
        ]);
    }
}
