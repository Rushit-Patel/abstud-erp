<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ImportLocationData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:import 
                            {--countries : Import only countries}
                            {--states : Import only states}
                            {--cities : Import only cities}
                            {--fresh : Clear existing data before import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import location data (countries, states, cities) from JSON files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '512M'); 

        $importCountries = $this->option('countries') || (!$this->option('states') && !$this->option('cities'));
        $importStates = $this->option('states') || (!$this->option('countries') && !$this->option('cities'));
        $importCities = $this->option('cities') || (!$this->option('countries') && !$this->option('states'));
        $fresh = $this->option('fresh');

        if ($fresh) {
            if ($this->confirm('This will delete ALL existing location data. Are you sure?')) {
                $this->clearExistingData();
            } else {
                $this->info('Import cancelled.');
                return;
            }
        }

        if ($importCountries) {
            $this->importCountries();
        }

        if ($importStates) {
            $this->importStates();
        }

        if ($importCities) {
            $this->importCities();
        }

        $this->info('✅ Location data import completed!');
    }

    private function clearExistingData()
    {
        $this->info('Clearing existing data...');
        
        // Handle foreign key constraints
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        
        City::truncate();
        State::truncate();
        Country::truncate();
        
        // Re-enable foreign key checks
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        
        $this->info('✓ Existing data cleared');
    }

    private function importCountries()
    {
        $this->info('Importing countries...');
        
        $jsonPath = database_path('data/countries.json');
        if (!File::exists($jsonPath)) {
            $this->error('Countries JSON file not found at: ' . $jsonPath);
            return;
        }

        $countriesJson = File::get($jsonPath);
        $countries = json_decode($countriesJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON in countries file: ' . json_last_error_msg());
            return;
        }

        $bar = $this->output->createProgressBar(count($countries));
        $bar->start();

        foreach ($countries as $countryData) {
            Country::updateOrCreate(
                ['id' => $countryData['id']],
                [
                    'name' => $countryData['name'],
                    'phone_code' => $countryData['phone_code'],
                    'currency' => $countryData['currency'],
                    'currency_symbol' => $countryData['currency_symbol'],
                    'timezones' => $countryData['timezones'],
                    'icon' => $countryData['icon'],
                    'is_active' => $countryData['is_active'],
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->info('');
        $this->info('✓ Imported ' . count($countries) . ' countries');
    }

    private function importStates()
    {
        $this->info('Importing states...');
        
        $jsonPath = database_path('data/states.json');
        if (!File::exists($jsonPath)) {
            $this->error('States JSON file not found at: ' . $jsonPath);
            return;
        }

        $statesJson = File::get($jsonPath);
        $states = json_decode($statesJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON in states file: ' . json_last_error_msg());
            return;
        }

        $bar = $this->output->createProgressBar(count($states));
        $bar->start();

        foreach ($states as $stateData) {
            State::updateOrCreate(
                ['id' => $stateData['id']],
                [
                    'country_id' => $stateData['country_id'],
                    'name' => $stateData['name'],
                    'state_code' => $stateData['state_code'],
                    'is_active' => $stateData['is_active'],
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->info('');
        $this->info('✓ Imported ' . count($states) . ' states');
    }

    private function importCities()
    {
        ini_set('memory_limit', '512M'); 
        $this->info('Importing cities...');
        
        $jsonPath = database_path('data/cities.json');
        if (!File::exists($jsonPath)) {
            $this->error('Cities JSON file not found at: ' . $jsonPath);
            return;
        }

        $citiesJson = File::get($jsonPath);
        $cities = json_decode($citiesJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON in cities file: ' . json_last_error_msg());
            return;
        }

        $bar = $this->output->createProgressBar(count($cities));
        $bar->start();

        foreach ($cities as $cityData) {
            City::updateOrCreate(
                ['id' => $cityData['id']],
                [
                    'state_id' => $cityData['state_id'],
                    'name' => $cityData['name'],
                    'is_active' => $cityData['is_active'],
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->info('');
        $this->info('✓ Imported ' . count($cities) . ' cities');
    }
}
