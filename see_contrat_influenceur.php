<?php
// Démarre ou reprend une session existante
session_start();




$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['id'];


if ($_GET['type'] == 'marque') {
	$sql = "SELECT * FROM marque where id=".$user_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);
$infl=$infls[0];
$user_rank='';
if ($infl['points']<1000){
	$user_rank="🥉";
}elseif ($infl['points']>=1000 && $infl['points']<2500 ){
	$user_rank="🥈";
}elseif ($infl['points']>=2500 && $infl['points']<4000 ){
	$user_rank="🥇";
}elseif ($infl['points']>=4000 ){
	$user_rank="💎";
}
}else {
	$sql = "SELECT * FROM influencer where id=".$user_id;
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$infl=$infls[0];
	$user_rank='';
	if ($infl['points']<1000){
		$user_rank="🥉";
	}elseif ($infl['points']>=1000 && $infl['points']<2500 ){
		$user_rank="🥈";
	}elseif ($infl['points']>=2500 && $infl['points']<4000 ){
		$user_rank="🥇";
	}elseif ($infl['points']>=4000 ){
		$user_rank="💎";
}

}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!--    IMPORTATION DES FONTS UTILLISE  -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;1,100&display=swap" rel="stylesheet">
	<!--    CSS     -->
	<link rel="stylesheet" href="ressources/css/dycalendar.css"><!-- ce fichier est relative a la library dycalendar -->
	<link rel="stylesheet" href="ressources/css/dashboard_inf.css">
	<title>Influencer|Dashboard</title>
	
    <style>
        .contrat_1{
            grid-column: 3 / 9;
            grid-row: 2 /  10;
			overflow: auto;
        }



		.contrat_1 {
			background-color: #f2f2f2;
			padding: 20px;
			margin-bottom: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		.item_f {
			margin-top: 20px;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			background-color: #fff;
		}
		h1 {
			font-size: 30px;
			color: #333;
			margin-bottom: 10px;
		}
		.photo {
			display: inline-block;
			vertical-align: middle;
			margin-right: 10px;
			border-radius: 50%;
		}
		p {
			font-size: 16px;
			margin-bottom: 10px;
		}
        img{
            width: 150px;
            height: 150px;
        }
        .images{
            text-align: center;
            margin: 20px;

        }
        h1 {
  text-align: center;
}

.images {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 70px;
}

.images > div {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-right: 50px;
}

.item_f {
  margin-top: 50px;
}

.sign{
	display: flex;
	text-align: center;
	flex-direction: row;
	justify-content: space-evenly;
}
p, label{
	font-size: 19px;
}
p{
	font-size: 19px;
	margin: 20px;
}
	</style>
</head>
<body>

<div class="container">
<div class="menu_lateral">
		<div class="ml_profil">
			<?php 
			if ($_GET['type'] == 'marque') {
				echo "<img src='image/" . $infls[0]['logo'] . "' alt='' onerror=\"this.src='img/images.jpeg'\">";
			}else {
				echo "<img src='image/" . $infls[0]['imagee'] . "' alt='' onerror=\"this.src='img/images.jpeg'\">";
			}
			?>
		</div>
		<div class="ml_name">
			<h2> <?php echo $infls[0]['nom'].' '.$user_rank; ?> </h2>
		</div>
		<div class="ml_list">
			<ul>
				<li>
					<button>
						<ion-icon name="grid-outline"></ion-icon>
						Dashboard</button>
				</li>
				<li>

					<button onclick="window.location.href='profil_influenceur.php'">
						<ion-icon name="person-outline"></ion-icon>Profil</button>
				</li>
				<li>

					<button onclick="window.location.href='chat.php'">
						<ion-icon name="chatbubbles-outline"></ion-icon>Chat</button>
				</li>
				<li>

					<button onclick="window.location.href='partenaire_influenceur_d.php'">
						<ion-icon name="document-text-outline"></ion-icon>Partenariat</button>
				</li>
				<li>

					<button onclick="window.location.href='marketPlace_inf.php'">
						<ion-icon name="person-add-outline"></ion-icon>Decouvrir</button>
				</li>
				<li>

					<button onclick="window.location.href='todo_list.php'">
						<ion-icon name="create-outline"></ion-icon>Cree...</button>
				</li>
				<li>

					<button onclick="window.location.href='supprission.php'">
						<ion-icon name="trash-outline"></ion-icon>Suppr. Compte</button>
				</li>
				<li>

					<button onclick="window.location.href = 'logout.php';">
						<ion-icon name="log-out-outline"></ion-icon>Deconnexion</button>
				</li>

			</ul>
		</div>
	</div>
	<div class="header block">
		LOGO
	</div>

	<div class="contrat_1 block" >

	<?php
		$conn = new PDO("mysql:host=localhost;dbname=projet; port=3306","root","");
        if (isset($_GET['id_contrat']) && isset($_SESSION['id'])) {
            $stm = $conn->prepare('SELECT * FROM partenariats WHERE id_partenariat=:id_partenariat');
            $stm->bindParam(":id_partenariat", $_GET['id_contrat']);
            $stm->execute();
            $rows = $stm->fetch(PDO::FETCH_ASSOC);
        
            $stm = $conn->prepare('SELECT * FROM marque WHERE id = :id');
            $stm->bindParam(":id", $rows['id_marque']);
            $stm->execute();
            $row_m = $stm->fetch(PDO::FETCH_ASSOC);

            $result = $conn->prepare("SELECT * FROM influencer where id = :id");
            $result->bindParam(":id", $rows['id_infl']);
            $result->execute();
            $row_inf = $result->fetch(PDO::FETCH_ASSOC);

        }
	?>

<h1>CONTRAT</h1>

<div class="images">
    <div>
<label for="">MARQUE</label>
<label for="">NOM :<?php echo $row_m['nom']; ?></label>
<img class="photo" src="image/<?php echo $row_m['logo']; ?>"  width="100px">
        
    </div>
    <br>
    <div>
<label for="">Influencer</label>
<label for="">NOM :<?php echo $row_inf['nom']; ?></label>
<?php 
if ( $row_inf['imagee'] == '') {

	echo "<img class='photo' src='img/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg' width='100px'> ";

}else{
	echo "<img class='photo' src='image/" . $row_inf["imagee"] . "' width='100px'>";
}
?>
        
    </div>

</div>
<p>Cet accord établit les modalités et conditions de collaboration entre la Marque et l'Influenceur, qui travailleront ensemble pour promouvoir les produits ou services de la Marque via les plateformes de médias sociaux, les articles de blog, ou tout autre canal en ligne convenu mutuellement par les deux parties. <br>
    

La Marque reconnaît la capacité de l'Influenceur à atteindre un public cible spécifique et à créer un contenu attractif qui résonne avec leurs abonnés. L'Influenceur reconnaît l'engagement de la Marque à fournir des produits ou services de qualité qui correspondent à leur image de marque personnelle et à leurs valeurs.<br>

Les deux parties conviennent de travailler en collaboration pour atteindre les objectifs de ce partenariat, dans le but ultime d'augmenter la visibilité, l'engagement et les ventes de la Marque. Les modalités et conditions énoncées dans cet accord sont contraignantes pour les deux parties et sont destinées à régir l'ensemble de la relation entre la Marque et l'Influenceur pour la durée de cette collaboration.</p> 

<div class="item_f">
    <p>Date début: <?php echo $rows['date_debut'] ?></p>
    <p>Date fin: <?php echo $rows['date_fin'] ?></p>
	<?php 
	$dateDebut = new DateTime($rows['date_debut']);
	$dateFin = new DateTime($rows['date_fin']);
	
	$duree = $dateDebut->diff($dateFin);
	
	echo "<p>Durée: " . $duree->format('%y years, %m months, %d days');
	?>
    <p>Salaire: <?php echo $rows['salaire'] ?></p>
    <h3>Termes</h3>
    <?php
    $terms = unserialize($rows['termes']);
    $i = 1;
    foreach ($terms as $term) {
        echo "<p>Term $i: $term</p>";
        $i++;
    }
    ?>
    <div class="sign">
		  <div>
				<p>signature marque: </p>
			<img width="100px" src="image/<?php echo $rows['mar_sign'] ?>" alt="logo">
			</div>
			<div>
				<?php 

			if (empty($rows['inf_sign'])) {
			if ($_SESSION['user_type'] == 'inf') {   // Display the form to add the signature
				?>
				<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="contrat_id" value="<?php echo $rows['id_partenariat'] ?>">
				<label for="signature">Ajouter une signature:</label>
				<input type="file" id="signature" name="signature">
				<button type="submit" name="add_signature">Ajouter la signature</button>
				</form>
				<?php 

				if (isset($_POST['add_signature'])) {
				$contrat_id = $_POST['contrat_id'];

				$signature_file = $_FILES['signature'];
				$signature_path = $signature_file['name'];
				$id_influenceur = $_SESSION['id'];

				$query = "UPDATE partenariats SET inf_sign = '".$signature_path."' WHERE id_partenariat = ".$contrat_id;
				$stmt = $conn->prepare($query);
				$stmt->execute();
				
				}
			} else {
				?>

				 <p>Signature influenceur </p>
				 <?php 
				} 
				 
			
			}else {
				?>
<p>signature Influenceur: </p>
<img width='100px' src="image/<?php echo $rows['inf_sign']; ?>" alt='logo'>
			 <?php
			}
			?>
			</div>

     </div>
</div>



</div>



<!--SCRIPTS-->
<!--nous nous servirons d'une library qui offre le dessin d'un calendrier qui s'appelle le 'dycalendar.js' -->
<!--cette library eat disponible sur "https://github.com/yusufshakeel/dyCalendarJS/blob/master/"-->
<script src="/project/ressources/js/dycalendar.js"></script>
<script src="/project/ressources/js/dycalendar.min.js"></script>
<script src="/project/ressources/js/default.js"></script>
<script>
	dycalendar.draw({
			target: '#dycalendar',
			type: 'month',
			highlighttargetdate:true,
			prevnextbutton:'show'
	})
</script>

<!--SCRIPT RELATIVE A L'IMPORTATION DES ICONS DEPUIS LA LIBRAIRIE DES ICONS "IONIC.IO"-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>



</body>
</html>


