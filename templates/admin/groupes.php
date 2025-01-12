<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groupes</title>
</head>
<body>
    <h1>Liste des Groupes</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Table of Groupes -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Filière ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupes as $group): ?>
                <tr>
                    <td><?= htmlspecialchars($group['id']) ?></td>
                    <td><?= htmlspecialchars($group['name']) ?></td>
                    <td><?= htmlspecialchars($group['filiereId']) ?></td>
                    <td>
                        <a href="/admin/groupes/edit?id=<?= htmlspecialchars($group['id']) ?>">Edit</a>
                        <form method="POST" action="/admin/groupes/delete" style="display:inline;">
                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($group['id']) ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Form to Add a New Group -->
    <h2>Ajouter un Groupe</h2>
    <form method="POST" action="/groupes/add">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="filiereId">Filière ID:</label>
        <input type="text" id="filiereId" name="filiereId" required>
        <br>
        <button type="submit">Add Group</button>
    </form>
</body>
</html>
