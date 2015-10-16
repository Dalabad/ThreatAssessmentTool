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
}
