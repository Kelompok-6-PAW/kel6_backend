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
                    'email' => 'tubespawkel6@gmail.com',
                    'password' => '$2b$10$m3TJIjRkcvvDMm/HxurQaOEUkjZtjNjhIQO7Lb9f6R2GOjFcdD3ym',//bisaselesai123
                    'jenisKelamin' => 'Pria',
                    'tglLahir' => '2001-04-10',
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]);
    }
}
