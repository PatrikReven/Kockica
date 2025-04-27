<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uporabniki = [];

    for ($i = 1; $i <= 3; $i++) {
        $uporabniki[] = [
            'ime' => $_POST["ime$i"],
            'priimek' => $_POST["priimek$i"],
            'naslov' => $_POST["naslov$i"]
        ];
    }

    $_SESSION['uporabniki'] = $uporabniki;
}

$uporabniki = $_SESSION['uporabniki'] ?? [];
$rezultati = [];

foreach ($uporabniki as $index => $user) {
    $rezultati[$index] = [];
    for ($j = 0; $j < 3; $j++) {
        $rezultati[$index][] = rand(1, 6);
    }
}

$vsote = array_map(fn($met) => array_sum($met), $rezultati);
$najvecja_vsota = max($vsote);
$zmagovalci = array_keys($vsote, $najvecja_vsota);
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Rezultati igre</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
</head>
<body class="rezultati-page">

<h1>Rezultati igre</h1>

<?php foreach ($uporabniki as $index => $user): ?>
    <div class="user">
        <h2><?= htmlspecialchars($user['ime'] . ' ' . $user['priimek']) ?></h2>
        <p><?= htmlspecialchars($user['naslov']) ?></p>
        <div class="dice">
            <?php foreach ($rezultati[$index] as $vrednost): ?>
                <img src="http://193.2.139.22/dice/<?= $vrednost ?>.png" alt="kocka <?= $vrednost ?>">
            <?php endforeach; ?>
        </div>
        <p>Vsota: <?= array_sum($rezultati[$index]) ?></p>
    </div>
<?php endforeach; ?>

<div class="winner">
    <?php if (count($zmagovalci) > 1): ?>
        <p>Več zmagovalcev! Čestitke vsem!</p>
    <?php else: ?>
        <p>Zmagovalec: <?= htmlspecialchars($uporabniki[$zmagovalci[0]]['ime'] . ' ' . $uporabniki[$zmagovalci[0]]['priimek']) ?></p>
    <?php endif; ?>
</div>

<div class="countdown">
    Preusmeritev nazaj čez <span id="timer">10</span> sekund...
</div>

<!-- Zvok dice roll in winner -->
<audio id="diceSound" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_2e5b3bfa3f.mp3?filename=dice-rolling-9823.mp3"></audio>
<audio id="winnerSound" src="https://cdn.pixabay.com/download/audio/2021/08/04/audio_69d65c5e50.mp3?filename=small-crowd-cheering-ii-8130.mp3"></audio>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
</body>
</html>
