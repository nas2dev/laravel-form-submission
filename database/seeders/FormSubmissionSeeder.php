<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formSubmissions = [
            [
                'user_id' => 1,
                'name' => 'John Doe',
                'email' => 'john@doe.com',
                'message' => 'Hello, this is a test message',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Jane Doe',
                'email' => 'jane@doe.com',
                'message' => 'Hello, this is another test message!!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'name' => 'Jim Beam',
                'email' => 'jim@beam.com',
                'message' => 'Hello, this is a third test message!!!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('form_submissions')->insert($formSubmissions);
    }
}
