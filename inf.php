<?php

try {
   // Tentative de connexion à la base de données MySQL
  $pdo = new PDO("mysql:host=localhost;dbname=projet;port=3306","root","");
    // Configuration des attributs de l'objet PDO
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Définition du mode d'affichage des erreurs : exceptions
  $pdo->setAttribute(PDO::ATTR_CONNECTION_STATUS, true);
    // Gestion des exceptions en cas d'erreur de connexion
}catch(PDOException $e){
    // Affichage du message d'erreur spécifique et arrêt du script
  die("error: could not connect" . $e->getMessage());
}

if ( isset($_POST['email'])) {
    // Vérifie si la variable 'email' a été envoyée via une requête POST
  $password = $_POST['password'];
   // Stocke la valeur  'password' dans une variable
 
  $email = $_POST['email'];
    // Stocke la valeur du champ 'email' dans une variable
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Vérifie si la méthode de requête est POST
      $stmt = $pdo->prepare("SELECT * FROM influencer WHERE email=?");
       // Prépare une requête SQL pour sélectionner toutes les entrées de la table 'influencer' où l'email correspond
      $stmt->execute(array($email));
      
    
          if ($stmt->rowCount() > 0) {
              echo "<script>confirm(\"Cet e-mail est déjà pris. Veuillez utiliser une adresse e-mail différente!!!\");</script>";
                    // Vérifie si le nombre de lignes retournées par la requête est supérieur à 0

          } else {
              try {
                   // Stocke le nom du fichier image dans une variable

                  $filename = $_FILES["image"]["name"];
                  // Stocke le nom temporaire du fichier image dans une variable

                  
                  $tempname = $_FILES["image"]["tmp_name"];
                    // Définit le dossier de destination pour le fichier image

                  $folder = "./image/" . $filename;
                  // Déplace le fichier image de son emplacement temporaire vers le dossier de destination

                  move_uploaded_file($tempname, $folder);
                    // Requête SQL pour insérer une nouvelle entrée dans la table 'influencer'
        
                  $sql = "INSERT INTO influencer (imagee, nom, prenom, datenaissance, email, gsm, adresse, genre,Langue,continent,followers, domaine, socialmedia, username, motdepasse) 
                          VALUES (:imagee, :nom, :prenom, :datenaissance, :email, :gsm, :adresse, :genre,:Langue, :continent ,:followers , :domaine, :socialmedia, :username, :motdepasse)";
                  
                  $st = $pdo->prepare($sql);
                  // Prépare la requête SQL en utilisant la connexion PDO et la requête SQL définie précédemment
                  
                  $st->bindParam(':imagee', $filename);
                  // Lie la valeur de la variable 'filename' au paramètre nommé ':imagee' dans la requête préparée
                  $st->bindParam(':nom', $_POST['nom']);
                  // Lie la valeur du champ 'nom' au paramètre nommé ':nom' dans la requête préparée
                  $st->bindParam(':prenom', $_POST['prenom']);
                  // Lie la valeur du champ 'prenom' au paramètre nommé ':prenom' dans la requête préparée
                  $st->bindParam(':datenaissance', $_POST['datenaissance']);
                  // Lie la valeur du champ 'datenaissance' au paramètre nommé ':datenaissance' dans la requête préparée
                  $st->bindParam(':email', $_POST['email']);
                  // Lie la valeur du champ 'email' au paramètre nommé ':email' dans la requête préparée
                  $st->bindParam(':gsm', $_POST['gsm']);
                  // Lie la valeur du champ 'gsm' au paramètre nommé ':gsm' dans la requête préparée
                  $st->bindParam(':adresse', $_POST['adresse']);
                  // Lie la valeur du champ 'adresse' au paramètre nommé ':adresse' dans la requête préparée
                  $st->bindParam(':genre', $_POST['genre']);
                  // Lie la valeur du champ 'genre' au paramètre nommé ':genre' dans la requête préparée
                  $st->bindParam(':Langue', $_POST['Langue']);
                  // Lie la valeur du champ 'Langue' au paramètre nommé ':Langue' dans la requête préparée
                  $st->bindParam(':continent', $_POST['Continent']);
                  // Lie la valeur du champ 'Continent' au paramètre nommé ':continent' dans la requête préparée
                  $st->bindParam(':followers', $_POST['followers']);
                  // Lie la valeur du champ 'followers' au paramètre nommé ':followers' dans la requête préparée
                  $st->bindParam(':domaine', $_POST['domaine']);
                  // Lie la valeur du champ 'domaine' au paramètre nommé ':domaine' dans la requête préparée
                  
                  $socialmedia = json_encode($_POST['socialmedia']);
                  // Convertit le tableau 'socialmedia' en JSON
                  $username = json_encode($_POST['username']);
                  // Convertit le tableau 'username' en JSON
                  
                  $st->bindParam(':socialmedia', $socialmedia);
                  // Lie la valeur de la variable 'socialmedia' au paramètre nommé ':socialmedia' dans la requête préparée
                  $st->bindParam(':username', $username);
                  // Lie la valeur de la variable 'username' au paramètre nommé ':username' dans la requête préparée
                  $st->bindParam(':motdepasse', $password);
                  // Lie la valeur de la variable 'password' au paramètre nommé ':motdepasse' dans la requête préparée
                  
                  $st->execute();
                  // Exécute la requête préparée avec les valeurs liées aux paramètres
                  
                  $userID = $pdo->lastInsertId();
                  // Récupère l'identifiant généré automatiquement de la dernière insertion dans la base de données
                  
                  $sql = "INSERT INTO data_user (id_user, type, visites_p, theme, revenue_1, revenue_2, revenue_3, revenue_4, revenue_5) 
                          VALUES (".$userID.", 'inf', 0, 0, 0, 0, 0, 0, 0)";
                  // Requête SQL pour insérer une nouvelle entrée dans la table 'data_user' avec les valeurs spécifiées
                  
                  $st = $pdo->prepare($sql);
                  // Prépare la requête SQL
                  
                  $st->execute();
                  // Exécute la requête préparée
                  
                  header("Location: login.php");
                  // Redirige vers la page 'login.php'
                  
                  exit();
                  // Arrête l'exécution du script
                  
                  } catch (PDOException $e) {
                      // Gestion des exceptions en cas d'erreur de base de données
                      
                      echo "Error: " . $e->getMessage();
                      // Affiche le message d'erreur spécifique
                  }
                  
          }
  
  }
}


