<?php

namespace Application\Entity;

use Application\Entity\Holiday;

class User extends ActiveRecord
{
    const TABLE_NAME = 'users';

    public $first_name;

    public $last_name;

    public $avatar_url;

    public $email;

    public $role;

    public $hourly_rate;

    public $address;

    public $phone;

    public function getHoliday()
    {
        return Holiday::where(['user_id' => $this->id ?? 0]);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'holiday' => $this->getHoliday(),
            'name' => $this->first_name . ', '. $this->last_name,
        ];
    }
    
}