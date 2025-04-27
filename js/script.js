let timeLeft = 10;

function countdown() {
    if(timeLeft <= 0){
        window.location.href = "index.php";
    } else {
        document.getElementById("timer").innerText = timeLeft;
        timeLeft -= 1;
        setTimeout(countdown, 1000);
    }
}

window.onload = function() {
    // Predvajaj dice zvok
    const diceSound = document.getElementById('diceSound');
    if (diceSound) diceSound.play();

    countdown();

    // Po 2 sekundah predvajaj winner zvok in sproži konfete
    setTimeout(() => {
        const winnerSound = document.getElementById('winnerSound');
        if (winnerSound) winnerSound.play();

        // Pokliči konfeti funkcijo
        startConfetti();
    }, 2000);
};

// KONFETI EFEKT
function startConfetti() {
    const duration = 5 * 1000;
    const animationEnd = Date.now() + duration;
    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000 };

    function randomInRange(min, max) {
      return Math.random() * (max - min) + min;
    }

    const interval = setInterval(function() {
      const timeLeft = animationEnd - Date.now();

      if (timeLeft <= 0) {
        return clearInterval(interval);
      }

      confetti({
        particleCount: 5,
        angle: randomInRange(55, 125),
        spread: randomInRange(50, 70),
        origin: { x: Math.random(), y: Math.random() - 0.2 },
        ...defaults
      });
    }, 250);
}
