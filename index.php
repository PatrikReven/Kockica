<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Kocke - Vnos uporabnikov</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="vnos-page">

<div class="container">
    <h1>Vnesi uporabnike</h1>
    <form action="play.php" method="post">
        <?php for($i = 1; $i <= 3; $i++): ?>
            <input type="text" name="ime<?= $i ?>" placeholder="Ime uporabnika <?= $i ?>" required>
            <input type="text" name="priimek<?= $i ?>" placeholder="Priimek uporabnika <?= $i ?>" required>
            <input type="text" name="naslov<?= $i ?>" placeholder="Naslov uporabnika <?= $i ?>" required>
        <?php endfor; ?>
        <button type="submit">Začni igro</button>
    </form>
</div>

</body>
</html>