?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
  
      <style>
       
     
      </style>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="inf.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <title>Document</title>
    
  </head>
    
  <body> 
      
   <div class="container"> 
     <form action="inf.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" >
     
     <div class="parent" >
            <div class="div1">
              <!--titre de notre formaiaire -->
                 <h1 align="center">Inscription</h1>
            </div>
            <!-- on faire des div pour chaque input et son label -->
            <div class="div2">
              <label for="image">Entrez votre photo :</label>
              <input type="file" name="image" >
            </div>
             <!-- on utiliser span pour les champs obligatoires par * -->
            <div class="div3">
              <label for="nom">Nom <span>*</span> :</label>
              <input type="text" name="nom" required placeholder="entrez votre Nom">
            </div>
            <div class="div4">
              <label for="prenom">Prénom <span>*</span> :</label>
              <input type="text" name="prenom" required placeholder="entrez votre Prénom ">
            </div>

            <div class="div5">
              <label for="email">Email <span>*</span> :</label>
              <input type="email" name="email" required placeholder="entrez votre email">
            </div>

            <div class="div6">
              <!-- on utiliser balise select et option pour l'utilisateur choisir country code -->
              <label for="gsm">GSM <span>*</span> :</label>
              <select name="country-code" class="list">
                <option value="+212">Morocco (+212)</option>
                <option value="+1">United States (+1)</option>
                <option value="+44">United Kingdom (+44)</option>
                <option value="+33">France (+33)</option>
              </select>
              <input type="text" name="gsm" id="gsm" required placeholder="entrez votre telephone">
            </div>
            <div class="div7">
              <label for="adresse">Adresse <span>*</span> :</label>
              <input type="text" name="adresse" required placeholder="entrez votre adresse">
            </div>

            <div class="div8">
              <label for="date">Date <span>*</span> :</label>
              <input type="date" required name="datenaissance">
            </div>
    
    
            <div class="div9">
                <!-- balise select et option pour user choisir le genre -->
              <label for="genre">Genre:</label>
              <select name="genre" class="genre">
                <option value="F"><b>F</b></option>
                <option value="M"><b>M</b></option>
              </select>
            </div>
            <div class="div10">
              <label for="langue">Langue:</label>
              <input type="text" name="Langue" placeholder="Entrez votre langue">
            </div>
            <div class="div11">
               <!-- balise select et option pour user choisir continent -->
              <label for="langue">Continent :</label>
              <select name="Continent " name="Continent " class="list">
                <option value="l'Afrique">l'Afrique</option>
                <option value="l'Amérique">l'Amérique</option>
                <option value="l'Europe">l'Europe</option>
                <option value=" l'Océanie"> l'Océanie</option>
                <option value="l'Asie">l'Asie</option>
              </select>
            </div>
            
            <div class="div12">
              <label for="domaine">Domaine <span>*</span>:</label>
              <input type="text" name="domaine" required placeholder="entrez votre domaine">
            </div>
            <div class="div13">
              <label for="domaine">Followers:</label>
              <input type="text" name="followers" required placeholder="le nombre moyenne des followers">
            </div>
            <div class="div14">
              <label for="password">Le mot de passe <span>*</span>:</label>
              <input type="password" name="password" id="password" required placeholder="entrez votre mot de passe">
              <i class="far fa-eye" id="togglePassword"></i>
            </div>

            <div class="div15">
              <label for="passwordconfr">Confirmer <span>*</span>:</label>
              <input type="password" id="passwordconfr" name="passwordconfr" placeholder="confirmer votre mot de passe">
              <i class="far fa-eye" id="toggleConfirmPassword"></i>
            </div>
            <div class="div16">
             

                <div id="socialm">
                    <label for="socialmedia">Les réseaux sociaux :</label><br>
                    <div class="socialmediass">
                       <!-- balise select et option pour user choisir social media  -->
                      <select name="socialmedia[]" class="list">
                        <option value="Instagram">Instagram</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Twitter">Twitter</option>
                      </select>
                      <input type="text" name="username[]" placeholder="entrez votre username">
                      <button type="button" id="ajoute_compte">Ajouter</button>

                 </div>
              </div>
       
             </div>
              
            <div class="div17">
                <input type="submit" class="btn" id="submitBtn" value="    s'incrire" >
              
            </div>
            <a href="login.php">Vous avez déjà un compte?</a>
            
            
        </div>
    
      </form>
    </div>
  </body>
