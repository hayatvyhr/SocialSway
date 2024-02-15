<?php
// Démarre ou reprend une session existante
session_start();

// Vérifie si le nom d'utilisateur est présent dans la session
if(!isset($_SESSION['nom']) && !isset($_SESSION['logo'])) {
    // Redirige l'utilisateur vers la page de connexion
    header("Location: login.php");
    // Arrête l'exécution du script actuel
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
</head>
<body>
    <!-- Affiche un message de bienvenue avec le nom de l'utilisateur actuel -->
    <h2>Bienvenue <?php echo $_SESSION['nom']; ?></h2>

    <?php   echo $_SESSION['email'];

    if(isset($_SESSION['logo'])) {
        // Récupère l'logo de l'utilisateur depuis la session
             
        // Affiche l'logo de l'utilisateur
        echo '<img src="'.$_SESSION['logo'].'" alt="User image" width="100px">';
    }
    ?>

    <!-- Affiche un lien pour se déconnecter -->
    <a href="index.php">Déconnexion</a>
    <h3><a href="supprission.php">Suppression de compte</a></h3>
    <a href="edit_marque.php">edit profil</a> <br/>
    <a href="partenaire_influenceur.php"> <button >partenaire</button></a> <br>
    <a href="marque_partners.php"> <button >MY PARTNERS </button></a> <br>



    <!-- as a list of partenrs  -->
    <script>
      function list(){
         var list = document.getElementsByTagName("ul")[0];
         list.style.display ="block";
      }
   </script>

 <button onclick="list()" >SHOW MARQUE REQUESTS</button><br>
   <?php 
   
//pour afficher les notificatons des demandes de marques 
$pdo = new PDO("mysql:host=localhost;dbname=projet;port=3306","root","");

$id_marque=$_SESSION['id'];
$resultat=$pdo->query("SELECT * FROM partner_request WHERE RECEIVER =$id_marque ");

if ($resultat->rowCount() >0) { 
   echo "<ul style='display:none'>";
   while ($row = $resultat->fetch()){

      $id_inf =$row["SENDER"];
      $marque=$pdo->query("SELECT * FROM influencer WHERE id =$id_inf ");

      echo "<table> ";
      echo "<tr><th>ID</th> <th>LOGO</th>  <th>NAME</th>  <th>EMAIL</th> <th>DOMAIN</th> <th>PARTENARIAT</th> </tr>";

      while ($roww=$marque ->fetch()) {
          echo "<tr>";
          echo "<td>" .$row["SENDER"]. "</td>";
          echo "<td> <img src='image/" .$roww["imagee"]. "' width='100px'></td>";
          echo "<td>" .$roww["nom"]. "</td>";
          echo "<td>" .$roww["email"]. "</td>";
          echo "<td> <a href='marque_profil.php?id=".$roww["id"]. "'> <button>Profil</button> </a> </td>";
          echo "<td> 
            <form method='POST' id='form.$id_inf' > 
            <input  type='submit' name='refuser' id='button_send' value='refuser '>  
              </form> </br>" ;
              if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refuser']) ) {
                $request_send=$pdo ->prepare('DELETE FROM partner_request WHERE SENDER=? AND RECEIVER=?  ') ;
                $request_send ->execute(array($id_inf,$id_marque));        
                header('Location: '.$_SERVER['REQUEST_URI']);
                exit();  
              }
              echo "
              <form method='POST' id='form.$id_inf' > 
              <input  type='submit' name='accepter' id='button_send' value='accepter '>  
                </form>";
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accepter']) ) {
                  $request_send=$pdo ->prepare('INSERT INTO partners (id_influenceur,id_marque) VALUES(?,?)   ') ;
                  $request_send ->execute(array($id_inf,$id_marque));  
                  $request_send=$pdo ->prepare('DELETE FROM partner_request WHERE SENDER=? AND RECEIVER=?  ') ;
                  $request_send ->execute(array($id_inf,$id_marque));          
                  header('Location: '.$_SERVER['REQUEST_URI']);
                  exit();  
                }
   
 
          

          echo "</tr>";
      }
      echo "</table>";

        echo"</li>";

   }
   echo "</ul>";
}else {
   echo "no requests";
}

?>





</body>
</html>
