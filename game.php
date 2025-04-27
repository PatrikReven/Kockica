<?php
session_start();

if (!isset($_SESSION['users'])) {
    header("Location: index.php");
    exit;
}

// Generirajte rezultate meta kock, če še niso generirani
if (!isset($_SESSION['results'])) {
    $_SESSION['results'] = [];
    foreach ($_SESSION['users'] as $key => $user) {
        $_SESSION['results'][$key] = [
            rand(1, 6),
            rand(1, 6),
            rand(1, 6),
        ];
    }
}

$users = $_SESSION['users'];
$results = $_SESSION['results'];
$totals = array_map(fn($rolls) => array_sum($rolls), $results);
$maxScore = max($totals);
$winners = array_keys($totals, $maxScore);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gambling Room - Rezultati</title>
</head>
<body>
    <div class="background">
        <div class="container">
            <h1 class="title">Rezultati igre</h1>
            <div class="results">
                <?php foreach ($users as $index => $user): ?>
                    <div class="player-card">
                        <h2><?= htmlspecialchars($user['ime']) ?> <?= htmlspecialchars($user['priimek']) ?></h2>
                        <p>Naslov: <?= htmlspecialchars($user['naslov']) ?></p>
                        <div class="dice-row">
                            <?php foreach ($results[$index] as $roll): ?>
                                <img src="http://193.2.139.22/dice/<?= $roll ?>.png" alt="Kocka <?= $roll ?>" class="dice">
                            <?php endforeach; ?>
                        </div>
                        <p class="score">Skupni rezultat: <?= $totals[$index] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="winner">
                <h2>Zmagovalec:</h2>
                <?php foreach ($winners as $winnerIndex): ?>
                    <p><?= htmlspecialchars($users[$winnerIndex]['ime']) ?> <?= htmlspecialchars($users[$winnerIndex]['priimek']) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 10000);
        </script>
    </div>
</body>
</html>
