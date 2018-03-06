<?php

namespace AppBundle\Service\OrientDb;

use PhpOrient\Protocols\Binary\Data\Record;

interface OrientDbProviderInterface
{
    public function getID();
    public function create(Record $record);
    public function update(Record $record);
    public function executeCommand($query);
    public function setSqlBatch($query);
    public function getPhpOrientClient();
}