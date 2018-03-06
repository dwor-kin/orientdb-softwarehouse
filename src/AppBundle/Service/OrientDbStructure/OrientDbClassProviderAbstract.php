<?php

namespace AppBundle\Service\OrientDbStructure;

use AppBundle\Service\OrientDb\OrientDbProviderInterface;
use PhpOrient\Protocols\Binary\Data\Record;

abstract class OrientDbClassProviderAbstract
{
    protected $orientDbProvider;

    /**
     * @param OrientDbProviderInterface $orientDbProvider
     */
    public function __construct(OrientDbProviderInterface $orientDbProvider)
    {
        $this->orientDbProvider = $orientDbProvider;
    }

    /**
     * @param OrientDbClassInterface $orientDbClass
     * @param bool $asOperation
     * @return Record
     */
    public function setNewRecord(OrientDbClassInterface $orientDbClass, $asOperation = false)
    {
        $record = (new Record())
            ->setOData($orientDbClass->getContent())
            ->setOClass(substr(get_class($orientDbClass), strrpos(get_class($orientDbClass), '\\') + 1));

        if (!$asOperation) {
            $record = $this->orientDbProvider->create($record);
        }

        return $record;
    }
}