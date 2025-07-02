<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For SQLite, we need to handle foreign keys differently
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        
        // Clear existing data
        City::truncate();
        State::truncate();
        Country::truncate();
        
        // Re-enable foreign key checks
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // Load JSON data files
        $countriesJson = File::get(database_path('data/countries.json'));
        $statesJson = File::get(database_path('data/states.json'));
        $citiesJson = File::get(database_path('data/cities.json'));

        $countries = json_decode($countriesJson, true);
        $states = json_decode($statesJson, true);
        $cities = json_decode($citiesJson, true);

        $this->command->info('Starting to seed countries, states, and cities...');

        // Insert Countries
        $this->command->info('Seeding countries...');
        foreach ($countries as $countryData) {
            Country::create([
                'id' => $countryData['id'],
                'name' => $countryData['name'],
                'phone_code' => $countryData['phone_code'],
                'currency' => $countryData['currency'],
                'currency_symbol' => $countryData['currency_symbol'],
                'timezones' => $countryData['timezones'],
                'icon' => $countryData['icon'],
                'is_active' => $countryData['is_active'],
            ]);
        }
        $this->command->info('✓ Seeded ' . count($countries) . ' countries');

        // Insert States
        $this->command->info('Seeding states...');
        foreach ($states as $stateData) {
            State::create([
                'id' => $stateData['id'],
                'country_id' => $stateData['country_id'],
                'name' => $stateData['name'],
                'state_code' => $stateData['state_code'],
                'is_active' => $stateData['is_active'],
            ]);
        }
        $this->command->info('✓ Seeded ' . count($states) . ' states');

        // Insert Cities
        $this->command->info('Seeding cities...');
        foreach ($cities as $cityData) {
            City::create([
                'id' => $cityData['id'],
                'state_id' => $cityData['state_id'],
                'name' => $cityData['name'],
                'is_active' => $cityData['is_active'],
            ]);
        }
        $this->command->info('✓ Seeded ' . count($cities) . ' cities');

        $this->command->info('✅ Successfully seeded all location data!');
    }
}
