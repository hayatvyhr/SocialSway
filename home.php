<?php
// Démarre ou reprend une session existante
session_start();

// Vérifie si le nom d'utilisateur est présent dans la session
if(!isset($_SESSION['nom']) && !isset($_SESSION['image']) ) {
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

    <?php
    if(isset($_SESSION['image'])) {
        // Récupère l'image de l'utilisateur depuis la session
             
        // Affiche l'image de l'utilisateur
        echo '<img src="'.$_SESSION['image'].'" alt="User image" width="100px">';
    }
    ?>

    <!-- Affiche un lien pour se déconnecter -->
    <a href="index.php">Déconnexion</a>
    <h3><a href="supprission.php">Suppression de compte</a></h3>
    <a href="edit.php">edit profil</a> <br/>

<?php
    $conn = new PDO("mysql:host=localhost;port=3306;dbnom=projet","root","");
$stmt = $conn->prepare("SELECT m.id, m.nom, m.email, m.logo, m.domaine
                        FROM marque m
                        INNER JOIN contrat c ON m.id = c.id_marque
                        WHERE c.id_influenceur = :id");
$stmt->bindValue(':id', $_SESSION['id']);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "<table>";
    echo "<tr><th>LOGO</th><th>NAME</th><th>EMAIL</th><th>DOMAIN</th><th>PARTENARIAT</th><th>voir contrat</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><img src='image/" .$row["logo"]. "' width='100px'></td>";
        echo "<td>" .$row["nom"]. "</td>";
        echo "<td>" .$row["email"]. "</td>";
        echo "<td>" .$row["domaine"]. "</td>";
        echo "<td><a href='marque_profil_p.php?id=".$row["id"]."'><button>Profil</button></a></td>";
        echo "<td><a href='see_contrat_inf.php?id_profil=".$row['id']."'><button>contrat</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucune marque n'a envoyé de contrat pour le moment.";
}


?>

</body>
</html>
