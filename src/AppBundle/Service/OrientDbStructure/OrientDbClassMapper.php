<?php

namespace AppBundle\Service\OrientDbStructure;

class OrientDbClassMapper
{
    /**
     * @param $content
     * @param OrientDbClassInterface $orientDbClass
     * @return OrientDbClassInterface
     */
    public static function set($content, OrientDbClassInterface $orientDbClass)
    {
        foreach ($content as $property => $value) {
            $orientDbClass->$property = $value;
        }

        return $orientDbClass;
    }
}