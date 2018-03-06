<?php

namespace AppBundle\Service;

use AppBundle\OrientDbRepository\SoftwareHouseRepository\BasicDataRepository;
use AppBundle\Service\OrientDb\SoftwareHouseOrientDbProvider;

class ProjectHandler
{
    private $basicDataRepository;

    public function __construct(
        BasicDataRepository $basicDataRepository
    ) {
        $this->basicDataRepository = $basicDataRepository;
    }

    /**
     * @return array
     */
    public function getAllProjects()
    {
        return $this->basicDataRepository->getAllPersons();
    }
}
