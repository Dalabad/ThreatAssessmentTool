<?php

namespace App\Models;

class Location
{
    protected $_name;
    protected $_coordinates;
    protected $_timestamp;
    protected $_description;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     * @return Location
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->_coordinates;
    }

    /**
     * @param mixed $coordinates
     * @return Location
     */
    public function setCoordinates($coordinates)
    {
        $this->_coordinates = $coordinates;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    /**
     * @param mixed $timestamp
     * @return Location
     */
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = $timestamp;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     * @return Location
     */
    public function setDescription($description)
    {
        $this->_description = $description;
        return $this;
    }



}
