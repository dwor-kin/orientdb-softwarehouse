<?php

namespace AppBundle\Service\OrientDbStructure;

interface EdgeInterface
{
    public function getIn();
    public function getOut();
    public function setIn($rid);
    public function setOut($rid);
}