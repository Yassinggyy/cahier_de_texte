<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filières</title>
</head>
<body>
    <h1>Liste des Filières</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Table of Filières -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
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
                        <a href="/admin/filieres/edit?id=<?= htmlspecialchars($filiere['id']) ?>">Edit</a>
                        <form method="POST" action="/admin/filieres/delete" style="display:inline;">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($filiere['id']) ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form to Add a New Filière -->
    <h2>Ajouter une Filière</h2>
    <form method="POST" action="/filieres/add">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description">
        <br>
        <button type="submit">Add Filière</button>
    </form>
</body>
</html>