</html>
        
<script>
 let passwordInput = document.getElementById("password");
// Récupère l'élément HTML correspondant à l'input du mot de passe

passwordInput.addEventListener("input", function() {
  // Ajoute un écouteur d'événements sur l'événement "input" pour l'input du mot de passe

  let password = passwordInput.value;
  // Récupère la valeur du mot de passe saisi

  let length = password.length >= 8;
  // Vérifie si la longueur du mot de passe est d'au moins 8 caractères
  let uppercase = /[A-Z]/.test(password);
  // Vérifie si le mot de passe contient au moins une lettre majuscule
  let lowercase = /[a-z]/.test(password);
  // Vérifie si le mot de passe contient au moins une lettre minuscule
  let number = /[0-9]/.test(password);
  // Vérifie si le mot de passe contient au moins un chiffre

  if (length && uppercase && lowercase && number) {
    // Vérifie si toutes les conditions de validation sont satisfaites
    passwordInput.setCustomValidity("");
    // Définit la validité personnalisée de l'input du mot de passe à une chaîne vide (mot de passe valide)
  } else {
    passwordInput.setCustomValidity("Le mot de passe doit comporter au moins 8 caractères, contenir au moins une lettre majuscule, une lettre minuscule et un chiffre");
    // Définit la validité personnalisée de l'input du mot de passe à un message d'erreur spécifique (mot de passe invalide)
  }
});
// pour verification de  les nombres des chiffres saisir dans le gsm
let numberinput = document.getElementById("gsm");
numberinput.addEventListener("input", function() {
let number = numberinput.value.length;
if (number ==9){
     numberinput.setCustomValidity("");
}else {
    numberinput.setCustomValidity("Le Numero doit comporter  9 Numeros ");
  }
});
const addBtn = document.getElementById("ajoute_compte");
     const socialAccounts = document.getElementById("socialm");
     // écouteur d'événement au bouton addBtn qui écoute un événement "clic" Lorsque le bouton est cliqué, la fonction à l'intérieur de l'écouteur d'événement est exécutée.

    addBtn.addEventListener("click", function() {
    //fonction creer un variable  "newaccount "  est affectée à un clone du dernier élément de socialm
    const newAccount = socialAccounts.lastElementChild.cloneNode(true);
    //la fonction ajoute le clone newAccount à la fin du conteneur socialm à l'aide de appendChild()
    socialAccounts.appendChild(newAccount);
  });
   var password = document.getElementById("password")
  , confirm_password = document.getElementById("passwordconfr");
//cette fonction pour verifier si les deux mots de passe sont correspondants 
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
// pour l'oeil qui montre le mot de passe on a utiliser pour le mot de passe et confirmatiom
const togglePassword = document.querySelector('#togglePassword');
const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const passwordType = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', passwordType);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

toggleConfirmPassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const confirmPasswordType = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
  confirm_password.setAttribute('type', confirmPasswordType);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});
</script>




