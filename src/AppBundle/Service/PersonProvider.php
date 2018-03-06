<?php

namespace AppBundle\Service;

use AppBundle\OrientDbRepository\SoftwareHouseRepository\PersonRepository;
use AppBundle\OrientDbRepository\SoftwareHouseRepository\ReportRepository;
use AppBundle\Service\OrientDb\SoftwareHouseOrientDbProvider;

class PersonProvider
{
    private $reportRepository;
    private $personRepository;

    public function __construct(
        ReportRepository $reportRepository,
        PersonRepository $personRepository
    ) {
        $this->reportRepository = $reportRepository;
        $this->personRepository = $personRepository;
    }

    /**
     * @param int $projectId
     * @return array
     */
    public function getPeopleByProject($projectId)
    {
        return $this->reportRepository->getPeopleByProject($projectId);
    }

    /**
     * @return array
     */
    public function getPersonsWithoutProject()
    {
        return $this->personRepository->getPersonsWithoutProject();
    }

    /**
     * @return array
     */
    public function getPersonsWithoutOffice()
    {
        return $this->personRepository->getPersonsWithoutOffice();
    }

    public function getPeopleByOffice($officeRef)
    {
        return $this->personRepository->getPersonsFromSelectedOffice($officeRef);
    }

}
