<?php 
include '../includes/auth.php';
include '../includes/db.php';

$stmt = $pdo->prepare("SELECT * FROM recettes ORDER BY date_creation DESC");
$stmt->execute();
$recettes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recettes Utilisateur</title>
    <style>
        :root {
          --color-primary: #d63384;
          --color-secondary: #ff65a3;
          --color-bg-gradient-start: rgba(255, 192, 203, 0.7);
          --color-bg-gradient-end: rgba(255, 182, 193, 0.9);
          --color-text-dark: #4a0033;
          --color-text-light: #fff0f7;
          --shadow-light: rgba(255, 105, 180, 0.4);
          --shadow-strong: rgba(255, 105, 180, 0.6);
          --shadow-hover: rgba(255, 192, 203, 0.5);
          --font-sans: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          --border-radius: 25px;
        }

        *,
        *::before,
        *::after {
          box-sizing: border-box;
        }

        body {
          margin: 0;
          font-family: var(--font-sans);
          background:
            linear-gradient(to bottom, var(--color-bg-gradient-start), var(--color-bg-gradient-end)),
            url('https://www.grizette.com/wp-content/uploads/2021/04/Patisserie-Montpellier%C2%A9Edalin-AdobeStock.jpeg') no-repeat center center fixed;
          background-size: cover;
          color: var(--color-text-dark);
          perspective: 1100px;
          overflow-x: hidden;
          min-height: 100vh;
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 20px;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
        }

        h2 {
          font-size: clamp(1.8rem, 4vw, 2.8rem);
          color: var(--color-primary);
          text-shadow: 0 0 10px var(--color-secondary);
          margin: 40px 0 30px 0;
          font-weight: 700;
          text-align: center;
          letter-spacing: 0.03em;
        }

        .logout-btn {
          display: inline-block;
          padding: 14px 32px;
          margin-bottom: 40px;
          background: linear-gradient(135deg, #ff7eb9, var(--color-secondary));
          color: var(--color-text-light);
          font-weight: 700;
          border-radius: 40px;
          text-decoration: none;
          box-shadow:
            0 5px 15px var(--shadow-light),
            inset 0 -3px 5px rgba(255 255 255 / 0.3);
          transition:
            transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            filter 0.3s ease;
          will-change: transform;
          user-select: none;
        }

        .logout-btn:hover,
        .logout-btn:focus-visible {
          transform: scale(1.1) translateZ(0);
          box-shadow:
            0 8px 25px var(--shadow-strong),
            inset 0 -3px 6px rgba(255 255 255 / 0.4);
          filter: brightness(1.1);
          outline-offset: 4px;
        }

        ul {
          list-style: none;
          padding: 0;
          margin: 0 auto 80px auto;
          max-width: 1280px;
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
          gap: 48px 36px;
          perspective: 1200px;
        }

        li {
          background: rgba(255 240 250 / 0.7);
          padding: 26px 24px 32px 24px;
          border-radius: var(--border-radius);
          box-shadow:
            0 12px 30px rgba(255, 105, 180, 0.25),
            0 0 20px rgba(255, 192, 203, 0.15);
          backdrop-filter: blur(14px);
          transition:
            transform 0.55s cubic-bezier(0.25, 1, 0.5, 1),
            box-shadow 0.55s ease;
          color: #66003f;
          cursor: default;
          transform-style: preserve-3d;
          will-change: transform;
          display: flex;
          flex-direction: column;
          align-items: stretch;
          min-height: 400px;
          position: relative;
        }

        li:hover,
        li:focus-within {
          transform: rotateY(15deg) scale(1.06) translateZ(10px);
          box-shadow:
            0 20px 50px var(--shadow-hover),
            0 0 40px rgba(255, 182, 193, 0.35);
          z-index: 2;
        }

        li img {
          border-radius: 15px;
          object-fit: cover;
          height: 200px;
          width: 100%;
          box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
          transition: transform 0.5s ease;
          margin-bottom: 18px;
          flex-shrink: 0;
        }

        li:hover img {
          transform: scale(1.05);
        }

        li strong {
          font-size: 1.6rem;
          color: var(--color-primary);
          margin-bottom: 14px;
          font-weight: 700;
          text-shadow: 1px 1px 3px rgba(255 182 193 / 0.7);
          letter-spacing: 0.02em;
          user-select: text;
          line-height: 1.3;
        }

        li:not(:hover) {
          transition-timing-function: ease-out;
        }

        .shape {
          position: fixed;
          border-radius: 50%;
          opacity: 0.16;
          animation: float 14s infinite alternate ease-in-out;
          pointer-events: none;
          z-index: 0;
          filter: drop-shadow(0 0 6px rgba(255, 105, 180, 0.25));
        }

        .shape.one {
          width: 220px;
          height: 220px;
          background: #ffb6c1;
          top: 7%;
          left: 6%;
          animation-delay: 0s;
        }

        .shape.two {
          width: 170px;
          height: 170px;
          background: #ffcce0;
          bottom: 9%;
          right: 7%;
          animation-delay: 5s;
        }

        @keyframes float {
          from { transform: translateY(0) rotate(0deg); }
          to { transform: translateY(-45px) rotate(360deg); }
        }

        @media (max-width: 600px) {
          h2 {
            font-size: 2.2rem;
            margin-top: 30px;
          }

          .logout-btn {
            padding: 12px 26px;
            font-size: 0.95rem;
            margin-bottom: 30px;
          }

          ul {
            gap: 30px 24px;
          }

          li {
            min-height: auto;
            padding: 18px 18px 28px 18px;
          }

          li img {
            height: 160px;
            margin-bottom: 14px;
          }

          li strong {
            font-size: 1.3rem;
            margin-bottom: 10px;
          }
        }
    </style>
</head>
<body>
    <div class="shape one"></div>
    <div class="shape two"></div>

    <h2>Liste des Recettes</h2>

    <ul>
        <?php foreach ($recettes as $recette): ?>
            <li tabindex="0">
                <?php if (!empty($recette['image_url'])): ?>
                    <img src="<?= htmlspecialchars($recette['image_url']) ?>" alt="Image de la recette">
                <?php endif; ?>
                <strong><?= htmlspecialchars($recette['titre']) ?></strong>
                <?= nl2br(htmlspecialchars($recette['description'])) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>