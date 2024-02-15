<?php
session_start();

// Check if the session variables are set
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
	<title>Marque |Dashboard</title>
	<script>
	
	var containerWidth = 2030;
	var viewportWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	var zoomLevel = (viewportWidth / containerWidth) * 100;

	document.body.style.zoom = zoomLevel + '%';

</script>
	<style>
		/* Common styles for both buttons */
		.button {
			display: inline-block;
			line-height: 12px;
			font-size: 12px;
			font-weight: normal;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
			height: 30px;
		}

		/* Styling for the "Accept" button */
		.accept {
			background-color: #4CAF50;
			color: white;
			border: 2px solid #4CAF50;
		}

		.accept:hover {
			background-color: white;
			color: #4CAF50;
		}

		/* Styling for the "Decline" button */
		.decline {
			background-color: #f44336;
			color: white;
			border: 2px solid #f44336;
		}

		.decline:hover {
			background-color: white;
			color: #f44336;
		}
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
		<img src="ressources/img/Asset%201.png" alt="">
	</div>
	<div class="e1 block">
		<div class="description">
			<div class="descc">
				<strong>
					Revenue : 
					<i style="text-align: right"><?php echo $data_user['revenue_5'];?> Dhs </i>
				</strong>

				<div class="progress-bar">
					<div class="progress" style="width: 75%; background-color: #067A12"></div>
				</div>

			</div>
		</div>
		<div class="icon">
			<ion-icon name="wallet-outline" style="color: #067A12"></ion-icon>
		</div>
		<div class="value">
			<p>
				<strong>Dernier</strong>
				Mois
			</p>
		</div>
	</div>
	<div class="e2 block">
		<div class="description">
			<div class="descc">
				<strong>
					Points :
					<i style="text-align: right ;color: #1B4794"><?php echo $infl['points'];?> Pts </i>
				</strong>

				<div class="progress-bar">
					<div class="progress" style="width: 75%; background-color: #1B4794"></div>
				</div>

			</div>
		</div>
		<div class="icon">
			<ion-icon name="diamond-outline" style="color: #1B4794"></ion-icon>        </div>
		<div class="value">
			<p>
				<strong>Depuis</strong>
				Tjrs
			</p>
		</div>
	</div>
	<div class="e3 block">
		<div class="description">
			<div class="descc">
				<strong>
					Libre :
					<i style="text-align: right"><?php
						$servername = "localhost:3306";
						$username = "root";
						$password = "";
						$dbname = "projet";
						$conn = new mysqli($servername, $username, $password, $dbname);
						$sql = "SELECT SUM(nb_postes) as total_nb_postes FROM offres";

						// Execute the query and fetch the result
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();

						// Print the sum of nb_postes
						echo  $row['total_nb_postes'];

						// Close the database connection
						$conn->close();?> Postes </i>
				</strong>

				<div class="progress-bar">
					<div class="progress" style="width: 75%; background-color: #C49E04"></div>
				</div>

			</div>
		</div>
		<div class="icon">
			<ion-icon name="briefcase-outline" style="color: #C49E04"></ion-icon>
		</div>
		<div class="value">
			<p>
				<strong>Actuel</strong>
				Dispo
			</p>
		</div>
	</div>
	<div class="e4 block">
		<div class="description">
			<div class="descc">
				<strong>
					Interactions :
					<i style="text-align: right"><?php echo $data_user['visites_p'];?> Visites </i>
				</strong>

				<div class="progress-bar">
					<div class="progress" style="width: 75%; background-color: #C40A11"></div>
				</div>

			</div>
		</div>
		<div class="icon">
			<ion-icon name="eye-outline" style="color: #C40A11"></ion-icon>

		</div>
		<div class="value">
			<p>
				<strong>Derniere</strong>
				Semaine
			</p>
		</div>
	</div>
	<div class="cal block">

		<div id="dycalendar">

		</div>


	</div>
	<div class="offers block">
		<div class="off_title">
			<h2>
				Derniers Offres
			</h2>
			<select id="s_offres">
				<option value="m">Mois</option>
				<option value="s">Semmaine</option>
				<option value="a">Annee</option>
			</select>
		</div>
		<div class="list_offers">

			<ul>
				<?php
				$servername = "localhost:3306";
				$username = "root";
				$password = "";
				$dbname = "projet";
				$conn = new mysqli($servername, $username, $password, $dbname);
				$sql = "SELECT * FROM marque m inner join offres o on o.id_mar=m.id order by date_offre desc;";
				$result = $conn->query($sql);

				// display tasks in a table
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<li>
					<div class="off_icn"><img src="'.$row['logo'].'" alt=""></div>
					<div class="date_offre">'.$row["date_offre"].'</div>
					<div class="main_offre">
						<h2>'.$row["nom"].'</h2>
											<p> <strong> '.$row['nb_postes'].'</strong> Postes disponibles.</p>

					</div>
				</li>';
					}
				} else {
					echo "<h4> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aucune offre n'est disponible.</h4>";
				}
				?>

			</ul>
		</div>
	</div>
	<div class="parten block">
		<div class="parten_title">
			<h2>
				Vos Partenariats
			</h2>
			<select id="s_offres" >
				<option value="#">Expiration</option>
				<option value="m">Ce Mois</option>
				<option value="s">Cette Semmaine</option>
				<option value="a">Cet Annee</option>
			</select>
		</div>
		<div class="list_offers">
			<ul>
				<?php

				$sql = "SELECT * FROM marque m inner join partenariats p on p.id_marque=m.id where p.id_infl=".$user_id.";";
				$result = $conn->query($sql);

				// display tasks in a table
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<li>
					<div class="off_icn"><img src="image/'.$row['logo'].'" alt=""></div>
					<div class="main_offre">
						<h2>'.$row["nom"].'</h2>
						<p>  Date de fin :<strong> '.$row['date_fin'].'</strong> </p>

					</div>
				</li>';
					}
				} else {
					echo "<h4> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vous n'avez aucun partenariat.</h4>";
				}
				?>
			</ul>
		</div>


	</div>
	<div class="todo block">
		<div class="todo_title">
			<h2>
				Vos travaux a faire :
			</h2>
			<select id="s_offres">
				<option value="m">Tous les travaux</option>
				<option value="s">Deja realises</option>
				<option value="a">Non realises</option>
				<option value="a">Travaux manques</option>
			</select>
		</div>
		<div class="todo_list">
			<div class="list_todoo">


				<ul>
					<?php

					$sql = "SELECT * FROM todo_list WHERE id_mar =".$user_id." AND ASSIGNED=0";
					$result = $conn->query($sql);

					// display tasks in a table
					if ($result->num_rows > 0) {
						echo "<table><tr><th>Title</th><th>Tasks</th><th>Deadline</th></tr>";
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>".$row["title"]."</td><td>".$row["tasks"]."</td><td>".$row["deadline"]."</td></tr>";
						}
						echo "</table>";
					} else {
						echo "Vous n'avez aucun travail a faire.";
					}
					?>
				</ul>

			</div>

		</div>
	</div>
	<div class="revenus block">
		<div style="width: 100%;height: 90%;padding: 2%;display: flex;justify-content: center;align-self: center">
			<canvas id="myChart" width="400%" height="auto"></canvas>
		</div>
	</div>
	<div class="footer block" style="display: flex;flex-direction: row">
		<div class="f1" style="display: flex;height: 100%;width: 33%;justify-content: center;align-items: center;padding: 0px 70px 0 70px;text-align: justify">
			About us:
			Influencer Connect is a platform that helps influencers and brands connect and collaborate on impactful campaigns. Our mission is to make influencer marketing accessible and effective for everyone.
		</div>
		<div class="f3" style="display: flex;height: 100%;width: 33%;justify-content: center;align-items: center;font-weight: bold;text-align:
