<?php

namespace Database\Seeders;

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
        \DB::table('users')->insert([
            'email' => 'admin@admin.it',
            'password' => \Hash::make('admin'),
            'nome' => 'Admin',
            'cognome' => 'Admin',
            'is_admin' => '1'
        ]);

        \DB::table('users')->insert([
            'email' => 'franco@azienda.it',
            'password' => \Hash::make('semplice'),
            'nome' => 'Franco',
            'cognome' => 'Rossi',
            'is_admin' => '0'
        ]);
    }
}
