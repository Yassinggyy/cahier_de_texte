<?php

namespace Controllers;

use Classes\Seance;

class seanceController {
    private $seances = [];

    // Fetch all seances
    public function index() {
        return $this->seances;
    }

    // Add a new seance
    public function store($id, $date, $groupId, $professorId, $description, $type) {
        $seance = new Seance($id, $date, $groupId, $professorId, $description, $type);
        $this->seances[] = $seance;
        return "Seance added successfully!";
    }

    // Edit an existing seance
    public function update($id, $date, $groupId, $professorId, $description, $type) {
        foreach ($this->seances as $seance) {
            if ($seance->id == $id) {
                $seance->date = $date;
                $seance->groupId = $groupId;
                $seance->professorId = $professorId;
                $seance->description = $description;
                $seance->type = $type;
                return "Seance updated successfully!";
            }
        }
        return "Seance not found!";
    }

    // Delete a seance
    public function destroy($id) {
        foreach ($this->seances as $key => $seance) {
            if ($seance->id == $id) {
                unset($this->seances[$key]);
                return "Seance deleted successfully!";
            }
        }
        return "Seance not found!";
    }
}
