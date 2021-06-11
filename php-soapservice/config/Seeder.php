<?php

namespace Application\config;

use Application\config\MysqlDBAdapter;

class Seeder extends MysqlDBAdapter
{

    public function company()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\Company();
            $user->name = $faker->company;
            $user->email = $faker->email;
            $user->logo_url = '';
            $user->address = $faker->address;
            $user->country = $faker->country;
            $user->tax_rate = $faker->numberBetween(2, 10);
            $user->save();
        }
    }

    public function service()
    {
        $faker = \Faker\Factory::create();
        $startDate = $faker->dateTimeThisMonth('now');
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\Service();
            $user->service_category_id = $faker->numberBetween(1, 3);
            $user->company_id = $faker->numberBetween(1, 3);
            $user->name = $faker->randomElement(['Regular', 'Spring/Deep Cleaning', 'Move-in/Move-out Cleaning', 'Green Cleaning', 'Secure Cleaning', 'Post-Construction Cleaning', 'Warehouses', 'Industrial equipment
            ', 'Loading docks']);
            $user->save();
        }
    }

    public function serviceRate()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\ServiceRate();
            $user->company_id = $faker->numberBetween(1, 3);
            $user->service_id = $faker->numberBetween(1, 3);
            $user->unit = $faker->numberBetween(1, 3000);
            $user->amount = $faker->numberBetween(5000, 10000);
            $user->duration = $faker->numberBetween(1.5, 5). "h";
            $user->supply_markup = $faker->numberBetween(10, 50);
            $user->overhead_markup = $faker->numberBetween(10, 50);
            $user->misc_markup = $faker->numberBetween(10, 50);
            $user->service_request_id = $faker->numberBetween(1, 3);
            $user->save();
        }
    }

    public function serviceRequest()
    {
        $faker = \Faker\Factory::create();
        $startDate = $faker->dateTimeThisMonth('now');
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\ServiceRequest();
            $user->issue_id = $faker->numberBetween(1, 3);
            $user->user_id = 0;
            $user->company_id = $faker->numberBetween(1, 3);
            $user->proposed_start_date = $startDate;
            $user->proposed_end_date = $faker->dateTimeInInterval($startDate = $startDate, '+ 5 days');
            $user->actual_start_date = $faker->dateTimeInInterval($startDate = $startDate, '+ 7 days');
            $user->actual_end_date = $faker->dateTimeInInterval($startDate = $startDate, '+ 10 days');
            $user->title = $faker->sentence(1);
            $user->status = "pending";
            $user->adjustment = "";
            $user->save();
        }
    }
    

    public function workOrder()
    {
        $faker = \Faker\Factory::create();
        $startDate = $faker->dateTimeThisMonth('now');
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\WorkOrder();
            $user->service_request_id = $faker->numberBetween(1, 3);
            $user->user_id = $faker->numberBetween(1, 3);
            $user->status = 'approve';
            $user->save();
        }
    }

    public function holiday()
    {
        $faker = \Faker\Factory::create();
        $startDate = $faker->dateTimeThisMonth('now');
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\Holiday();
            $user->user_id = $faker->numberBetween(1, 3);
            $user->start_date = $startDate;
            $user->end_date = $faker->dateTimeInInterval($startDate = $startDate, '+ 5 days');
            $user->status = 'approve';
            $user->save();
        }
    }

    public function user()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= 3; $i++) {
            $user = new \Application\Entity\User();
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->email = $faker->email;
            $user->avatar_url = '';
            $user->address = '';
            $user->phone = $faker->phoneNumber;
            $user->role = 'staff';
            $user->hourly_rate = $faker->numberBetween(3, 10);
            $user->save();
        }
    }

    public function run()
    {
        $tables = get_class_methods(new self);
        $except = ['run', '__construct', 'getConnection'];
        foreach( $tables as $table) {
            if(in_array($table, $except)) {
                continue;
            }
            $this->{$table}();
        }
    }


}