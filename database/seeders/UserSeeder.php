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
            'email' => 'mariorossi@admin.it',
            'password' => \Hash::make('admin'),
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'is_admin' => '1'
        ]);

        \DB::table('users')->insert([
            'email' => 'mariabianchi@dipendente.it',
            'password' => \Hash::make('dipendente'),
            'nome' => 'Maria',
            'cognome' => 'Bianchi',
            'is_admin' => '0'
        ]);
    }
}
