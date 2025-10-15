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
      <h1 class="hero-title">Welkom bij Music Info</h1>
      <p class="hero-slogan">Alles over je muziek!</p>
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
  <div class="about-grid">
    <div class="about-card">
      <h3>Ontdek artiesten</h3>
      <p>
        Vind nieuwe artiesten en genres die perfect passen bij jouw smaak.
        Onze site helpt je nieuwe favorieten artiesten te ontdekken.
      </p>
    </div>

    <div class="about-card">
      <h3>Leer Meer</h3>
      <p>
        Lees meer informatie over artiesten, hun geschiedenis en de betekenis achter de nummers.
      </p>
    </div>

    <div class="about-card">
      <h3>over ons</h3>
      <p>
        Deze website is gemaakt door sebastiaan Kuper zodat mensen hun informatie kunnen vinden over muziek
      </p>
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
