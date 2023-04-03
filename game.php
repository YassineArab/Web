<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number and Letter Game</title>
    <script>
        let currentLevel = 1;

        function submitForm() {
            event.preventDefault();
            const inputField = document.getElementById('user-input');
            const result = document.getElementById('result');
            const nextLevelButton = document.getElementById('next-level');
            const tryAgainButton = document.getElementById('try-again');

            let correctAnswer;
            if (currentLevel === 1) {
                correctAnswer = '9,11,36,41,54,62';
            } else if (currentLevel === 2) {
                correctAnswer = 'a,b,c,d,e,f';
            } else if (currentLevel === 3) {
                correctAnswer = 'A,B,C,D,E,F';
            }

            if (inputField.value === correctAnswer) {
                result.textContent = 'Correct!';
                nextLevelButton.style.display = 'inline-block';
                tryAgainButton.style.display = 'none';
            } else {
                result.textContent = 'Incorrect!';
                nextLevelButton.style.display = 'none';
                tryAgainButton.style.display = 'inline-block';
            }
        }

        function nextLevel() {
            currentLevel++;
            updateLevelInfo();
        }

        function tryAgain() {
            updateLevelInfo();
        }

        function updateLevelInfo() {
        const levelInfo = document.getElementById('level-info');
        const nextLevelButton = document.getElementById('next-level');
        const tryAgainButton = document.getElementById('try-again');
        const result = document.getElementById('result');
        const inputField = document.getElementById('user-input');

        if (currentLevel === 1) {
            levelInfo.textContent = 'Level 1: Order these numbers in ascending order (9, 11, 36, 41, 54, 62)';
        } else if (currentLevel === 2) {
            levelInfo.textContent = 'Level 2: Order these lowercase letters in alphabetical order (f, e, d, c, b, a)';
        } else if (currentLevel === 3) {
            levelInfo.textContent = 'Level 3: Order these uppercase letters in alphabetical order (F, E, D, C, B, A)';
        }

        inputField.value = '';
        result.textContent = '';
        nextLevelButton.style.display = 'none';
        tryAgainButton.style.display = 'none';

        function showFinalResult(isWinner) {
        const resultMessage = isWinner
            ? "Congratulations, you've completed the final level!"
            : "Game over. Better luck next time!";
        document.getElementById("final-result-message").innerText = resultMessage;
        document.getElementById("final-result-buttons").style.display = "block";
    }

    
    const isLastLevel = true;

    if (isLastLevel) {
        
        const isWinner = true;
        showFinalResult(isWinner);
    }

        
    }
</script>
</head>
<body onload="updateLevelInfo()">
    <h1>Number and Letter Game</h1>
    <p id="level-info"></p>
    <form onsubmit="event.preventDefault(); submitForm();">
        <label for="user-input">Your input (separated by commas):</label>
        <input type="text" id="user-input" required>
        <button type="submit">Submit</button>
    </form>
    <p id="result"></p>
    <button id="next-level" onclick="nextLevel()" style="display: none;">Go to the Next Level</button>
    <button id="try-again" onclick="tryAgain()" style="display: none;">Try Again this Level</button>
    <button id="sign-out" onclick="location.href='logout.php'">Sign Out</button>
    <button id="stop-session" onclick="location.href='index.php'">Stop this Session</button>
<div id="final-result-message"></div>
<div id="final-result-buttons" style="display: none;">
    <button onclick="location.reload();">Play Again</button>
    <button onclick="window.location.href = 'index.php';">Home Page</button>
    <button onclick="window.location.href = 'logout.php';">Sign Out</button>
</div>


<div id="game-container">
  <p>Our numbers: <span id="our-numbers"></span></p>
  <p>Instructions: order these numbers in ascending order</p>
  <form id="game-form">
    <input type="text" id="user-numbers" placeholder="Enter numbers separated by commas">
    <button type="submit">Submit</button>
  </form>
  <p id="result-message"></p>
</div>

</body>
</html>
