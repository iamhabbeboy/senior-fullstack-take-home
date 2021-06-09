<?php

namespace Application\Service;

use Application\Entity\Service;
use Application\Entity\ServiceRate;
use Application\Entity\ServiceRequest;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class RequestService extends BaseService
{
    public function helloFromPHP()
    {
        $response = ServiceRequest::where(['company_id' => $this->params['id']]);
        return [
            'data' => $response
        ];
    }

    public function storeServices()
    {
        $title = $this->params['title'];
        $body = explode("\n", $this->params['body']);
        $payload = [];
        foreach($body as $param) {
            list($key, $value) = explode('=', $param);
            $payload[$key] = $value;
        }

        $request = new ServiceRequest();
        $request->company_id = $payload['company_id'];
        $request->title = $title;
        $request->user_id = 0;
        $request->proposed_start_date = $payload['check_in'];
        $request->proposed_end_date = $payload['check_out'];
        $request->actual_start_date = $payload['check_in'];
        $request->actual_end_date = $payload['check_out'];
        $request->status = "pending";
        $request->adjustment = $payload['adjustment'] ?? "";
        $serviceRequestId = $request->save();

        $rate = new ServiceRate();
        $rate->service_id = $payload['service_id'];
        $rate->company_id = $payload['company_id'];
        $rate->unit =  $this->calculateUnit((float)$payload['total']);
        $rate->amount =  $payload['total'];
        $rate->supply_markup = $payload['supply_markup'] ?? 0;
        $rate->overhead_markup = $payload['supply_markup'] ?? 0;
        $rate->misc_markup = $payload['misc_markup'] ?? 0;
        $rate->duration = "1.5h";
        $rate->service_request_id = $serviceRequestId;
        $rate->save();

        return $payload;
    }

    private function calculateUnit(float $amount)
    {
        $defaultAmount = 1000;
        $defaultDuration = 1.5;
        $workHour = ($defaultDuration * $amount) / $defaultAmount;
        return $workHour;
    }
}
