<?php

namespace Application\Service;

use Application\Entity\Company;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class CompanyService extends BaseService
{
    public function getCompanyById()
    {
        try {
            return 'The Boring Company';
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }

    public function getAllCompanies()
    {
        throw new NotImplementedException();
    }
}
