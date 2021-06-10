<?php

namespace Application\Entity;

class Holiday extends ActiveRecord
{
    const TABLE_NAME = 'holidays';

    public $user_id;

    public $start_date;

    public $end_date;

    public $status;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status
        ];
    }
    
}