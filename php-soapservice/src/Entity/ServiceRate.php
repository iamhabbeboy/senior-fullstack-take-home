<?php

namespace Application\Entity;

class ServiceRate extends ActiveRecord
{
    const TABLE_NAME = 'service_rates';

    public $service_id;

    public $company_id;

    public $unit;

    public $amount;

    public $duration;

    public $supply_markup;

    public $overhead_markup;

    public $misc_markup;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'unit' => $this->unit,
            'amount' => $this->amount,
            'duration' => $this->duration,
        ];
    }
    
}