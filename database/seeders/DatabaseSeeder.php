<?php

namespace Database\Seeders;
use \App\Models\User;
use \App\Models\role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'bbison2002@gmail.com',
            'password' => bcrypt('Fuka_Wata123'),
        ]);
        role::create(['name'=> 'Administrator']);
        role::create(['name'=> 'kurikulum']);
        role::create(['name'=> 'Kesiswaan']);
        role::create(['name'=> 'Sarpras']);
        role::create(['name'=> 'Humas']);
        role::create(['name'=> 'Bendahara']);
        role::create(['name'=> 'PKB']);
        role::create(['name'=> 'PKG']);
        role::create(['name'=> 'Tata Usaha']);
        role::create(['name'=> 'Administrasi']);
        role::create(['name'=> 'Asset']);
        role::create(['name'=> 'Assesment']);
        role::create(['name'=> 'Super Visi']);
        role::create(['name'=> 'Kewirausahaan']);
        role::create(['name'=> 'Projek P5']);
        role::create(['name'=> 'PSB']);
        role::create(['name'=> 'BK']);
    }
}
