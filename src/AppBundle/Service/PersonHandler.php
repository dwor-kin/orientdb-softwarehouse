<?php

namespace AppBundle\Service;

use AppBundle\Service\OrientDbStructure\EdgeProvider;
use AppBundle\Service\OrientDbStructure\OrientDbClassMapper;
use AppBundle\Service\OrientDbStructure\SoftwareHouse\Edges\BelongsToOffice;
use AppBundle\Service\OrientDbStructure\SoftwareHouse\Edges\BelongsToTechnology;
use AppBundle\Service\OrientDbStructure\SoftwareHouse\Vertexes\Person;
use AppBundle\Service\OrientDbStructure\VertexProvider;

class PersonHandler
{
    private $vertexProvider;
    private $edgeProvider;

    /**
     * @param VertexProvider $vertexProvider
     * @param EdgeProvider $edgeProvider
     */
    public function __construct(VertexProvider $vertexProvider, EdgeProvider $edgeProvider) {
        $this->vertexProvider = $vertexProvider;
        $this->edgeProvider = $edgeProvider;
    }

    /**
     * @param array $recordContent
     * @return bool
     */
    public function addNewPerson(array $recordContent)
    {
        $officeRid = $recordContent['office'] ? $recordContent['office'] : array();

        $technologyRids = $recordContent['technology'] ? $recordContent['technology'] : array();

        try {
            $person = $this->getPersonVertex($recordContent);
            $record = $this->vertexProvider->setNewRecord($person);
            $personRid = $record->getRid()->__toString();

            $content = array(
                'out'   => $personRid,
                'in'    => $officeRid
            );

            $belongsToOffice = $this->getBelongsToOfficeEdge($content);
            $this->edgeProvider->setSqlCommand($belongsToOffice);

            foreach ($technologyRids as $technologyRid) {
                $content = array(
                    'out'   => $personRid,
                    'in'    => $technologyRid
                );
                $belongsToTechnology = $this->getBelongsToTechnologyEdge($content);
                $this->edgeProvider->setSqlCommand($belongsToTechnology);
            }

            return true;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    /**
     * @param $content
     * @return Person
     */
    private function getPersonVertex($content)
    {
        return OrientDbClassMapper::set($content, new Person());
    }

    /**
     * @param $content
     * @return BelongsToOffice
     */
    private function getBelongsToOfficeEdge($content)
    {
        return OrientDbClassMapper::set($content, new BelongsToOffice());
    }

    /**
     * @param $content
     * @return BelongsToTechnology
     */
    private function getBelongsToTechnologyEdge($content)
    {
        return OrientDbClassMapper::set($content, new BelongsToTechnology());
    }



//    /**
//     * @param array $recordContent
//     * @return bool
//     * @throws \PhpOrient\Exceptions\PhpOrientBadMethodCallException
//     */
//    public function addNewPersonSequence(array $recordContent)
//    {
//        $offaiceRid = $recordContent['office'] ? $recordContent['office'] : array();
//
//        $technologyRids = $recordContent['technology'] ? $recordContent['technology'] : array();
//        unset($recordContent['office'], $recordContent['technology']);
//
//        $person = Person::get($this->softwareHouseOrientDbProvider);
//        $record = $person->setNewRecord($recordContent);
//
//        // set transaction
//        $transaction = $this->softwareHouseOrientDbProvider->getPhpOrientClient()->getTransactionStatement();
//        $transaction = $transaction->begin();
//
//        try {
//            /** @var RecordCreate $response */
//            $response = $this->softwareHouseOrientDbProvider->create($record);
//            var_dump($response);
//            $transaction->attach($response);
//
//            $personRid = $response->record->getRid()->__toString();
//
//            /** @var BelongsToOffice $belongsToOffice */
//            $belongsToOffice = BelongsToOffice::get($this->softwareHouseOrientDbProvider);
//            $sqlBatch = $belongsToOffice->setNewBatch($officeRid, $personRid);
//            $transaction->attach($sqlBatch);
//
//            /** @var BelongsToTechnology $belongsToTechnology */
//            $belongsToTechnology = BelongsToTechnology::get($this->softwareHouseOrientDbProvider);
//            $technologyRids = array_unique($technologyRids);
//
//            foreach ($technologyRids as $technologyRid) {
//                $sqlBatch = $belongsToTechnology->setNewBatch($technologyRid, $personRid);
//                $transaction->attach($sqlBatch);
//            }
//
//            $transaction->commit();
//            return true;
//
//        } catch (PhpOrientBadMethodCallException $e) {
//            $transaction->rollback();
//            return false;
//        }
//    }

    public function editPerson()
    {

    }
}
