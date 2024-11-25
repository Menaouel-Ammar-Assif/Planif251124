<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // 1
            [
                'name'=> 'one',
                'matricule'=> '230674', 
                'password'=> hash::make('111'),
                'email'=> 'one@gmail.com',
               
            ],
            // 2
            [
                'name'=> 'two',
                'matricule'=> '230673',
                'password'=> hash::make('111'),
                'email'=> 'two@gmail.com',
                
            ],            
            // 3
            [
                'name'=> 'three',
                'matricule'=> '230693',
                'password'=> hash::make('111'),
                'email'=> 'three@gmail.com',
                
            ],            
            // 4
            [
                'name'=> 'four',
                'matricule'=> '000000',
                'password'=> hash::make('111'),
                'email'=> 'four@gmail.com',
                
            ],            
            // 5
            [
                'name'=> 'five',
                'matricule'=> '111111',
                'password'=> hash::make('111'),
                'email'=> 'five@gmail.com',
                
            ],            
            // 6
            [
                'name'=> 'Y',
                'matricule'=> '222222',
                'password'=> hash::make('111'),
                'email'=> 'Y@gmail.com',
                
            ],                     
            ]);
    }
}
