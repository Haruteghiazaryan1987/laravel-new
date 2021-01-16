<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
// use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name'=>'Autor Anknown',
                'email'=>'autor_anknown@g.g',
                'password'=>bcrypt(Str::random(16)),
            ],
            [
                'name'=>'Autor',
                'email'=>'autor1@g.g',
                'password'=>bcrypt('123123'),
            ],
        ];

        \DB::table('users')->insert($data);
    }
}
