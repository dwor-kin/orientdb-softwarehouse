<?php


namespace AppBundle\Service\OrientDb;

use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Operations\RecordCreate;
use PhpOrient\Protocols\Binary\Operations\RecordUpdate;

abstract class AbstractOrientDbProvider implements OrientDbProviderInterface
{
    protected $phpOrientClient;
    protected $clusterMap;
    protected $database;
    protected $user;
    protected $password;

    /**
     * @param PhpOrientWrapper $phpOrientWrapper
     * @param $database
     * @param $user
     * @param $password
     */
    public function __construct(
        PhpOrientWrapper $phpOrientWrapper,
        $database,
        $user,
        $password
    ) {
        $this->phpOrientClient = $phpOrientWrapper;
        $this->connect();
    }

    /**
     * @return ID
     */
    public function getID()
    {
        return new ID($this->clusterMap['id']);
    }

    /**
     * @param Record $record
     * @return Record|RecordCreate
     */
    public function create(Record $record)
    {
        return $this->phpOrientClient->recordCreate($record);
    }

    /**
     * @param Record $record
     * @return Record|RecordUpdate
     */
    public function update(Record $record)
    {
        return $this->phpOrientClient->recordUpdate($record);
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function executeCommand($query)
    {
        return $this->phpOrientClient->command($query);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function setSqlBatch($query)
    {
        return $this->phpOrientClient->sqlBatch($query);
    }

    /**
     * @return PhpOrientWrapper
     */
    public function getPhpOrientClient()
    {
        return $this->phpOrientClient;
    }

    protected function connect()
    {
        $this->clusterMap = $this->phpOrientClient->dbOpen(
            $this->database,
            $this->user,
            $this->password
        );
    }

}
