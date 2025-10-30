<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Music Info</title>
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

  <?php include 'assets/incudes/header.php' ?>


<main>
  <section class="hero">
    <div class="hero-content">
      <h1 class="hero-title">Welkom bij Artist Info</h1>
      <p class="hero-slogan">alles over je artiesten!!</p>
      <p class="hero-text">
        Op deze site vind je informatie over je favoriete artiesten.
        Duik in onze catalogus en ontdek nieuwe artiesten die perfect bij jouw stijl past.
      </p>
      <a href="catalogus.php" class="hero-button">Bekijk de Catalogus</a>
    <a href="#" class="hero-button" id="scroll-down">Naar beneden</a>
    </div>
  </section>
  <section class="about">
  <h2>Over Music Info</h2>
  <?php
include 'assets/incudes/db.php';

$stmt = $pdo->query("SELECT * FROM info_vakjes LIMIT 1");
$info = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="about-grid">
  <div class="about-card">
    <h3><?= htmlspecialchars($info['titel1'] ?? 'Ontdek artiesten') ?></h3>
    <p><?= nl2br(htmlspecialchars($info['tekst1'] ?? 'Vind nieuwe artiesten en genres...')) ?></p>
  </div>

  <div class="about-card">
    <h3><?= htmlspecialchars($info['titel2'] ?? 'Leer meer') ?></h3>
    <p><?= nl2br(htmlspecialchars($info['tekst2'] ?? 'Lees meer informatie over artiesten...')) ?></p>
  </div>

  <div class="about-card">
    <h3><?= htmlspecialchars($info['titel3'] ?? 'Over ons') ?></h3>
    <p><?= nl2br(htmlspecialchars($info['tekst3'] ?? 'Deze website is gemaakt door Sebastiaan Kuper...')) ?></p>
  </div>
</div>

</section>
</main>



  

  <?php include 'assets/incudes/footer.php' ?>
  <script>
  const button = document.getElementById('scroll-down');

  button.addEventListener('click', function(e) {
    e.preventDefault(); // voorkomt dat de pagina naar boven springt
    window.scrollBy({
      top: 950,      
      left: 0,
      behavior: 'smooth'
    });
  });
</script>

</body>
</html>
