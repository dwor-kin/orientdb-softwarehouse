<?php

namespace AppBundle\Service;

use AppBundle\Service\OrientDb\SoftwareHouseOrientDbProvider;

class BelongsToProjectHandler
{
    private $softwareHouseOrientDbProvider;

    public function __construct(
        SoftwareHouseOrientDbProvider $softwareHouseOrientDbProvider
    ) {
        $this->softwareHouseOrientDbProvider = $softwareHouseOrientDbProvider;
    }

}
