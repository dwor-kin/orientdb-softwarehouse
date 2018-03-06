<?php

namespace AppBundle\Service\OrientDbStructure\SoftwareHouse\Vertexes;

use AppBundle\Service\OrientDbStructure\VertexAbstract;
use AppBundle\Service\OrientDbStructure\VertexInterface;

class Office extends VertexAbstract implements VertexInterface
{
    protected $city;

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getContent()
    {
        return array(
            'city'  => $this->getCity()
        );
    }
}