center">
			Copyright © 2023 Influencer Connect. <br> All rights reserved.
		</div>
		<div class="f2" style="display: flex;height: 100%;width: 33%;justify-content: center;align-items: center;padding: 0px 70px 0 70px;text-align: justify" >Connect with us:

			Email: info@influencerconnect.com
			Instagram: @influencerconnect
			Twitter: @influencerconnect
			Facebook: facebook.com/influencerconnect</div>

	</div>
	<div class="best_brands block">
		<div class="todo_title">
			<h2>
				Meilleurs Marques :
			</h2>
			<select id="s_offres">
				<option value="m">Mois</option>
				<option value="s">Semmaine</option>
				<option value="a">Annee</option>
			</select>
		</div>
		<div class="todo_list">
			<div class="list_todoo">


				<ul>
					<?php

					$sql = "SELECT * FROM marque order by points asc";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo '<li>
					<div class="off_icn"><img src="' . $row['logo'] . '" alt=""></div>
					<div class="date_offre">' . $row["points"] . '</div>
					<div class="main_offre">
						<h2>' . $row["nom"] . '</h2>
											<p> Specifie sur : <strong> ' . $row["domaine"] . '</strong> </p>

					</div>
				</li>';
						}} else {
						echo "Vous n'avez aucun travail a faire.";
					}
					?>
				</ul>

			</div>

		</div>
	</div>
	<div class="impressions block">
		<div class="off_title">
			<h2>
				ACTIONS RAPIDES :
			</h2>
		</div>
		<div class="list_offers">

			<ul>
				<li>
					<div class="off_icn"><ion-icon name="invert-mode-outline"></ion-icon></div>
					<div class="date_offre">
						<button class="button" onclick="toggleDarkMode()">PARAMTERES</button>

					</div>

					<div class="main_offre">
						<h2>Modifier le theme</h2>
						<p>
							Themes : clair/sombre
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="person-outline"></ion-icon></div>

					<div class="date_offre">
						<button class="button ">Profil</button>
					</div>					<div class="main_offre">
						<h2>Modifier le profil</h2>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="chatbubbles-outline"></ion-icon></div>

					<div class="date_offre">
						<button clas.href='chat.php'">Chat</button>
					</div>
					<div s="button" onclick="window.locationclass="main_offre">
					<h2>Voir vos messages</h2>

		</div>
		</li>
		</ul>
	</div>
