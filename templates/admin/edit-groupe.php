<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Groupe</title>
</head>
<body>
    <h1>Modifier Groupe</h1>
    <form method="POST" action="/admin/groupes/update">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($groupe['id']) ?>">
        <label>Nom:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($groupe['name']) ?>" required>
        <label>Filière ID:</label>
        <input type="text" name="filiereId" value="<?= htmlspecialchars($groupe['filiereId']) ?>" required>
        <button type="submit">Mettre à Jour</button>
    </form>
    <br>
    <a href="<?= $backUrl ?>">Retour au Tableau de Bord</a>
</body>
</html>
