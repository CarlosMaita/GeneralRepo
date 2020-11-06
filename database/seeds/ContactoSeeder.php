<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contactos')->insert([
        	'info' => 'email',
        	'valor' => 'email@test.com',
        ]);

        DB::table('contactos')->insert([
        	'info' => 'direccion',
        	'valor' => 'direccion de ejemplo',
        ]);

        DB::table('contactos')->insert([
        	'info' => 'phone',
        	'valor' => '031203020',
        ]);

        DB::table('contactos')->insert([
        	'info' => 'facebook',
        	'valor' => '@facebook',
        ]);

        DB::table('contactos')->insert([
        	'info' => 'instagram',
        	'valor' => '@instagram',
        ]);
    }
}
