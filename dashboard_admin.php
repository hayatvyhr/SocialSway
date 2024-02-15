<?php
session_start();

// Check if the session variables are set
//if (isset($_SESSION['user_type'],$_SESSION['id'])) {
//	if ($_SESSION['user_type'] != 'admin') {
//
//			echo '<script>
//                    alert("Vous n\'etes pas encore connecte !! connectez vous afin d\'acceder a votre dashboard");
//                    window.location.href = "login.php";
//                </script>';
//			exit;
//
//	}
//}


$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['id'];



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
	<link rel="stylesheet" href="ressources/css/dashboard_admin.css">
	<title>Marque |Dashboard</title>

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
		<style>  table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    
	</style>

</head>
<body>



<div class="container">
	<div class="menu_lateral">
		<div class="ml_profil">
			<img src="" alt="" onerror="this.src='img/images.jpeg'">
		</div>
		<div class="ml_name">
			<h2> Administrateur </h2>
		</div>
		<div class="ml_list">
			<ul>
				<li>
					<button>
						<ion-icon name="grid-outline"></ion-icon>
						Dashboard</button>
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
					Nb_Inscrit :
					<i style="text-align: right"><?php  $sql = "SELECT COUNT(*) AS num_influencers FROM influencer";
						
						// Prepare the statement
						$stmt = $pdo->prepare($sql);
						
						// Execute the statement
						$stmt->execute();
						
						// Fetch the row
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						
						// Get the number of influencers
						$numInfluencers = $row['num_influencers'];
						echo $numInfluencers ?> infl </i>
				</strong>

				<div class="progress-bar">
					<div class="progress" style="width: 75%; background-color: #067A12"></div>
				</div>

			</div>
		</div>
		<div class="icon">
			<ion-icon name="people-circle-outline" style="color: #067A12"></ion-icon>
		</div>
		<div class="value">
			<p>
				<strong>Depuis</strong>
				Tjrs
			</p>
		</div>
	</div>
	<div class="e2 block">
		<div class="description">
			<div class="descc">
				<strong>Transactions :
						<i style="text-align: right"> <?php
							$sql = "SELECT SUM(revenue_5) AS total_revenue FROM data_user";
							
							// Prepare the statement
							$stmt = $pdo->prepare($sql);
							
							// Execute the statement
							$stmt->execute();
							
							// Fetch the row
							$row = $stmt->fetch(PDO::FETCH_ASSOC);
							
							// Get the total revenue
							$totalRevenue = $row['total_revenue'];
							
							// Print the total revenue
							echo $totalRevenue;
							 ?> Dhs </i>
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
				<strong>Dernier</strong>
				mois
			</p>
		</div>
	</div>
	<div class="e3 block">
		<div class="description">
			<div class="descc">
				<strong>Nb_Inscrit :
					<i style="text-align: right"> <?php  $sql = "SELECT COUNT(*) AS num_influencers FROM marque";

						// Prepare the statement
						$stmt = $pdo->prepare($sql);

						// Execute the statement
						$stmt->execute();

						// Fetch the row
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						// Get the number of influencers
						$numInfluencers = $row['num_influencers'];
						echo $numInfluencers ?> Marques </i>
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
				<strong>Depuis</strong>
				Tjrs
			</p>
		</div>
	</div>
	<div class="e4 block">
		<div class="description">
			<div class="descc">
				<strong>Total :
					<i style="text-align: right"> <?php
						$sql = "SELECT SUM(visites_p) AS total_visits FROM data_user";
						
						// Prepare the statement
						$stmt = $pdo->prepare($sql);
						
						// Execute the statement
						$stmt->execute();
						
						// Fetch the row
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						
						// Get the total visits
						$totalVisits = $row['total_visits'];
						
						// Print the total visits
						echo $totalVisits;
						 ?> Visites </i>
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
				<strong>Depuis</strong>
				Tjrs
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
				Demandes de suppression:

			</h2>  
			<a href="demandedesup.php"></a>

		  

			

			
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
                  
			
				
				$st = $pdo->prepare("SELECT * FROM supp");
				$st->execute();
				$suppData = $st->fetchAll(PDO::FETCH_ASSOC);
				?>
				
			
				
					<table>
						<tr>
							<th>ID</th>
							<th>Message</th>
							<th>Actions</th>
						</tr>
						<?php foreach ($suppData as $data): ?>
							<tr>
								<td><?php echo $data['idSup']; ?></td>
								<td><?php echo $data['message']; ?></td>
							
							  <td>
							   <form method="POST" action="dashboard_admin.php">
								<input type="hidden" name="idSup" value="<?php echo $data['idSup']; ?>">
								<input type="submit" name="confirm" value="Confirm"> 
							 
				
							   </form>
							  </td>
						  </tr>
						<?php endforeach; ?>
						
					</table>
				
				
				<?php 
				
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					//Lorsque le bouton "Confirm" est soumis, le code vérifie si une demande POST a été effectuée. 
					//Si oui, il vérifie si le champ "idSup" est présent dans la demande POST. 
				   
				  if (isset($_POST['idSup'])) {
					  $id = $_POST['idSup'];
				
					  $st = $pdo->prepare("DELETE FROM marque WHERE id= :id");
					  $st->bindParam(':id', $id);
					  $st->execute();
					  
					  
					  
					  $st = $pdo->prepare("DELETE FROM influencer WHERE id= :id");
					  $st->bindParam(':id', $id);
					  $st->execute();
				 //Si c'est le cas, il récupère la valeur de "idSup" et effectue les requêtes DELETE correspondantes pour supprimer les enregistrements 
					//correspondants dans les tables "marque", "influencer" et "supp".
					  $st = $pdo->prepare("DELETE FROM supp WHERE idSup= :id");
					  $st->bindParam(':id', $id);
					  $st->execute();
					 
					  if ($st->rowCount() > 0) {
					  // Un message de confirmation est affiché indiquant si un compte a été supprimé ou si aucun compte n'a été trouvé avec l'ID spécifié.
					  echo "Account with ID $id has been deleted successfully.";
					  } else {
						echo "No account found with ID $id.";
					  }
					}
				}
				?>
				

			
				

			</ul>
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
					<div class="off_icn"><ion-icon name="log-out-outline"></ion-icon></div>

					<div class="date_offre">
						<button class="button ">Deconexion</button>
					</div>					<div class="main_offre">
						<h2>Deconexion</h2>
					</div>
				</li>
				
		</ul>
	</div>
</div>
	<script>
		var containerWidth = 2000;

		var viewportWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
		var zoomLevel = (viewportWidth / containerWidth) * 100;

		document.body.style.zoom = zoomLevel + '%';

	</script>

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
<!--nous nous servirons d'une library qui offre le dessin d'un calendrier qui s'appelle le 'dycalendar.js' -->
<!--cette library eat disponible sur "https://github.com/yusufshakeel/dyCalendarJS/blob/master/"-->
<script src="/ressources/js/dycalendar.js"></script>
<script src="/ressources/js/dycalendar.min.js"></script>
<script src="/ressources/js/default.js"></script>
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


