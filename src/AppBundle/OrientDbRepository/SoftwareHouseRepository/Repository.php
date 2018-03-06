<?php

namespace AppBundle\OrientDbRepository\SoftwareHouseRepository;


use AppBundle\Service\OrientDb\OrientDbProviderInterface;
use AppBundle\Service\OrientDb\PhpOrientWrapper;

abstract class Repository
{
    /** @var PhpOrientWrapper */
    protected $phpOrientClient;

    public function __construct(OrientDbProviderInterface $phpOrientProvider)
    {
        $this->phpOrientClient = $phpOrientProvider->getPhpOrientClient();
    }
}
