<?php

namespace Classes;

class Seance {
    // Properties
    public $id;
    public $date;
    public $groupId;
    public $professorId;
    public $description;
    public $type; // TP or Course

    // Constructor
    public function __construct($id, $date, $groupId, $professorId, $description, $type) {
        $this->id = $id;
        $this->date = $date;
        $this->groupId = $groupId;
        $this->professorId = $professorId;
        $this->description = $description;
        $this->type = $type;
    }

    // Example Method
    public function getDetails() {
        return "Seance: $this->type on $this->date (Group ID: $this->groupId, Prof: $this->professorId)";
    }
}
