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
        DB::table('usuarios')->insert([
            'id'            => '1',
            'name'          => 'Juan Tovar',
            'username'      => 'tovarjc66',
            'email'         => 'tovarjc66@gmail.com',
            'password'      => bcrypt('123456'),
            'rol'           => 1,
            'path'          => 'JuanTovar.jpg',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
    }
}
