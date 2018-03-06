<?php

namespace AppBundle\Service\OrientDb;

class SoftwareHouseOrientDbProvider extends AbstractOrientDbProvider implements OrientDbProviderInterface
{
    protected $database     = 'software-house';
    protected $user         = 'root';
    protected $password     = 'root';

    public function __construct(
        PhpOrientWrapper $phpOrientWrapper
    ) {
        parent::__construct($phpOrientWrapper, $this->database, $this->user, $this->password);
    }
}
