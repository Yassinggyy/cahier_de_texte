<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Filière</title>
</head>
<body>
    <h1>Modifier Filière</h1>
    <form method="POST" action="/admin/filieres/update">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($filiere['id']) ?>">
        <label>Nom:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($filiere['name']) ?>" required>
        <label>Description:</label>
        <input type="text" name="description" value="<?= htmlspecialchars($filiere['description']) ?>">
        <button type="submit">Mettre à Jour</button>
    </form>
    <br>
    <a href="<?= $backUrl ?>">Retour au Tableau de Bord</a>
</body>
</html>
