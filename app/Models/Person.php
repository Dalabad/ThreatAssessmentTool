<?php

namespace App\Models;

class Person
{
    protected $_attributes;

    public function addAttribute($name, $value) {
        $this->_attributes[$name] = $value;
        return $this;
    }

    public function getAttributes() {
        return $this->_attributes;
    }

    public function merge(Person $findings)
    {
        $newAttributes = $findings->getAttributes();

        if(count($newAttributes)) {
            foreach($newAttributes as $name => $value) {
                if(!in_array($name, $this->_attributes)) {
                    $this->addAttribute($name, $value);
                }
            }
        }

        return $this;
    }

    public function __toString() {
        if(isset($this->getAttributes()['url']))
            return $this->getAttributes()['url'];

        return "";
    }
}
