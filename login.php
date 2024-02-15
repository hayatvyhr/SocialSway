<?php
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=projet;port=3306","root","");
    // Établit une connexion à la base de données MySQL en utilisant PDO
  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configure le mode de gestion des erreurs pour PDO afin de générer des exceptions en cas d'erreur
  
    $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
    // Active le suivi de l'état de la connexion
  
  } catch(PDOException $e){
    // Gestion des exceptions en cas d'erreur de connexion à la base de données
  
    die("error: could not connect" . $e->getMessage());
    // Affiche un message d'erreur et arrête l'exécution du script
  }
  
  if (isset($_POST['email']) && isset($_POST['password'])) {
    // Vérifie si les champs 'email' et 'password' ont été envoyés dans la requête POST
  
    $email = $_POST['email'];
    // Récupère la valeur du champ 'email'
  
    $password = $_POST['password'];
    // Récupère la valeur du champ 'password'
  
    try { 
      $sql = "SELECT id, nom, motdepasse, imagee FROM influencer WHERE email = :email "; 
      // Requête SQL pour sélectionner l'ID, le nom, le mot de passe et l'image de l'influenceur avec l'e-mail correspondant
  
      $st = $pdo->prepare($sql);
      // Prépare la requête SQL
  
      $st->bindParam(':email', $email);
      // Lie la valeur du champ 'email' à l'argument de la requête préparée
  
      $st->execute();
      // Exécute la requête préparée
  
      $data = $st->fetch();
      // Récupère la première ligne de résultat de la requête sous forme de tableau associatif
  
      if ($data) {
        // Si des données sont retournées par la requête
  
        if ($password === $data['motdepasse']) {
          // Vérifie si le mot de passe saisi correspond au mot de passe dans la base de données
  
          $_SESSION['nom'] = $data['nom'];
          // Stocke le nom de l'influenceur dans la variable de session 'nom'
  
          $_SESSION['id'] = $data['id'];
          // Stocke l'ID de l'influenceur dans la variable de session 'id'
  
          $_SESSION['user_type'] = 'inf';
          // Stocke le type d'utilisateur (influenceur) dans la variable de session 'user_type'
  
          $_SESSION['image'] = 'image/' . $data['imagee'];
          // Stocke le chemin de l'image de l'influenceur dans la variable de session 'image'
  
          header("Location: dashboard_inf.php");
          // Redirige l'utilisateur vers la page 'dashboard_inf.php'
  
          exit();
          // Arrête l'exécution du script
        } else {
          // Si le mot de passe est incorrect, affiche un message d'erreur
          echo "<script>confirm(\"Mot de passe incorrect. Veuillez réessayer!!!\");</script>";
        }
      } else {
        // Si aucun utilisateur avec l'e-mail saisi n'est trouvé dans la base de données, affiche un message d'erreur
        echo "<script>confirm(\"Utilisateur non trouvé. Veuillez d'abord vous vous inscrire!!!\");</script>";
    }
 } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
}

  
// la meme code php pour login pour marque 

// marque
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try { 
        $sql = "SELECT nom, motdepasse,logo,id FROM marque WHERE email = :email "; 
        $st = $pdo->prepare($sql);
        $st->bindParam(':email', $email);            
        $st->execute(); 
        $data = $st->fetch();

        if ($data) {
            if ($password === $data['motdepasse']) {
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['id'] = $data['id'];
	            $_SESSION['user_type']='mar';
                $_SESSION['email'] = $email;
                $_SESSION['logo'] = 'image/' . $data['logo']; 
                header("Location: dashboard_mar.php");
                exit();
            } else {
                // si le mot de passe est incorrect, afficher un message d'erreur
                echo "<script>confirm(\"Mot de passe incorrect. Veuillez réessayer!!!\");</script>";
            }
        } else {
            // utilisateur avec l'e-mail saisi introuvable dans la base de données, afficher un message d'erreur
            echo "<script>confirm(\"Utilisateur non trouvé. Veuillez d'abord vous inscrire!!!\");</script>";
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" href="login.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<body>
	
 <div class="container">
     
           <div class="front-box">
             <!-- form de login-->
              <form method="POST" action="login.php"> 
                      <!-- titre-->
                  <br>  <h2>Login</h2><br>
                   <!-- input et label pour l'email-->
                  <div class="input-box">
                     <label for="email">Email : </label>
                     <input type="email" name="email" required>
                  </div> <br>
                  <!-- input et label pour mot de passe-->
                  <div class="input-box">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" required >
                    <i class="far fa-eye" id="togglePassword" ></i>
                  </div>
                 <!-- Le bouton "Se Connecter" permet à l'utilisateur de déclencher une action de connexion-->
                 <button  class="btn">Se Connecter</button>
                      <div class="grp">
                          <!-- Un conteneur avec la classe CSS "grp" -->

                         <a href="index.php">S'inscrir</a>
                         
                      </div>
              </form>
            </div>
      
 </div>

</body>
</html>
<script>
    // fonction javascript pour l'oeil
    const password = document.getElementById("password");
// Récupère l'élément HTML correspondant à l'identifiant "password" et le stocke dans la variable 'password'

const togglePassword = document.querySelector('#togglePassword');
// Récupère l'élément HTML correspondant au sélecteur CSS '#togglePassword' et le stocke dans la variable 'togglePassword'

togglePassword.addEventListener('click', function (e) {
  // Ajoute un écouteur d'événement sur le clic du bouton 'togglePassword'

  const passwordType = password.getAttribute('type') === 'password' ? 'text' : 'password';
  // Vérifie le type de l'attribut 'type' de l'élément 'password' et stocke le résultat dans la variable 'passwordType'.
  // Si le type est actuellement 'password', le nouveau type sera 'text', sinon le nouveau type sera 'password'.

  password.setAttribute('type', passwordType);
  // Modifie la valeur de l'attribut 'type' de l'élément 'password' avec la valeur de 'passwordType'.

  this.classList.toggle('fa-eye-slash');
  // Ajoute ou supprime la classe CSS 'fa-eye-slash' sur l'élément courant ('togglePassword').
});


</script>

