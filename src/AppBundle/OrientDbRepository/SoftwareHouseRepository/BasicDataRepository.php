<?php

namespace AppBundle\OrientDbRepository\SoftwareHouseRepository;

class BasicDataRepository extends Repository
{
    /**
     * @return array
     */
    public function getAllLeadersAndHeads()
    {
        return $this->phpOrientClient->queryWithRid('select @rid, surname, name, position from Person where position in [\'Team Leader\', \'Head\']');
    }

    public function getAllTechnologies()
    {
        return $this->phpOrientClient->queryWithRid("select @rid, type from Technology");
    }

    /**
     * @return array
     */
    public function getAllOffices()
    {
        return $this->phpOrientClient->queryWithRid("select @rid, city from Office");
    }

    /**
     * @return array
     */
    public function getAllProjects()
    {
        return $this->phpOrientClient->queryWithRid("select @rid, name, description from Project");
    }

    /**
     * @return array
     */
    public function getAllHeaders()
    {
        return $this->phpOrientClient->queryWithRid("select @rid, name, surname from Person WHERE position = 'Head'");
    }

    /**
     * @param string $rid
     * @return array
     */
    public function getFullPersonData($rid)
    {
        return $this->phpOrientClient->queryWithRid("select @rid, name, surname, position, gender from Person where @rid = $rid");
    }

    /**
     * @param string $rid
     * @return array
     */
    public function getLeadByPersonId($rid)
    {
        return $this->phpOrientClient->queryWithRid("select @rid, name, surname, position, gender from (SELECT expand(in('Lead')) from Person WHERE @rid = $rid)");
    }

    /**
     * @param string $rid
     * @return array
     */
    public function getOfficeDataByPersonId($rid)
    {
        return $this->phpOrientClient->query("SELECT expand(out('BelongsToOffice')) from Person WHERE @rid = $rid");
    }

    /**
     * @param string $rid
     * @return array
     */
    public function getTechnologyByPersonId($rid)
    {
        return $this->phpOrientClient->query("SELECT expand(out('BelongsToTechnology')) from Person WHERE @rid = $rid");
    }

    /**
     * @param string $rid
     * @return array
     */
    public function getProjectDataByPersonId($rid)
    {
        return $this->phpOrientClient->query("SELECT expand(out('WorkinInProject')) from Person WHERE @rid = $rid");
    }

    /**
     * @return array
     */
    public function getAllPersons()
    {
        return $this->phpOrientClient->query("SELECT from Person LIMIT -1");
    }
}
