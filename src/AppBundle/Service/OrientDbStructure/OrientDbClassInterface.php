<?php

namespace AppBundle\Service\OrientDbStructure;

interface OrientDbClassInterface
{
    public function getContent();
    public function __get($property);
    public function __set($property, $value);
}