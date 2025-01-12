<?php

namespace Classes;

class Filiere {
    // Properties
    public $id;
    public $name;
    public $description;

    // Constructor
    public function __construct($id, $name, $description = '') {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    // Example Method
    public function getDetails() {
        return "Filiere: $this->name (ID: $this->id)";
    }
}
