<?php

namespace Application\Entity;

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

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name . ', '. $this->last_name,
        ];
    }
    
}