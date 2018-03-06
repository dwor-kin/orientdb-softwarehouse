<?php

namespace AppBundle\Service;

use AppBundle\OrientDbRepository\SoftwareHouseRepository\ReportRepository;
use AppBundle\Service\OrientDb\SoftwareHouseOrientDbProvider;

class ReportProvider
{
    private $reportRepository;

    public function __construct(
        ReportRepository $reportRepository
    ) {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @param int $cityId
     * @return array
     */
    public function getUnemployed($cityId)
    {
        return $this->reportRepository->getUnemployed($cityId);
    }

    /**
     * @param string $rid
     * @return array
     */
    public function getPeopleByLeader($rid)
    {
        return $this->reportRepository->getPeopleByLeader($rid);
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
     * @param int $id
     * @return array
     */
    public function getPeopleByHead($id)
    {
        return $this->reportRepository->getPeopleByHead($id);
    }

    /**
     * @param $rid
     * @return array
     */
    public function getPeopleByTechnology($rid)
    {
        return $this->reportRepository->getPeopleByTechnology($rid);
    }

    /**
     * @return array
     */
    public function getPeopleInAllProject()
    {
        return $this->reportRepository->getPeopleInAllProject();
    }
}
