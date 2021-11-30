<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Inventroy,
    Product,
    Role,
    Grant
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
            "name" => "admin"
        ]);

        $productRole = Role::create([
            "name" => "product"
        ]);

        $inventoryRole = Role::create([
            "name" => "inventory"
        ]);


        // Admin
        $admin = User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => \Hash::make("12345678")
        ]);

        $admin->grants()->create([    
            "role_id" => $adminRole->id
        ]);


        // Inventory 1
        $inventory = User::create([
            "name" => "inventory",
            "email" => "inventory@gmail.com",
            "password" => \Hash::make("12345678")
        ]);

        $inventory->grants()->create([    
            "role_id" => $inventoryRole->id
        ]);

        $inventory->inventorys()->create([
            "name" => "inventroy1"
        ]);
           
        $inventory->inventorys()->create([
            "name" => "inventroy2"
        ]);

         // Inventory 2
         $inventory2 = User::create([
            "name" => "inventory2",
            "email" => "inventory2@gmail.com",
            "password" => \Hash::make("12345678")
        ]);

        $inventory2->grants()->create([    
            "role_id" => $inventoryRole->id
        ]);

        $inventory2->inventorys()->create([
            "name" => "inventroy22"
        ]);
           
        $inventory2->inventorys()->create([
            "name" => "inventroy222"
        ]);


        // USER 1
        $user1 = User::create([
            "name" => "user1",
            "email" => "user1@gmail.com",
            "password" => \Hash::make("12345678")
        ]);

        $user1->grants()->create([    
            "role_id" => $productRole->id
        ]);

        $user1->products()->create([
            "name" => "product1-u1",            
        ]);

      
        // USER 2
        $user2 = User::create([
            "name" => "user2",
            "email" => "user2@gmail.com",
            "password" => \Hash::make("12345678")
        ]);

        $user2->grants()->create([    
            "role_id" => $productRole->id
        ]);

        $user2->products()->create([
            "name" => "product1-u2",            
        ]);

        // USER 3
        $user3 = User::create([
            "name" => "user3",
            "email" => "user3@gmail.com",
            "password" => \Hash::make("12345678")
        ]);

        $user3->grants()->create([    
            "role_id" => $productRole->id,
            "operators" => ["index"],
        ]);

        $user3->products()->create([
            "name" => "product1-u3",            
        ]);
    }
}
