<?php

namespace AppBundle\OrientDbRepository\SoftwareHouseRepository;

class PersonRepository extends Repository
{
    /**
     * @return array
     */
    public function getPersonsWithoutProject()
    {
        return $this->phpOrientClient->queryWithRid("Select @rid, name, surname, position, out('BelongsToOffice').city as city from Person WHERE out('WorkinInProject').size() = 0 AND position <> 'Head'");
    }

    /**
     * @return array
     */
    public function getPersonsWithoutOffice()
    {
        return $this->phpOrientClient->queryWithRid("Select @rid, name, surname, position FROM Person WHERE out('BelongsToOffice').size() = 0");
    }
}
