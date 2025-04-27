<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Shranite uporabnike v dvodimenzionalno tabelo
    $_SESSION['users'] = [
        ['ime' => $_POST['ime1'], 'priimek' => $_POST['priimek1'], 'naslov' => $_POST['naslov1']],
        ['ime' => $_POST['ime2'], 'priimek' => $_POST['priimek2'], 'naslov' => $_POST['naslov2']],
        ['ime' => $_POST['ime3'], 'priimek' => $_POST['priimek3'], 'naslov' => $_POST['naslov3']],
    ];
    header("Location: game.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gambling Room - Prijava</title>
</head>
<body>
    <div class="background">
        <div class="container">
            <h1 class="title">Dobrodošli v <span class="highlight">Gambling Room</span></h1>
            <form method="POST">
                <?php for ($i = 1; $i <= 3; $i++): ?>
                    <div class="user-card">
                        <h2>Uporabnik <?= $i ?></h2>
                        <label>Ime: <input type="text" name="ime<?= $i ?>" required></label>
                        <label>Priimek: <input type="text" name="priimek<?= $i ?>" required></label>
                        <label>Naslov: <input type="text" name="naslov<?= $i ?>" required></label>
                    </div>
                <?php endfor; ?>
                <button type="submit" class="btn">Začni igro</button>
            </form>
        </div>
    </div>
</body>
</html>
