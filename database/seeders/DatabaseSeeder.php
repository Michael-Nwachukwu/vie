<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\listings;
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
        // this guy creates 10 users 
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'John Doe', 
            'email' => 'john@gmail.com'
        ]);

        Listings::factory(8)->create([
            'user_id' => $user->id 
        ]);
        
        // listings::create([
        //     'title' => 'Unity Developer', 
        //     'tags' => 'game, c#', 
        //     'company' => 'Ubisoft', 
        //     'location' => 'Dallas, Texas', 
        //     'email' => 'wonderful@gmail.com', 
        //     'website' => 'random.com', 
        //     'description' => 'Hello World'
        // ]);



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
