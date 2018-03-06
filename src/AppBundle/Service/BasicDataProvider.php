<?php

namespace AppBundle\Service;

use AppBundle\OrientDbRepository\SoftwareHouseRepository\BasicDataRepository;
use AppBundle\OrientDbRepository\SoftwareHouseRepository\ReportRepository;
use AppBundle\Service\OrientDb\SoftwareHouseOrientDbProvider;
use PhpOrient\Protocols\Binary\Data\Record;

class BasicDataProvider
{
    private $basicDataRepository;
    private $reportRepository;

    public function __construct(
        BasicDataRepository $basicDataRepository,
        ReportRepository $reportRepository
    ) {
        $this->basicDataRepository = $basicDataRepository;
        $this->reportRepository = $reportRepository;
    }

    /**
     * @return array
     */
    public function getAllLeadersAndHeads()
    {
        return $this->basicDataRepository->getAllLeadersAndHeads();
    }

    public function getAllTechnologies()
    {
        return $this->basicDataRepository->getAllTechnologies();
    }

    /**
     * @return array
     */
    public function getAllOffices()
    {
        return $this->basicDataRepository->getAllOffices();
    }

    /**
     * @return array
     */
    public function getAllProjects()
    {
        return $this->basicDataRepository->getAllProjects();
    }

    /**
     * @return array
     */
    public function getAllHeaders()
    {
        return $this->basicDataRepository->getAllHeaders();
    }

    /**
     * @return array
     */
    public function getAllPersons()
    {
        return $this->basicDataRepository->getAllPersons();
    }

    /**
     * @param int $rid
     * @return array
     */
    public function getFullPersonData($rid)
    {
        /** @var Record $userData */
        $userData = $this->basicDataRepository->getFullPersonData($rid);

        /** @var Record $leaderInData */
        $leaderInData = $this->basicDataRepository->getLeadByPersonId($rid);
        $inferiorData = $this->reportRepository->getPeopleByLeader($rid);

        /** @var Record $officeData */
        $officeData = $this->basicDataRepository->getOfficeDataByPersonId($rid);

        $technologyData = $this->basicDataRepository->getTechnologyByPersonId($rid);
        $projectData = $this->basicDataRepository->getProjectDataByPersonId($rid);

        return array(
            'userData'          => $userData[0]->getOData(),
            'leadInData'        => !empty($leaderInData) ? $leaderInData[0]->getOData() : array(),
            'leadOutData'       => $inferiorData,
            'officeData'        => !empty($officeData) ? $officeData[0]->getOData() : array(),
            'technologyData'    => $technologyData,
            'projectData'       => $projectData
        );
    }
}
