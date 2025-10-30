<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
include 'assets/incudes/db.php';


function uploadAfbeelding($file) {
    if (!empty($file['name'])) {
        $uploadDir = 'assets/img/';
        $fileName = basename($file['name']);
        $targetPath = $uploadDir . $fileName;

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes)) {
            echo "<p style='color:red;'>❌ Alleen JPG, JPEG, PNG of GIF toegestaan.</p>";
            return null;
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $fileName;
        } else {
            echo "<p style='color:red;'>❌ Upload mislukt.</p>";
            return null;
        }
    }
    return null;
}


if (isset($_POST['add'])) {
    $afbeeldingNaam = uploadAfbeelding($_FILES['afbeelding']);
    if ($afbeeldingNaam) {
        $stmt = $pdo->prepare("INSERT INTO artiesten (naam, genre, beschrijving, afbeelding) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['naam'], $_POST['genre'], $_POST['beschrijving'], $afbeeldingNaam]);
    }
}

// DELETE
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("SELECT afbeelding FROM artiesten WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    $row = $stmt->fetch();

    if ($row && file_exists("assets/img/" . $row['afbeelding'])) {
        unlink("assets/img/" . $row['afbeelding']);
    }

    $stmt = $pdo->prepare("DELETE FROM artiesten WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
}

// UPDATE
if (isset($_POST['update'])) {
    $afbeeldingNaam = $_POST['oude_afbeelding'];
    if (!empty($_FILES['afbeelding']['name'])) {
        $afbeeldingNaam = uploadAfbeelding($_FILES['afbeelding']);
    }

    $stmt = $pdo->prepare("UPDATE artiesten SET naam=?, genre=?, beschrijving=?, afbeelding=? WHERE id=?");
    $stmt->execute([$_POST['naam'], $_POST['genre'], $_POST['beschrijving'], $afbeeldingNaam, $_POST['id']]);
}

// READ
$stmt = $pdo->query("SELECT * FROM artiesten");
$artiesten = $stmt->fetchAll(PDO::FETCH_ASSOC);


// CREATE
if (isset($_POST['add_info'])) {
    $stmt = $pdo->prepare("INSERT INTO info_vakjes (titel1, tekst1, titel2, tekst2, titel3, tekst3) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['titel1'], $_POST['tekst1'], $_POST['titel2'], $_POST['tekst2'], $_POST['titel3'], $_POST['tekst3']]);
}

// UPDATE
if (isset($_POST['update_info'])) {
    $stmt = $pdo->prepare("UPDATE info_vakjes SET titel1=?, tekst1=?, titel2=?, tekst2=?, titel3=?, tekst3=? WHERE id=?");
    $stmt->execute([$_POST['titel1'], $_POST['tekst1'], $_POST['titel2'], $_POST['tekst2'], $_POST['titel3'], $_POST['tekst3'], $_POST['id']]);
}

// DELETE
if (isset($_GET['delete_info'])) {
    $stmt = $pdo->prepare("DELETE FROM info_vakjes WHERE id=?");
    $stmt->execute([$_GET['delete_info']]);
}

// READ
$stmt = $pdo->query("SELECT * FROM info_vakjes");
$info_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
    <div class="dashboard">
<h2>Welkom!</h2>
<a href="logout.php" class="logout-style">Logout</a>

<!-- CRUD voor artiesten -->
<h3>Voeg nieuwe artiest toe</h3>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="naam" placeholder="Naam" required>
    <input type="text" name="genre" placeholder="Genre" required>
    <input type="text" name="beschrijving" placeholder="Beschrijving" required>
    <input type="file" name="afbeelding" accept="image/*" required>
    <button type="submit" name="add">Toevoegen</button>
</form>

<h3>Huidige artiesten</h3>
<table border="1" cellpadding="6">
<tr>
    <th>ID</th>
    <th>Naam</th>
    <th>Genre</th>
    <th>Beschrijving</th>
    <th>Afbeelding</th>
    <th>Acties</th>
</tr>
</div>

<?php foreach ($artiesten as $artiest): ?>
<tr>
<form method="post" enctype="multipart/form-data">
    <td><?= htmlspecialchars($artiest['id']) ?><input type="hidden" name="id" value="<?= $artiest['id'] ?>"></td>
    <td><input type="text" name="naam" value="<?= htmlspecialchars($artiest['naam']) ?>"></td>
    <td><input type="text" name="genre" value="<?= htmlspecialchars($artiest['genre']) ?>"></td>
    <td><input type="text" name="beschrijving" value="<?= htmlspecialchars($artiest['beschrijving']) ?>"></td>
    <td>
        <img src="assets/img/<?= htmlspecialchars($artiest['afbeelding']) ?>" width="80"><br>
        <input type="file" name="afbeelding" accept="image/*">
        <input type="hidden" name="oude_afbeelding" value="<?= htmlspecialchars($artiest['afbeelding']) ?>">
    </td>
    <td>
        <button type="submit" name="update">Update</button>
        <a href="?delete=<?= $artiest['id'] ?>" onclick="return confirm('Weet je het zeker?')">Verwijder</a>
    </td>
</form>
</tr>
<?php endforeach; ?>
</table>

<!-- CRUD voor info_vakjes -->
<h3>Over-ons vakjes beheren</h3>

<form method="post">
    <label>Titel 1</label><br>
    <input type="text" name="titel1" required><br>
    <label>Tekst 1</label><br>
    <textarea name="tekst1" rows="3" cols="80" required></textarea><br><br>

    <label>Titel 2</label><br>
    <input type="text" name="titel2" required><br>
    <label>Tekst 2</label><br>
    <textarea name="tekst2" rows="3" cols="80" required></textarea><br><br>

    <label>Titel 3</label><br>
    <input type="text" name="titel3" required><br>
    <label>Tekst 3</label><br>
    <textarea name="tekst3" rows="3" cols="80" required></textarea><br><br>

    <button type="submit" name="add_info">Toevoegen</button>
</form>

<h3>Bestaande info-vakjes</h3>
<table border="1" cellpadding="6">
<tr>
    <th>ID</th>
    <th>Titel 1 / Tekst 1</th>
    <th>Titel 2 / Tekst 2</th>
    <th>Titel 3 / Tekst 3</th>
    <th>Acties</th>
</tr>
<?php foreach ($info_list as $info): ?>
<tr>
<form method="post">
    <td><?= $info['id'] ?><input type="hidden" name="id" value="<?= $info['id'] ?>"></td>
    <td>
        <input type="text" name="titel1" value="<?= htmlspecialchars($info['titel1']) ?>"><br>
        <textarea name="tekst1" rows="3" cols="30"><?= htmlspecialchars($info['tekst1']) ?></textarea>
    </td>
    <td>
        <input type="text" name="titel2" value="<?= htmlspecialchars($info['titel2']) ?>"><br>
        <textarea name="tekst2" rows="3" cols="30"><?= htmlspecialchars($info['tekst2']) ?></textarea>
    </td>
    <td>
        <input type="text" name="titel3" value="<?= htmlspecialchars($info['titel3']) ?>"><br>
        <textarea name="tekst3" rows="3" cols="30"><?= htmlspecialchars($info['tekst3']) ?></textarea>
    </td>
    <td>
        <button type="submit" name="update_info">Update</button><br><br>
        <a href="?delete_info=<?= $info['id'] ?>" onclick="return confirm('Weet je het zeker?')">Verwijder</a>
    </td>
</form>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>
