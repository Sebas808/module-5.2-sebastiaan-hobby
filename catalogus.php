 <link rel="stylesheet" href="assets/style.css" />

 <?php include 'assets/incudes/db.php' ?>
  <?php include 'assets/incudes/header.php' ?>
<?php
// Haal alle artiesten op uit de database
$stmt = $pdo->query('SELECT * FROM artiesten ORDER BY naam ASC');
$artiesten = $stmt->fetchAll();
?>
<main>
    <section class="catalogus">
        <h2>Onze Artiesten</h2>

        <div class="catalogus-grid">
            <?php foreach($artiesten as $artiest): ?>
                <div class="catalogus-card">
                    <div class="catalogus-image">
                        <img src="assets/img/<?php echo htmlspecialchars($artiest['afbeelding']); ?>" 
                             alt="<?php echo htmlspecialchars($artiest['naam']); ?>">
                    </div>

                    <div class="catalogus-info">
                        <h3><?php echo htmlspecialchars($artiest['naam']); ?></h3>
                        <p class="genre"><strong>Genre:</strong> <?php echo htmlspecialchars($artiest['genre']); ?></p>
                        <p class="beschrijving">
                            <?php echo htmlspecialchars(substr($artiest['beschrijving'], 0, 100)) . '...'; ?>
                        </p>
                    </div>

                    <a href="artiest_detail.php?id=<?php echo $artiest['id']; ?>" class="catalogus-button">
                        Bekijk meer
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>


 <?php include 'assets/incudes/footer.php' ?>;