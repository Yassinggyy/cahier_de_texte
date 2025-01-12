<?php
if (!$_SESSION['logged_in']) {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Tableau de Bord</h1>

    <!-- Filières Table -->
    <h2>Filières</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filieres as $filiere): ?>
                <tr>
                    <td><?= htmlspecialchars($filiere['id']) ?></td>
                    <td><?= htmlspecialchars($filiere['name']) ?></td>
                    <td><?= htmlspecialchars($filiere['description']) ?></td>
                    <td>
                        <a href="/admin/filieres/edit?id=<?= htmlspecialchars($filiere['id']) ?>">Modifier</a>
                        <form method="POST" action="/admin/filieres/delete" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?');" style="display:inline;">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($filiere['id']) ?>">
                            <button type="submit">Supprimer</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Filière Form -->
    <h3>Ajouter une Filière</h3>
    <form method="POST" action="/filieres/add">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <label>ID:</label>
        <input type="text" name="id" required>
        <label>Nom:</label>
        <input type="text" name="name" required>
        <label>Description:</label>
        <input type="text" name="description">
        <button type="submit">Ajouter</button>
    </form>

    <hr>

    <!-- Groupes Table -->
    <h2>Groupes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Filière ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupes as $groupe): ?>
                <tr>
                    <td><?= htmlspecialchars($groupe['id']) ?></td>
                    <td><?= htmlspecialchars($groupe['name']) ?></td>
                    <td><?= htmlspecialchars($groupe['filiereId']) ?></td>
                    <td>
                        <a href="/admin/groupes/edit?id=<?= htmlspecialchars($groupe['id']) ?>">Modifier</a>
                        <form method="POST" action="/admin/groupes/delete" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');" style="display:inline;">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($groupe['id']) ?>">
                            <button type="submit">Supprimer</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Groupe Form -->
    <h3>Ajouter un Groupe</h3>
    <form method="POST" action="/groupes/add">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <label>ID:</label>
        <input type="text" name="id" required>
        <label>Nom:</label>
        <input type="text" name="name" required>
        <label>Filière ID:</label>
        <input type="text" name="filiereId" required>
        <button type="submit">Ajouter</button>
    </form>

    <hr>

    <!-- Logout -->
    <form method="POST" action="/logout">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <button type="submit">Se Déconnecter</button>
    </form>
</body>
</html>
