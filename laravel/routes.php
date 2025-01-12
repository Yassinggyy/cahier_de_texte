<?php

session_start();
use Illuminate\Support\Facades\Route;
use Controllers\filiereController;
use Controllers\groupeController;

require_once __DIR__ . '/../src/controllers/filiereController.php';
require_once __DIR__ . '/../src/controllers/groupeController.php';

// Instantiate the controllers
$filiereController = new filiereController();
$groupeController = new groupeController();

// ----------------------------
// Accueil and Login Routes
// ----------------------------

// Route: Accueil Page (Login Form)
Route::get('/', function () {
    require_once __DIR__ . '/../templates/acceuil.php';
});

// Route: Handle Login
Route::post('/login', function () {
    $username = request('username');
    $password = request('password');

    // Example: Hardcoded credentials
    $validUsername = 'admin';
    $validPassword = 'password';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['logged_in'] = true;
        header('Location: /admin/dashboard');
        exit;
    }

    echo "<p style='color: red;'>Nom d'utilisateur ou mot de passe incorrect !</p>";
    echo "<a href='/'>Retour à l'accueil</a>";
});

// Route: Admin Dashboard
Route::get('/admin/dashboard', function () use ($filiereController, $groupeController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }

    // Fetch filieres and groupes for the dashboard
    $filieres = $filiereController->index();
    $groupes = $groupeController->index();

    extract(['filieres' => $filieres, 'groupes' => $groupes]);
    require_once __DIR__ . '/../templates/admin/dashboard.php';
});


// Route: Handle Logout
Route::post('/logout', function () {
    $_SESSION['logged_in'] = false;
    header('Location: /');
    exit;
});

// ----------------------------
// Filières Routes
// ----------------------------

// Route: Display filières page
Route::get('/admin/filieres', function () use ($filiereController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $filieres = $filiereController->index();
    extract(['filieres' => $filieres]);
    require_once __DIR__ . '/../templates/admin/filieres.php';
});

// Route: Add a new filière
Route::post('/filieres/add', function () use ($filiereController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $name = request('name');
    $description = request('description');
    $_SESSION['success'] = $filiereController->store($id, $name, $description);
    header('Location: /admin/filieres');
    exit;
});

// Route: Edit a filière (Form)
Route::get('/admin/filieres/edit', function () use ($filiereController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $filieres = $filiereController->index();
    $filiere = null;

    // Find the filière with the matching ID
    foreach ($filieres as $f) {
        if ($f['id'] == $id) {
            $filiere = $f;
            break;
        }
    }

    $backUrl = '/admin/filieres'; // Define the URL to return to the filières list
    extract(['filiere' => $filiere, 'backUrl' => $backUrl]);
    require_once __DIR__ . '/../templates/admin/edit-filiere.php';
});

// Route: Update a filière
Route::post('/admin/filieres/update', function () use ($filiereController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $name = request('name');
    $description = request('description');
    $_SESSION['success'] = $filiereController->update($id, $name, $description);
    header('Location: /admin/filieres');
    exit;
});

// Route: Delete a filière
Route::post('/admin/filieres/delete', function () use ($filiereController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $_SESSION['success'] = $filiereController->destroy($id);
    header('Location: /admin/filieres');
    exit;
});

// ----------------------------
// Groupes Routes
// ----------------------------

// Route: Display groupes page
Route::get('/admin/groupes', function () use ($groupeController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $groupes = $groupeController->index();
    extract(['groupes' => $groupes]);
    require_once __DIR__ . '/../templates/admin/groupes.php';
});

// Route: Add a new groupe
Route::post('/groupes/add', function () use ($groupeController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $name = request('name');
    $filiereId = request('filiereId');
    $_SESSION['success'] = $groupeController->store($id, $name, $filiereId);
    
    // Redirect back to the dashboard after adding a group
    header('Location: /admin/dashboard');
    exit;
});

// Route: Edit a groupe (Form)
Route::get('/admin/groupes/edit', function () use ($groupeController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $groupes = $groupeController->index();
    $groupe = null;

    // Find the groupe with the matching ID
    foreach ($groupes as $g) {
        if ($g['id'] == $id) {
            $groupe = $g;
            break;
        }
    }
    $backUrl = '/admin/groupes'; // Define the URL to return to the filières list
    extract(['groupe' => $groupe, 'backUrl' => $backUrl]);
    require_once __DIR__ . '/../templates/admin/edit-groupe.php';
});

// Route: Update a groupe
Route::post('/admin/groupes/update', function () use ($groupeController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $name = request('name');
    $filiereId = request('filiereId');
    $_SESSION['success'] = $groupeController->update($id, $name, $filiereId);
    header('Location: /admin/groupes');
    exit;
});

// Route: Delete a groupe
Route::post('/admin/groupes/delete', function () use ($groupeController) {
    if (!$_SESSION['logged_in']) {
        header('Location: /');
        exit;
    }
    $id = request('id');
    $_SESSION['success'] = $groupeController->destroy($id);
    header('Location: /admin/groupes');
    exit;
});
