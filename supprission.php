<?php
session_start();
//conexxion 
try {
  $pdo = new PDO("mysql:host=localhost;dbname=projet;port=3306", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
} catch (PDOException $e) {
  die("error: could not connect" . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background: rgb(238,174,202);
      background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);}
      .btn {
      height: 50px;
      width: 150px;
      font-size: 20px;
      font-weight: 700;
      cursor: pointer;
      border: none;
      border-radius: 8px;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
      margin-left: 5rem;

      }
      .btn:hover {
        background-color: rgba(95, 133, 187, 0.5);
      }
  </style>
  <title>Supprimer</title>
</head>
<body>
  <!-- on génère un formulaire pour confirmer la suppression du compte. 
  Il utilise la méthode POST pour soumettre les données et spécifie l'action "supprission.php" pour le traitement du formulaire  -->
  <form action="supprission.php" method="POST">
    <h3> Êtes-vous SÛR DE VOULOIR supprimer votre compte ?</h3>

    <label for="oui">Oui</label>
    <input type="radio" name="confirmation" value="oui" id="oui">
    <label for="non">Non</label>
    <input type="radio" name="confirmation" value="non" id="non">

    <div id="message" style="display: none;">
      <label for="Demande">Veuillez saisir un message pour l'administrateur:</label>
      <textarea name="Demande" id="Demande"></textarea>
    </div>
    <!-- Lorsque l'utilisateur clique sur l'option "Oui", le div du message est affiché en changeant sa propriété display en "block".
     Lorsque l'utilisateur clique sur l'option "Non", le div du message est caché et l'utilisateur est redirigé vers la page d'accueil avec window.location.href
      et exit() est appelé pour arrêter l'exécution du script. -->
    <script>
      const ouiRadio = document.getElementById("oui");
      const messageDiv = document.getElementById("message");
      

      ouiRadio.addEventListener("click", function() {
        messageDiv.style.display = "block";
      });

          nonRadio.addEventListener("click", function() {
         messageDiv.style.display = "none";
          window.history.back(); // Redirige l'utilisateur vers la page précédente
    });
        
    </script>

    <input type="submit" name="Confirmer" value="Confirmer"  class="btn">
  </form>

</body>
</html>
<?php 
// Vérifie si le nom d'utilisateur est présent dans la session
if (!isset( $_SESSION['id'])) {
  // Redirige l'utilisateur vers la page de connexion
  header("Location: login.php");
  // Arrête l'exécution du script actuel
  exit();
}

if (isset($_POST['Confirmer']) && $_POST['confirmation'] === 'oui' && isset($_POST['Demande'])) {
  $message = $_POST['Demande'];
  $id = $_SESSION['id'];
  $type=$_SESSION['user_type'];
   
  //inserer les donnees dans table supp
  $stmt = $pdo->prepare("INSERT INTO supp ( idSup, message,type) VALUES (:id, :message ,:type)");
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':message', $message);
  $stmt->bindParam(':type', $type);
  $stmt->execute();

  echo "<p>Votre demande a été soumise avec succès. Merci!</p>";


  exit;
}
?>