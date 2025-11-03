 <?php include 'assets/incudes/header.php' ?>
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
    <link rel="stylesheet" href="assets/style.css" />
    
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
 <?php include 'assets/incudes/footer.php' ?>
</body>
</html>
