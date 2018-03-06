<?php

namespace AppBundle\OrientDbRepository\SoftwareHouseRepository;

class OfficeRepository extends Repository
{
    public function getAllOffices()
    {
        return $this->phpOrientClient->queryWithRid("select @rid, city from Office");
    }

    public function getPersonsFromSelectedOffice($officeRef)
    {
        return array();
    }
}
