<?php

namespace Controllers;

use Classes\Professeur;

class professeurController {
    private $professeurs = [];

    // Fetch all professors
    public function index() {
        return $this->professeurs;
    }

    // Add a new professor
    public function store($id, $name, $role, $hoursPerWeek) {
        $professeur = new Professeur($id, $name, $role, $hoursPerWeek);
        $this->professeurs[] = $professeur;
        return "Professor added successfully!";
    }

    // Edit an existing professor
    public function update($id, $name, $role, $hoursPerWeek) {
        foreach ($this->professeurs as $professeur) {
            if ($professeur->id == $id) {
                $professeur->name = $name;
                $professeur->role = $role;
                $professeur->hoursPerWeek = $hoursPerWeek;
                return "Professor updated successfully!";
            }
        }
        return "Professor not found!";
    }

    // Delete a professor
    public function destroy($id) {
        foreach ($this->professeurs as $key => $professeur) {
            if ($professeur->id == $id) {
                unset($this->professeurs[$key]);
                return "Professor deleted successfully!";
            }
        }
        return "Professor not found!";
    }
}
