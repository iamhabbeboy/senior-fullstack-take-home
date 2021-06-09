<?php

namespace Application\Service;

use Application\Entity\Company;
use Application\Entity\Service;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class AuthService extends BaseService
{
    public function login()
    {
        try {
            return Company::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }

    public function getCompanyById()
    {
        try {
            return Company::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }

    public function getServices()
    {
        return Service::where(['company_id' => $this->params['id']]);
    }

    public function getAllCompanies()
    {
        throw new NotImplementedException();
    }
}
