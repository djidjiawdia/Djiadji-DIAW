<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 5</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="numbers">Entrer des numeros de Tels</label>
                <textarea name="numbers" id="numbers" class="form-control"><?= @$_POST['numbers']; ?></textarea>
            </div>
            <button class="btn" name="valider">Valider</button>
        </form>
    </div>
</body>
</html>