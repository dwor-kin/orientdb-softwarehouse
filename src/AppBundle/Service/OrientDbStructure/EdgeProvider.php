<?php

namespace AppBundle\Service\OrientDbStructure;

use AppBundle\Service\OrientDb\OrientDbProvider;
use AppBundle\Service\OrientDb\OrientDbProviderInterface;
use PhpOrient\Protocols\Binary\Data\Record;

class EdgeProvider extends OrientDbClassProviderAbstract
{
    /**
     * @param EdgeInterface $edge
     * @return string
     */
    private function createQuery(EdgeInterface $edge)
    {
        $in = $edge->getIn();
        $out = $edge->getOut();

        $className = substr(get_class($edge), strrpos(get_class($edge), '\\') + 1);
        return "CREATE EDGE $className FROM $in TO $out";
    }

    /**
     * @param EdgeInterface $edge
     * @return mixed
     */
    public function setSqlCommand(EdgeInterface $edge)
    {
        return $this->orientDbProvider->executeCommand($this->createQuery($edge));
    }

    /**
     * @param EdgeInterface $edge
     * @return mixed
     */
    public function setNewBatch(EdgeInterface $edge)
    {
        return $this->orientDbProvider->setSqlBatch($this->createQuery($edge));
    }
}
