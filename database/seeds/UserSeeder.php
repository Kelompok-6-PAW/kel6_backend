<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
                ->insert([
                    'username' =>'Admin',
                    'email' => 'tubespaw6@admin.com',
                    'password' => '$2b$10$kmXx9PGzlPucwwiiypx/6.DHzSJOsfSL3hCy8OITjM.217fH9AfE6',//tubespaw6
                    'jenisKelamin' => 'Pria',
                    'tglLahir' => '2001-04-10',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]);
    }
}
