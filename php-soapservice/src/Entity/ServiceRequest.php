<?php

namespace Application\Entity;

use Application\Service\ResponseCode;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServiceRequest extends ActiveRecord
{
    const TABLE_NAME = 'service_request';

    public $user_id;

    public int $company_id;

    public int $issue_id;

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
        try {
            return ServiceRate::where(['service_request_id' => $this->id ?? 0]);
        } catch (RecordNotFoundException $e) {
           return [];
        }
    }

    public function getStaff()
    {
        return User::where(['company_id' => $this->company_id]);
    }

    public function getService()
    {
        return Service::where(['company_id' => $this->company_id ?? 0]);
    }

    public function getWorkOrder()
    {
        try {
            return WorkOrder::where(['service_request_id' => $this->id ?? 0]);
        } catch (RecordNotFoundException $e) {
           return [];
        }
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'issue_id' => $this->issue_id,
            'rate' => $this->getServiceRate(),
            'service' => $this->getService(),
            'proposed_start_date' => $this->proposed_start_date,
            'proposed_end_date' => $this->proposed_end_date,
            'actual_start_date' => $this->actual_start_date,
            'actual_end_date' => $this->actual_end_date,
            'company' => $this->getCompany(),
            'staff' => $this->getStaff(),
            'order' => $this->getWorkOrder()
        ];
    }
}