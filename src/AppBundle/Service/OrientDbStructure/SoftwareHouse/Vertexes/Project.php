<?php

namespace AppBundle\Service\OrientDbStructure\SoftwareHouse\Vertexes;

use AppBundle\Service\OrientDbStructure\VertexAbstract;
use AppBundle\Service\OrientDbStructure\VertexInterface;

class Project extends VertexAbstract implements VertexInterface
{
    protected $description;
    protected $name;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getContent()
    {
        return array(
            'description' => $this->getDescription(),
            'name'  => $this->getName()
        );
    }
}
