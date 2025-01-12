<?php

namespace Classes;

class Groupe {
    // Properties
    public $id;
    public $name;
    public $filiereId;

    // Constructor
    public function __construct($id, $name, $filiereId) {
        $this->id = $id;
        $this->name = $name;
        $this->filiereId = $filiereId;
    }

    // Example Method
    public function getDetails() {
        return "Group: $this->name (ID: $this->id, Filiere ID: $this->filiereId)";
    }
}
