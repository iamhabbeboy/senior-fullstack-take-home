<?php

namespace Application\Entity;

class ServiceRequest extends ActiveRecord
{
    const TABLE_NAME = 'service_request';

    public $user_id;

    public int $company_id;

    public $proposed_start_date;

    public $proposed_end_date;

    public $actual_start_date;

    public $actual_end_date;

    public string $title;

    public string $status;

    public string $adjustment;

    public function getCompany()
    {
        return Company::find($this->company_id);
    }

    public function getServiceRate()
    {
        return ServiceRate::where(['service_request_id' => $this->id ?? 0]);
    }

    public function getStaff()
    {
        return User::where(['company_id' => $this->company_id]);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'rate' => $this->getServiceRate(),
            'proposed_start_date' => $this->proposed_start_date,
            'proposed_end_date' => $this->proposed_end_date,
            'actual_start_date' => $this->actual_start_date,
            'actual_end_date' => $this->actual_end_date,
            'company' => $this->getCompany(),
            'staff' => $this->getStaff()
        ];
    }
}