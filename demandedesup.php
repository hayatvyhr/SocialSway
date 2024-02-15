<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
unset($_SESSION['message']); 
if (!isset($_SESSION['id'])) {
  
  header("Location: login.php");

  exit();
}
try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet1;port=3306", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
} catch (PDOException $e) {
  die("Error: could not connect" . $e->getMessage());
}
$user = null;
$inf = null;

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];

  $st = $pdo->prepare("SELECT * FROM Marque WHERE id=:id");
  $st->bindParam(':id', $id);
  $st->execute();
  $user = $st->fetch(PDO::FETCH_ASSOC);
}

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];

  $st = $pdo->prepare("SELECT * FROM influencer WHERE id=:id");
  $st->bindParam(':id', $id);
  $st->execute();
  $inf = $st->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Page</title>
</head>
<body>
<?php if ($user): ?>
    <h2>Message from User: <?php echo $user['nom']; ?></h2>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>NOM COMPLET De Représentant: <?php echo $user['nomderep'] . ' ' . $user['prenomderep']; ?></p>

<?php endif; ?>
<?php if ($inf): ?>
    <h2>Message from User: <?php echo $inf['nom']; ?></h2>
    <p>Email: <?php echo $inf['email']; ?></p>
    <p>NOM: <?php echo $inf['prénom']; ?></p>
   
<?php endif; ?>

<p><b>the message:</b> <?php echo $message; ?></p>
<form method="POST" action="admin.php">
    <button type="submit" name="delete">Confirmer</button>
    <button type="submit" name="deny">Refuser</button>
</form>
</body>
</html>

<?php
if (isset($_POST['delete'])) {
    $id = $_SESSION['id'];

   
    $st = $pdo->prepare("DELETE FROM Marque WHERE id=:id");
    $st->bindParam(':id', $id);
    $st->execute();
    $st = $pdo->prepare("DELETE FROM influencer WHERE id=:id");
    $st->bindParam(':id', $id);
    $st->execute();

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deny'])) {
    $user = null;
    $inf = null;
    exit;
}
?>
