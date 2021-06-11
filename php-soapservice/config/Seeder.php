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