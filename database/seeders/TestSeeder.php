<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Arrays for random data generation
        $firstNames = ['John', 'Jane', 'Michael', 'Sarah', 'David', 'Lisa', 'Robert', 'Emily', 'James', 'Maria', 'William', 'Jennifer', 'Richard', 'Patricia', 'Charles', 'Linda', 'Thomas', 'Barbara', 'Christopher', 'Elizabeth', 'Daniel', 'Jessica', 'Matthew', 'Susan', 'Anthony', 'Karen', 'Mark', 'Nancy', 'Donald', 'Lisa', 'Steven', 'Betty', 'Paul', 'Helen', 'Andrew', 'Sandra', 'Joshua', 'Donna', 'Kenneth', 'Carol', 'Kevin', 'Ruth', 'Brian', 'Sharon', 'George', 'Michelle', 'Timothy', 'Laura', 'Ronald', 'Sarah'];
        
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzales', 'Wilson', 'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin', 'Lee', 'Perez', 'Thompson', 'White', 'Harris', 'Sanchez', 'Clark', 'Ramirez', 'Lewis', 'Robinson', 'Walker', 'Young', 'Allen', 'King', 'Wright', 'Scott', 'Torres', 'Nguyen', 'Hill', 'Flores', 'Green', 'Adams', 'Nelson', 'Baker', 'Hall', 'Rivera', 'Campbell', 'Mitchell', 'Carter', 'Roberts'];
        
        $callStatuses = ['Connected', 'Not Connected', 'Busy', 'Follow Up', 'Call Back', 'No Answer', 'Wrong Number', 'Interested', 'Not Interested'];
        
        $purposes = ['Admission Inquiry', 'Course Information', 'Fee Structure', 'Schedule Demo', 'Placement Info', 'Scholarship Info', 'Campus Visit', 'Online Classes', 'Exam Preparation', 'Career Guidance', 'Course Duration', 'Certification Details'];
        
        $countries = ['USA', 'Canada', 'UK', 'Australia', 'India', 'Germany', 'France', 'Japan', 'Brazil', 'Mexico', 'China', 'South Korea', 'Italy', 'Spain', 'Netherlands', 'Sweden', 'Norway', 'Denmark', 'Belgium', 'Switzerland'];
        
        $coachings = ['Engineering', 'Medical', 'Business', 'Law', 'Arts', 'Science', 'Commerce', 'Computer Science', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'Economics', 'Literature', 'Psychology', 'Architecture'];
        
        $branches = ['New York', 'Toronto', 'London', 'Sydney', 'Mumbai', 'Delhi', 'Berlin', 'Paris', 'Tokyo', 'São Paulo', 'Mexico City', 'Beijing', 'Seoul', 'Rome', 'Madrid', 'Amsterdam', 'Stockholm', 'Oslo', 'Copenhagen', 'Brussels'];
        
        $leadTypes = ['Hot', 'Warm', 'Cold'];
        
        $agents = ['Agent 1', 'Agent 2', 'Agent 3', 'Agent 4', 'Agent 5', 'Agent 6', 'Agent 7', 'Agent 8'];
        
        $sources = ['Website', 'Social Media', 'Google Ads', 'Referral', 'Walk-in', 'Phone Call', 'Email Campaign', 'Facebook', 'Instagram', 'LinkedIn', 'YouTube', 'Print Media', 'Radio', 'TV Advertisement', 'Event', 'Partner'];

        // Generate 100 test records
        for ($i = 1; $i <= 100; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $name = $firstName . ' ' . $lastName;
            $email = strtolower($firstName . '.' . $lastName . $i . '@email.com');
            
            // Generate random date within last 60 days
            $randomDays = rand(0, 60);
            $date = date('Y-m-d', strtotime("-{$randomDays} days"));
            
            // Generate random mobile number
            $mobileNo = '+1' . rand(100, 999) . rand(100, 999) . rand(1000, 9999);
            
            Test::create([
                'date' => $date,
                'name' => $name,
                'mobile_no' => $mobileNo,
                'email_id' => $email,
                'call_status' => $callStatuses[array_rand($callStatuses)],
                'purpose' => $purposes[array_rand($purposes)],
                'country' => $countries[array_rand($countries)],
                'coaching' => $coachings[array_rand($coachings)],
                'branch' => $branches[array_rand($branches)],
                'lead_type' => $leadTypes[array_rand($leadTypes)],
                'assign_to' => $agents[array_rand($agents)],
                'source' => $sources[array_rand($sources)],
            ]);
        }
    }
}
