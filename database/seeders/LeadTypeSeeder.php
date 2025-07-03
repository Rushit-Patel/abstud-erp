<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeadType;

class LeadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leadTypes = [
            [
                'name' => 'Digital',
                'status' => true,
            ],
            [
                'name' => 'Walk-in',
                'status' => true,
            ],
            [
                'name' => 'Education Fair',
                'status' => true,
            ],
        ];

        foreach ($leadTypes as $leadType) {
            LeadType::firstOrCreate(
                ['name' => $leadType['name']],
                $leadType
            );
        }

        $this->command->info('Lead types seeded successfully!');
    }
}
