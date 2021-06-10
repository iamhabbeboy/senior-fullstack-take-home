<?php

namespace Application\Service;

use GuzzleHttp\Client;
use Application\Entity\User;
use Application\config\DotEnv;
use Application\Entity\Service;
use Application\Entity\WorkOrder;
use Application\Entity\ServiceRate;
use Application\Entity\ServiceRequest;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

(new DotEnv())->load();
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

    public function setStaff()
    {
        $user = User::find($this->params['staff_id']);
        $userRelationship = $user->jsonSerialize();
        $serviceRequest = ServiceRequest::find($this->params['service_request_id']);
        $holidayStartDate = date_format($userRelationship['holiday'][0]->start_date, 'd-m-Y H:i:s');
        $holidayEndDate = date_format($userRelationship['holiday'][0]->start_date, 'd-m-Y H:i:s');
        $serviceActualStartDate = date_format($serviceRequest->actual_start_date, 'd-m-Y H:i:s');
        $serviceActualEndDate = date_format($serviceRequest->actual_end_date, 'd-m-Y H:i:s');
        return [
            'start' => $holidayStartDate,
            'end' => $holidayEndDate,
            'serviceDate' => $serviceActualStartDate,
            'enddate' => $serviceActualEndDate,
            'compare' => ($holidayStartDate >= $serviceActualStartDate) && ($holidayEndDate <= $serviceActualEndDate)
        ];

        $workOrder = new WorkOrder();
        $workOrder->service_request_id = $this->params['service_request_id'];
        $workOrder->user_id = $this->params['staff_id'];
        $workOrder->status = "started";
        $orderId  = $workOrder->save();
        $this->setComment($user);

        return $orderId;
    }

    private function setComment($user)
    {
        $comment = "Your requested has been accepted 🤝 and has 1 work order. ". ucfirst($user->first_name). " ". ucfirst($user->last_name). " has started ";
        $client = new Client();
        $response = $client->request('POST', 'https://api.github.com/repos/iamhabbeboy/senior-fullstack-take-home/issues/3/comments', 
        ['json' => ["body" => $comment],
        'headers' => [
            'Accept' => 'application/vnd.github.v3+json',
            'Authorization' => 'Bearer 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'
        ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
