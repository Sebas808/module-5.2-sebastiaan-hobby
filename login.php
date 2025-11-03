<?php
session_start();
include 'assets/incudes/db.php'; // let op: juiste mapnaam

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Veilig query uitvoeren
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Correct wachtwoord
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Ongeldig wachtwoord.";
        }
    } else {
        $error = "❌ Gebruiker niet gevonden.";
    }
}
?>



<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="assets/style.css" />
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #0f0f0f;
      color: #fff;
      font-family: Arial, sans-serif;
    }
    .login-container {
      background: #1a1a1a;
      padding: 30px;
      border-radius: 10px;
      width: 350px;
      box-shadow: 0 0 15px rgba(0,0,0,0.4);
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: purple;
    }
    .login-container input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 6px;
      background: #333;
      color: #fff;
    }
    .login-container button {
      width: 100%;
      background: #808080ff;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }
    .login-container button:hover {
      background: purple;
    }
    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2>Inloggen</h2>
  <form method="post">
    <input type="text" name="username" placeholder="Gebruikersnaam" required>
    <input type="password" name="password" placeholder="Wachtwoord" required>
    <button type="submit">Login</button>
  </form>
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
</div>

</body>
</html>