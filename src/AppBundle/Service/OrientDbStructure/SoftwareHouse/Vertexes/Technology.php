<?php

namespace AppBundle\Service\OrientDbStructure\SoftwareHouse\Vertexes;

use AppBundle\Service\OrientDbStructure\VertexAbstract;
use AppBundle\Service\OrientDbStructure\VertexInterface;

class Technology extends VertexAbstract implements VertexInterface
{
    protected $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getContent()
    {
        return array(
            'type' => $this->getContent()
        );
    }
}