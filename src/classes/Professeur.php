<?php

namespace Classes;

class Professeur {
    // Properties
    public $id;
    public $name;
    public $role; // permanent or vacataire
    public $hoursPerWeek;

    // Constructor
    public function __construct($id, $name, $role, $hoursPerWeek) {
        $this->id = $id;
        $this->name = $name;
        $this->role = $role;
        $this->hoursPerWeek = $hoursPerWeek;
    }

    // Example Method
    public function getDetails() {
        return "Professeur: $this->name (ID: $this->id, Role: $this->role, Hours/Week: $this->hoursPerWeek)";
    }
}
