<?php include 'pure_php.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP demo BSIT NT 3102</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="music-lines" aria-hidden="true"></div>
    <button id="themeToggle" class="theme-toggle" type="button" aria-label="Toggle dark mode">🌙</button>
    <div class="sparkle-field" aria-hidden="true"></div>

    <div class="page-shell">
        <div class="profile-card" id="profileCard">
            <div class="glow glow-one"></div>
            <div class="glow glow-two"></div>

            <div class="profile-header">
                <div class="avatar"><?php echo strtoupper(substr($username, 0, 1)); ?></div>
                <div>
                    <span class="tag">Sweet profile</span>
                    <h1 class="welcome-text" data-text="Hello, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>!"></h1>
                </div>
            </div>

            <p class="intro">You are glowing today, and your demo page is looking extra cute.</p>

            <div class="details-grid">
                <div class="detail-box">
                    <span>Username</span>
                    <strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></strong>
                </div>
                <div class="detail-box">
                    <span>User ID</span>
                    <strong><?php echo htmlspecialchars((string)$user_id, ENT_QUOTES, 'UTF-8'); ?></strong>
                </div>
            </div>

            <div class="action-row">
                <a href="next_page.php">Go to next page</a>
                <button id="greetButton" type="button">Greet User</button>
            </div>

            <p class="message"><?php echo "Hello World"; ?></p>
        </div>
    </div>

    <script>
        const username = <?php echo json_encode($username, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
        const themeToggle = document.getElementById('themeToggle');
        const profileCard = document.getElementById('profileCard');
        const greetButton = document.getElementById('greetButton');
        const welcomeText = document.querySelector('.welcome-text');
        const sparkleField = document.querySelector('.sparkle-field');

        function createHeart() {
            const heart = document.createElement('div');
            heart.className = 'heart';
            heart.textContent = '❤';
            heart.style.left = Math.random() * 100 + 'vw';
            heart.style.animationDuration = (Math.random() * 3 + 4).toFixed(2) + 's';
            heart.style.setProperty('--drift', (Math.random() * 140 - 70).toFixed(0) + 'px');
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 5000);
        }

        setInterval(createHeart, 500);

        function typeText(element, text, speed = 90) {
            let index = 0;
            element.textContent = '';

            function tick() {
                if (index <= text.length) {
                    element.textContent = text.slice(0, index);
                    index++;
                    setTimeout(tick, speed);
                }
            }

            tick();
        }

        if (welcomeText) {
            const fullText = welcomeText.dataset.text || 'Hello, friend!';
            typeText(welcomeText, fullText, 70);
        }

        function makeSparkle() {
            if (!sparkleField) return;

            const sparkle = document.createElement('span');
            sparkle.className = 'sparkle';
            sparkle.style.left = Math.random() * 100 + '%';
            sparkle.style.top = Math.random() * 100 + '%';
            sparkle.style.animationDuration = (Math.random() * 1.4 + 1.1).toFixed(2) + 's';
            sparkle.style.setProperty('--dx', (Math.random() * 120 - 60).toFixed(0) + 'px');
            sparkle.style.setProperty('--dy', (Math.random() * 80 - 40).toFixed(0) + 'px');
            sparkleField.appendChild(sparkle);

            setTimeout(() => sparkle.remove(), 1800);
        }

        setInterval(makeSparkle, 500);

        function showPopup(message) {
            const popup = document.createElement('div');
            popup.className = 'popup';
            popup.textContent = message;
            document.body.appendChild(popup);

            setTimeout(() => popup.remove(), 1200);
        }

        function greetUser() {
            const message = 'Hello, ' + username + '!';
            showPopup(message);
        }

        if (greetButton) {
            greetButton.addEventListener('click', greetUser);
        }

        if (profileCard) {
            profileCard.addEventListener('pointermove', function (event) {
                const rect = profileCard.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;
                const rotateY = ((x / rect.width) - 0.5) * 12;
                const rotateX = (0.5 - (y / rect.height)) * 12;

                profileCard.style.setProperty('--tilt-x', rotateX.toFixed(2) + 'deg');
                profileCard.style.setProperty('--tilt-y', rotateY.toFixed(2) + 'deg');
                profileCard.classList.add('tilted');
            });

            profileCard.addEventListener('pointerleave', function () {
                profileCard.style.setProperty('--tilt-x', '0deg');
                profileCard.style.setProperty('--tilt-y', '0deg');
                profileCard.classList.remove('tilted');
            });
        }

        if (themeToggle) {
            themeToggle.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                themeToggle.textContent = isDark ? '☀️' : '🌙';
            });
        }

        document.querySelectorAll('a, button').forEach(function (button) {
            button.addEventListener('mouseenter', function () {
                button.style.transform = 'translateY(-2px) scale(1.02)';
            });

            button.addEventListener('mouseleave', function () {
                button.style.transform = '';
            });
        });
    </script>
</body>
</html>
