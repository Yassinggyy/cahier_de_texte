<?php

namespace Controllers;

use Classes\Filiere;

class filiereController {
    private $file = __DIR__ . '/../../data/filieres.json';

    // Fetch all filières
    public function index() {
        if (!file_exists($this->file)) {
            return [];
        }
        $data = file_get_contents($this->file);
        return json_decode($data, true) ?? [];
    }

    // Add a new filière
    public function store($id, $name, $description) {
        $filieres = $this->index(); // Get current filières
        $filiere = new Filiere($id, $name, $description);
        $filieres[] = ['id' => $filiere->id, 'name' => $filiere->name, 'description' => $filiere->description];
        file_put_contents($this->file, json_encode($filieres));
        return "Filiere added successfully!";
    }

    // Edit an existing filière
    public function update($id, $name, $description) {
        $filieres = $this->index();
        foreach ($filieres as &$filiere) {
            if ($filiere['id'] == $id) {
                $filiere['name'] = $name;
                $filiere['description'] = $description;
                file_put_contents($this->file, json_encode($filieres));
                return "Filiere updated successfully!";
            }
        }
        return "Filiere not found!";
    }

    // Delete a filière
    public function destroy($id) {
        $filieres = $this->index();
        foreach ($filieres as $key => $filiere) {
            if ($filiere['id'] == $id) {
                unset($filieres[$key]);
                file_put_contents($this->file, json_encode(array_values($filieres)));
                return "Filiere deleted successfully!";
            }
        }
        return "Filiere not found!";
    }
}
