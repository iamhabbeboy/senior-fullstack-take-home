<?php

namespace Application\Entity;

class WorkOrder extends ActiveRecord
{
    const TABLE_NAME = 'work_orders';

    public $service_request_id;

    public $user_id;

    public $status;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'staff_id' => $this->user_id,
            'service_request_id' => $this->service_request_id,
            'status' => $this->status,
        ];
    }
    
}