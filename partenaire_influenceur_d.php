<?php
// Démarre ou reprend une session existante
session_start();


if (isset($_SESSION['user_type'],$_SESSION['id'])) {
	if ($_SESSION['user_type'] != 'inf') {
		if ($_SESSION['user_type'] == 'mar') {
			header("Location: dashboard_mar.php");
			exit;
		} else {
			echo '<script>
                    alert("Vous n\'etes pas encore connecte !! connectez vous afin d\'acceder a votre dashboard");
                    window.location.href = "login.php";
                </script>';
			exit;
		}
	}
} else {
	// Handle the case when the session variables are not set
	// Redirect or display an error message
	echo '<script>
                    alert("Vous n\'etes pas encore connecte !! connectez vous afin d\'acceder a votre dashboard");
            window.location.href = "login.php";
        </script>';
	exit;
}


$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['id'];



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
$sql="select * from data_user where id_user=".$user_id;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$datas_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data_user = $datas_user[0];
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
            grid-row: 2 / 5;
			overflow: auto;
        }
		.contrat_2{
            grid-column: 3 / 9;
			grid-row: 5/ 8;
			overflow: auto;
		}
		.contrat_3{
            grid-column: 3 / 9;
			grid-row: 8/ 12;
			overflow: auto;
		}
		
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    img {
        max-width: 100%;
        height: auto;
    }
	h1{
text-align: center;
color: black;
}
</style>
		
    </style>
</head>
<body>

<div class="container">
<div class="menu_lateral">
		<div class="ml_profil">
			<img src="image/<?php echo $infls[0]['imagee']; ?>" alt="" onerror="this.src='img/images.jpeg'">
		</div>
		<div class="ml_name">
			<h2> <?php echo $infls[0]['nom'].' '.$infls[0]['prenom'].' '.$user_rank; ?> </h2>
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
		
					<h1>TOUT CONTRAT</h1>
				<?php
					$conn = new PDO("mysql:host=localhost;po3306;dbname=projet","root","");
					$id = $_SESSION['id'];
				$stmt = $conn->prepare("SELECT c.id_partenariat,m.*
										FROM marque m
										INNER JOIN partenariats c ON m.id = c.id_marque
										WHERE c.id_infl = :id");
				$stmt->bindValue(':id', $_SESSION['id']);
				$stmt->execute();


				?>

				<table>
					<tr>
						<th>LOGO</th>
						<th>NAME</th>
						<th>EMAIL</th>
						<th>DOMAIN</th>
						<th>CHIFFRE D'AFFAIRE</th>
						<th>voir contrat</th>
					</tr>

					<?php while ($row = $stmt->fetch()): ?>
						<tr>
							<td><img src="image/<?php echo $row['logo']; ?>" width="100px"></td>
							<td><?php echo $row['nom']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['domaine']; ?></td>
							<td><?php echo $row['chiffredaffaire']; ?></td>
							<td><a href="see_contrat_influenceur.php?id_contrat=<?php echo $row['id_partenariat']; ?>&type=inf"><button>contrat</button></a></td>
						</tr>
					<?php endwhile; ?>

				</table>

				<?php if ($stmt->rowCount() === 0): ?>
					<p>Aucune marque n'a envoyé de contrat pour le moment.</p>
				<?php endif; ?>

     </div>


	 <div class="contrat_2 block" >
		
		<h1>CONTRAT NON SIGNEE </h1>
	<?php
		$conn = new PDO("mysql:host=localhost;po3306;dbname=projet","root","");
		$id = $_SESSION['id'];
	$stmt = $conn->prepare("SELECT c.id_partenariat,m.*
							FROM marque m
							INNER JOIN partenariats c ON m.id = c.id_marque
							WHERE c.id_infl = :id AND (c.inf_sign IS NULL OR c.inf_sign = '')");
	$stmt->bindValue(':id', $_SESSION['id']);
	$stmt->execute();


	?>

	<table>
		<tr>
			<th>LOGO</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>DOMAIN</th>
			<th>CHIFFRE D'AFFAIRE</th>
			<th>voir contrat</th>
		</tr>

		<?php while ($row = $stmt->fetch()): ?>
			<tr>
				<td><img src="image/<?php echo $row['logo']; ?>" width="100px"></td>
				<td><?php echo $row['nom']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['domaine']; ?></td>
				<td><?php echo $row['chiffredaffaire']; ?></td>
				<td><a href="see_contrat_influenceur.php?id_contrat=<?php echo $row['id_partenariat'];?>&type=inf"><button>contrat</button></a></td>
			</tr>
		<?php endwhile; ?>

	</table>

	<?php if ($stmt->rowCount() === 0): ?>
		<p>Aucune marque n'a envoyé de contrat pour le moment.</p>
	<?php endif; ?>

</div>

<div class="contrat_3 block" >
		
		<h1>CONTRAT SIGNEE </h1>
	<?php
		$conn = new PDO("mysql:host=localhost;po3306;dbname=projet","root","");
		$id = $_SESSION['id'];
	$stmt = $conn->prepare("SELECT c.id_partenariat,m.*
							FROM marque m
							INNER JOIN partenariats c ON m.id = c.id_marque
							WHERE c.id_infl = :id AND c.inf_sign != '' ");
							$stmt->bindValue(':id', $_SESSION['id']);
	$stmt->execute();


	?>

	<table>
		<tr>
			<th>LOGO</th>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>DOMAIN</th>
			<th>CHIFFRE D'AFFAIRE</th>
			<th>voir contrat</th>
		</tr>

		<?php while ($row = $stmt->fetch()): ?>
			<tr>
				<td><img src="image/<?php echo $row['logo']; ?>" width="100px"></td>
				<td><?php echo $row['nom']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['domaine']; ?></td>
				<td><?php echo $row['chiffredaffaire']; ?></td>
				<td><a href="see_contrat_influenceur.php?id_contrat=<?php echo $row['id_partenariat']; ?>&type=inf"><button>contrat</button></a></td>
			</tr>
		<?php endwhile; ?>

	</table>

	<?php if ($stmt->rowCount() === 0): ?>
		<p>Aucune marque n'a envoyé de contrat pour le moment.</p>
	<?php endif; ?>

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


