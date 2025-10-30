<?php
  include 'assets/incudes/db.php';

// Controleer of er een id is meegegeven
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldige artiest-ID.");
}

$id = (int)$_GET['id'];

// Haal artiest op uit de database (voorkom SQL-injectie met prepared statement)
$stmt = $pdo->prepare("SELECT * FROM artiesten WHERE id = ?");
$stmt->execute([$id]);
$artiest = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$artiest) {
    die("Artiest niet gevonden.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($artiest['naam']); ?> - Details</title>
    <link rel="stylesheet" href="style.css"> <!-- jouw hoofdcss -->
    <style>
        .detail-container {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .detail-card {
            background-color: #1f1f1f;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(58, 12, 163, 0.4);
            max-width: 700px;
            padding: 30px;
            text-align: center;
        }

        .detail-card img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .detail-card h2 {
            color: #d0bfff;
            margin-bottom: 10px;
        }

        .detail-card p {
            color: #ddd;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .detail-card .genre {
            color: #a4508b;
            font-weight: 600;
        }

        .back-button {
            display: inline-block;
            background: linear-gradient(135deg, #3a0ca3, #000000);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: linear-gradient(135deg, #5f0f40, #000000);
            box-shadow: 0 6px 18px rgba(95, 15, 64, 0.6);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="detail-container">
    <div class="detail-card">
        <img src="assets/img/<?php echo htmlspecialchars($artiest['afbeelding']); ?>" 
             alt="<?php echo htmlspecialchars($artiest['naam']); ?>">

        <h2><?php echo htmlspecialchars($artiest['naam']); ?></h2>
        <p class="genre"><strong>Genre:</strong> <?php echo htmlspecialchars($artiest['genre']); ?></p>
        <p class="beschrijving"><?php echo nl2br(htmlspecialchars($artiest['beschrijving'])); ?></p>

        <a href="catalogus.php" class="back-button">← Terug naar overzicht</a>
    </div>
</div>

</body>
</html>
