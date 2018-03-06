<?php

namespace AppBundle\Service\OrientDbStructure;

abstract class OrientDbClassAbstract implements OrientDbClassInterface
{
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }
}