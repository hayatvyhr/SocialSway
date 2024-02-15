<?php
// Démarre ou reprend une session existante
session_start();

// Vérifie si le nom d'utilisateur est présent dans la session
if(!isset($_SESSION['nom']) && !isset($_SESSION['prenom']) ) {
    // Redirige l'utilisateur vers la page de connexion
    header("Location: adminlogin.php");
    // Arrête l'exécution du script actuel
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  

 <!-- Affiche un message de bienvenue avec le nom de l'utilisateur actuel -->
 <h2>Bienvenue <?php echo $_SESSION['nom'] . "  ".  $_SESSION['prenom'];?></h2>

 



<a href="demandedesup.php">les demandes</a><br>
<a href="adminlogin.php">Deconexion</a>
</body>
</html>