<?php

namespace AppBundle\Service\OrientDb;

use PhpOrient\PhpOrient;
use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;

class PhpOrientWrapper extends PhpOrient
{
    /**
     * @param $data
     * @return array
     */
    private function addFlattedRidData($data)
    {
        /** @var Record $record */
        foreach ((array)$data as &$record) {
            $oData = $record->getOData();
            if (!empty($oData['rid'])) {
                /** @var ID $rid */
                $rid = $oData['rid'];
                $oData['rid']  = $rid->__toString();
                $record->setOData($oData);
            }
        }

        return $data;
    }

    /**
     * @param $query
     * @return array
     */
    public function queryWithRid($query)
    {
        $result = $this->query($query);
        if (!empty($result)) {
            $this->addFlattedRidData($result);
        }

        return $result;
    }
}