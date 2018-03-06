<?php

namespace AppBundle\Service\OrientDbStructure;

abstract class EdgeAbstract extends OrientDbClassAbstract implements EdgeInterface
{
    protected $in;
    protected $out;

    public function setIn($rid)
    {
        $this->in = $rid;
    }

    public function setOut($rid)
    {
        $this->out = $rid;
    }

    public function getIn()
    {
        return $this->in;
    }

    public function getOut()
    {
        return $this->out;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return array(
            'in'    => $this->getIn(),
            'out'   => $this->getOut()
        );
    }
}