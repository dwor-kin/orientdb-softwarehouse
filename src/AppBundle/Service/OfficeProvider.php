<?php

namespace AppBundle\Service;

use AppBundle\OrientDbRepository\SoftwareHouseRepository\BasicDataRepository;
use AppBundle\OrientDbRepository\SoftwareHouseRepository\OfficeRepository;
use AppBundle\Service\OrientDb\SoftwareHouseOrientDbProvider;

class OfficeProvider
{
    private $officeRepository;

    public function __construct(
        OfficeRepository $officeRepository
    ) {
        $this->officeRepository = $officeRepository;
    }

    /**
     * @return array
     */
    public function getAllOffices()
    {
        return $this->officeRepository->getAllOffices();
    }
}
