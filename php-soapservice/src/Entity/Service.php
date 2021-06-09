<?php

namespace Application\Entity;

class Service extends ActiveRecord
{
    const TABLE_NAME = 'services';

    public $service_category_id;

    public $company_id;

    public $name;

    public function getCompany()
    {
        return Company::find($this->company_id);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
    
}