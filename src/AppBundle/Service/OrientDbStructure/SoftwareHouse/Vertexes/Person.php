<?php

namespace AppBundle\Service\OrientDbStructure\SoftwareHouse\Vertexes;

use AppBundle\Service\OrientDbStructure\VertexAbstract;
use AppBundle\Service\OrientDbStructure\VertexInterface;

class Person extends VertexAbstract implements VertexInterface
{
    protected $gender;
    protected $name;
    protected $position;
    protected $surname;

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getContent()
    {
        return array(
            'gender'    => $this->getGender(),
            'name'      => $this->getName(),
            'position'  => $this->getPosition(),
            'surname'   => $this->getSurname()
        );
    }
}
