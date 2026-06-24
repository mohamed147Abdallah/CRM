<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create an Admin User (for the portfolio demo)
        $admin = User::firstOrCreate(
            ['email' => 'admin@nexus.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Create an Agent User
        $agent = User::firstOrCreate(
            ['email' => 'agent@nexus.com'],
            [
                'name' => 'Field Agent Alpha',
                'password' => Hash::make('password'),
                'role' => 'agent',
            ]
        );

        // 3. Delete existing customers to prevent duplicates on re-seeding
        Customer::truncate();

        // 4. Seed Dummy Customers
        $customers = [
            [
                'name' => 'CyberDyne Systems',
                'email' => 'contact@cyberdyne.corp',
                'phone' => '+1-555-0199',
                'company' => 'CyberDyne Systems',
                'deal_value' => 150000.00,
                'status' => 'won',
                'priority' => 'critical',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Massive Dynamic',
                'email' => 'acquisitions@massivedynamic.com',
                'phone' => '+1-555-0210',
                'company' => 'Massive Dynamic',
                'deal_value' => 85000.50,
                'status' => 'negotiation',
                'priority' => 'standard',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Tyrell Corporation',
                'email' => 'nexus@tyrell.corp',
                'phone' => '+1-555-0300',
                'company' => 'Tyrell Corp',
                'deal_value' => 320000.00,
                'status' => 'new',
                'priority' => 'critical',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Wayne Enterprises',
                'email' => 'b.wayne@wayneent.com',
                'phone' => '+1-555-0450',
                'company' => 'Wayne Enterprises',
                'deal_value' => 950000.00,
                'status' => 'negotiation',
                'priority' => 'standard',
                'user_id' => $agent->id,
            ],
            [
                'name' => 'Stark Industries',
                'email' => 't.stark@stark.com',
                'phone' => '+1-555-0555',
                'company' => 'Stark Industries',
                'deal_value' => 50000.00,
                'status' => 'lost',
                'priority' => 'standard',
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Initech',
                'email' => 'tps@initech.com',
                'phone' => '+1-555-0600',
                'company' => 'Initech',
                'deal_value' => 12000.00,
                'status' => 'won',
                'priority' => 'standard',
                'user_id' => $agent->id,
            ],
            [
                'name' => 'Umbrella Corp',
                'email' => 'research@umbrella.corp',
                'phone' => '+1-555-0707',
                'company' => 'Umbrella Corporation',
                'deal_value' => 450000.00,
                'status' => 'new',
                'priority' => 'critical',
                'user_id' => $agent->id,
            ],
        ];

        foreach ($customers as $data) {
            Customer::create($data);
        }
    }
}