</div>
<div class="requests block">
	<div class="off_title">
		<h2>
			Demandes Recus
		</h2>
		<select id="s_offres">
			<option value="m">Mois</option>
			<option value="s">Semmaine</option>
			<option value="a">Annee</option>
		</select>
	</div>
	<div class="list_offers">

		<ul>
			<?php
			$sql = "SELECT * FROM marque m inner join friendship f on f.id_mar=m.id where f.link = 2 and f.id_inf = ".$user_id.";";
			$result = $conn->query($sql);

			// display tasks in a table
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Nom</th><th>Domaine</th><th>Nb. Points</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>".$row["nom"]."</td><td>".$row["domaine"]."</td><td>".$row["points"]."</td></tr>";
				}
				echo "</table>";
			} else {
				echo "<h4> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vous n'avez aucune invitation.</h4>";
			}
			?>
		</ul>
	</div>
</div>
<div class="free block" style="display: flex;flex-direction: row">

	<div class="free1" style="width: 40%;height: 100%;display: flex;justify-content: center;align-items: center;text-align: center;">
		<h2>Suivez nos actualites sur nos reseau sociaux !</h2>
	</div>
	<div class="free2" style="width: 60%;height: 100%;display: flex;justify-content: center;align-items: center;flex-direction: row; gap: 25px">
		<div class="sm_icns" style="display: flex;width=25%;">
			<img src="img/icons/facebook%20-%20Copy.png" alt="">
			<h3>Facebook</h3>
		</div>
		<div class="sm_icns" style="display: flex;width=25%;">
			<img src="img/icons/instagram%20-%20Copy.png" alt="">
			<h3>Instagram</h3>
		</div>
		<div class="sm_icns" style="display: flex;width=25%;">
			<img src="img/icons/twitter%20-%20Copy.png" alt="">
			<h3>Twitter</h3>
		</div>
		<div class="sm_icns" style="display: flex;width=25%;">
			<img src="img/icons/linkedin%20-%20Copy.png" alt="">
			<h3>LinkedIn</h3>
		</div>

	</div>

</div>
</div>
<?php
$sql = "SELECT * FROM data_user where id_user = ".$user_id." and type='".$_SESSION['user_type']."';";
$result = $conn->query($sql);

// encode data as a JSON object
if ($result->num_rows > 0) {
	$data = array();
	while($row = $result->fetch_assoc()) {
		$data[] = $row['revenue_1'];
		$data[] = $row['revenue_2'];
		$data[] = $row['revenue_3'];
		$data[] = $row['revenue_4'];
		$data[] = $row['revenue_5'];
	}
	$jsonData = json_encode($data);
}

// output as a JavaScript variable assignment
echo "<script>var myData = $jsonData;</script>";

?>


<!--SCRIPTS-->
<!-- <script>
		var containerWidth = 2000;

		var viewportWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
		var zoomLevel = (viewportWidth / containerWidth) * 100;

		document.body.style.zoom = zoomLevel + '%';

</script> -->

<!--SCRIPTS-->
<!--nous nous servirons d'une library qui offre le dessin d'un calendrier qui s'appelle le 'dycalendar.js' -->
<!--cette library eat disponible sur "https://github.com/yusufshakeel/dyCalendarJS/blob/master/"-->
<script src="ressources/js/dycalendar.js"></script>
<script src="ressources/js/dycalendar.min.js"></script>
<script src="ressources/js/default.js"></script>
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


<!--SCRIPT POUR AFFICHAGE DU GRAPH CONTENANT LES REVENUS BASEE SUR UNE LIBRARY SUR : "CHART.JS"-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
			labels: ['March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'Vos Revenues',
				backgroundColor: 'rgb(57,85,236)',
				borderColor: '#5057ae',
				data: myData
			}]
		},

		// Configuration options go here
		options: {}
	});
	function toggleDarkMode() {
		var darkModeCSS = document.getElementById("dark-mode-css");
		if (darkModeCSS) {
			darkModeCSS.remove(); // remove the dark mode stylesheet
		} else {
			darkModeCSS = document.createElement("link");
			darkModeCSS.setAttribute("rel", "stylesheet");
			darkModeCSS.setAttribute("href", "ressources/css/test_dark_mode.css");
			darkModeCSS.setAttribute("id", "dark-mode-css");
			document.head.appendChild(darkModeCSS); // add the dark mode stylesheet
		}
	}

</script>

</body>
</html>


