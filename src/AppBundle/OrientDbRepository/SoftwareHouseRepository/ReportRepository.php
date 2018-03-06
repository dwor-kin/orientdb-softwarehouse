<?php


namespace AppBundle\OrientDbRepository\SoftwareHouseRepository;

class ReportRepository extends Repository
{
    /**
     * @param int $rid
     * @return array
     */
    public function getPeopleByLeader($rid)
    {
        $query = "select @rid, name, surname, position, gender from (select expand(out('Lead')) from Person where @rid = $rid)";
        return $this->phpOrientClient->queryWithRid($query);
    }

    /**
     * @param int $cityId
     * @return array
     */
    public function getUnemployed($cityId)
    {
        $query = "select @rid, name, surname, position, gender from (select expand(in('BelongsToOffice')) from Office where @rid = $cityId) where out('WorkinInProject').size() = 0 and position <> 'Head'";
        return $this->phpOrientClient->queryWithRid($query);
    }

    /**
     * @param int $projectId
     * @return array
     */
    public function getPeopleByProject($projectId)
    {
        $query = "select @rid, name, surname, position, gender, out('BelongsToOffice').city as city from (select expand(in('WorkinInProject')) from Project where @rid = $projectId)";
        return $this->phpOrientClient->queryWithRid($query);
    }

    /**
     * @param $rid
     * @return array
     */
    public function getPeopleByHead($rid)
    {
        $query = 'select @rid, name, surname, position, gender from (traverse out(\'Lead\') from (Select from Person Where @rid = ' . $rid . ') WHILE $depth <3) where In(\'Lead\').size() <> 0';
        return $this->phpOrientClient->queryWithRid($query);
    }

    /**
     * @param $rid
     * @return array
     */
    public function getPeopleByTechnology($rid)
    {
        $query = "select @rid, name, surname, position, gender from (select expand(in('BelongsToTechnology')) from Technology where @rid = $rid)";
        return $this->phpOrientClient->queryWithRid($query);
    }

    /**
     * @return array
     */
    public function getPeopleInAllProject()
    {
        $query = "Select @rid, surname, name, position, out('BelongsToTechnology').type as technology, out('BelongsToOffice').city as city, out('WorkinInProject').name as project from Person LIMIT -1";
        return $this->phpOrientClient->queryWithRid($query);
    }
}
