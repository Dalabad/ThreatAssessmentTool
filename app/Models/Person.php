<?php

namespace App\Models;

class Person
{
    protected $attributes;

    public function addAttribute($name, $value) {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function merge(Person $findings)
    {
        $newAttributes = $findings->getAttributes();

        foreach($newAttributes as $name => $value) {
            if(!in_array($name, $this->attributes)) {
                $this->addAttribute($name, $value);
            }
        }

        return $this;
    }
}
