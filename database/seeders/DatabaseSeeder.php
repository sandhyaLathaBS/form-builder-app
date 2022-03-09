<?php

namespace Database\Seeders;

use App\Models\InputFormTypes;
use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);

        InputFormTypes::insert([
            ['field' => 'Text', 'type' => 'text', 'choice' => 0, 'component' => 'text'],
            ['field' => 'Email', 'type' => 'email', 'choice' => 0, 'component' => 'email'],
            ['field' => 'Url', 'type' => 'url', 'choice' => 0, 'component' => 'url'],
            ['field' => 'Tel', 'type' => 'tel', 'choice' => 0, 'component' => 'tel'],
            ['field' => 'Number', 'type' => 'number', 'choice' => 0, 'component' => 'number'],
            ['field' => 'date', 'type' => 'date', 'choice' => 0, 'component' => 'date'],
            ['field' => 'Password', 'type' => 'password', 'choice' => 0, 'component' => 'password'],
            ['field' => 'File', 'type' => 'file', 'choice' => 0, 'component' => 'file'],
            ['field' => 'Select', 'type' => 'select', 'choice' => 1, 'component' => 'select'],
            ['field' => 'CheckBox', 'type' => 'checkbox', 'choice' => 1,  'component' => 'check-box'],
            ['field' => 'Radio', 'type' => 'radio', 'choice' => 1, 'component' => 'radio']
        ]);
    }
}