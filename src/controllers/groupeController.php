<?php

namespace Controllers;

use Classes\Groupe;

class groupeController {
    private $file = __DIR__ . '/../../data/groupes.json';

    // Fetch all groupes
    public function index() {
        if (!file_exists($this->file)) {
            return [];
        }
        $data = file_get_contents($this->file);
        return json_decode($data, true) ?? [];
    }

    // Add a new group
    public function store($id, $name, $filiereId) {
        $groupes = $this->index();
        $groupe = new Groupe($id, $name, $filiereId);
        $groupes[] = ['id' => $groupe->id, 'name' => $groupe->name, 'filiereId' => $groupe->filiereId];
        file_put_contents($this->file, json_encode($groupes));
        return "Group added successfully!";
    }

    // Edit an existing group
    public function update($id, $name, $filiereId) {
        $groupes = $this->index();
        foreach ($groupes as &$groupe) {
            if ($groupe['id'] == $id) {
                $groupe['name'] = $name;
                $groupe['filiereId'] = $filiereId;
                file_put_contents($this->file, json_encode($groupes));
                return "Group updated successfully!";
            }
        }
        return "Group not found!";
    }

    // Delete a group
    public function destroy($id) {
        $groupes = $this->index();
        foreach ($groupes as $key => $groupe) {
            if ($groupe['id'] == $id) {
                unset($groupes[$key]);
                file_put_contents($this->file, json_encode(array_values($groupes)));
                return "Group deleted successfully!";
            }
        }
        return "Group not found!";
    }
}
