<?php
session_start();
$pdo = new PDO("mysql:host=localhost;port=3308;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['id'];


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

$sql="select * from data_user where id_user=".$user_id." and type='mar'";
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
<!--	<link rel="stylesheet" href="ressources/css/dycalendar.css"><ce fichier est relative a la library dycalendar -->
	<link rel="stylesheet" href="ressources/css/add_todo.css">
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
	</style>

</head>
<body>

<div class="container">
	<div class="menu_lateral">
		<div class="ml_n">
			<img src="img/icons/notifications-outline%20(1).svg" alt="n">
		</div>
		<div class="ml_m">
			<img src="img/icons/mail-open-outline.svg" alt="m">
		</div>
		<div class="ml_profil">
			<img src="<?php echo $infls[0]['logo'] ?>" alt="">

		</div>
		<div class="ml_name">
			<h2> <?php echo $infls[0]['nom'].' '.$user_rank; ?> </h2>		</div>
		<div class="ml_list">
			<ul>
				<li>
					<button onclick="window.location.href='dashboard_mar.php'">
						<ion-icon name="grid-outline"></ion-icon>
						Dashboard</button>
				</li>
				<li>

					<button onclick="window.location.href='profil_inf.php'">
						<ion-icon name="person-outline"></ion-icon>Profil</button>
				</li>
				<li>

					<button onclick="window.location.href='chat.php'">
						<ion-icon name="chatbubbles-outline"></ion-icon>Chat</button>
				</li>
				<li>

					<button onclick="window.location.href='see_contrat_inf.php'">
						<ion-icon name="document-text-outline"></ion-icon>Partenariat</button>
				</li>
				<li>

					<button onclick="window.location.href='marketPlace.php'">
						<ion-icon name="person-add-outline"></ion-icon>Decouvrir</button>
				</li>
				<li>

					<button>
						<ion-icon name="create-outline"></ion-icon>Cree...</button>
				</li>
				<li>

					<button>
						<ion-icon name="settings-outline"></ion-icon>Parametres</button>
				</li>
				<li>

					<button>
						<ion-icon name="log-out-outline"></ion-icon>Deconnexion</button>
				</li>

			</ul>
		</div>
	</div>
	<div class="header block">
		LOGO
	</div>
	
	<div class="free block" style="display: flex;flex-direction: row">
		<form class="add_todo" method="post">
			<h2 align="center" style="margin: 20px">Ajouter une nouvelle tache :<br></h2>
			<label for="title">Title :</label><br>
			<input type="text" id="title" name="title" required><br>
			<label for="tasks">Tasks :</label><br>
			<input id="tasks" name="tasks" required><br>
			<label for="deadline">Deadline :</label><br>
			<input type="date" id="deadline" name="deadline" required><br>
			<label for="influencer">Choose an Influencer :</label><br>
			<select id="influencer" name="influencer" required>
				<option value="">-- Select an influencer --</option>
				<?php
				$servername = "localhost:3308";
				$username = "root";
				$password = "";
				$dbname = "projet";
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				$brand_id = $_SESSION['id']; // assuming brand_id is stored in session variable

				// Get the list of influencers who have a partnership with the active brand
				$sql = "SELECT i.id, i.nom, i.prenom FROM influencer i JOIN partenariats p ON i.id = p.id_infl WHERE p.id_marque = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("i", $brand_id);
				$stmt->execute();
				$result = $stmt->get_result();

				while ($row = $result->fetch_assoc()) {
					echo '<option value="' . $row['id'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</option>';
				}
				?>
			</select><br>
			
			<input type="submit" name="create_task" value="Create Task" required>
		</form>
		<div class="results">
		<?php
		echo ' <h2>Travaux en attente :</h2> ';
		
		$brand_id = $_SESSION['id']; // assuming brand_id is stored in session variable
		$sql = "SELECT * FROM todo_list WHERE id_mar =".$brand_id." AND ASSIGNED=0";
		$result = $conn->query($sql);
		
		// display tasks in a table
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Title</th><th>Tasks</th><th>Deadline</th></tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["title"]."</td><td>".$row["tasks"]."</td><td>".$row["deadline"]."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "Vous n'avez aucune tache en attente.";
		}
		echo ' <h2>Travaux deja remis :</h2> ';
		
		$sql = "SELECT * FROM todo_list WHERE id_mar =".$brand_id." AND ASSIGNED=1";
		$sql= "SELECT  i.nom,t.assigned_content,t.title,t.tasks FROM influencer i JOIN todo_list t ON i.id = t.id_mar WHERE t.id_mar =".$brand_id." AND t.ASSIGNED=1";
		$result = $conn->query($sql);
		
		// display tasks in a table
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Influenceur</th><th>Titre</th><th>Sujet</th><th>Travail remis</th></tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["nom"]."</td><td>".$row["title"]."</td><td>".$row["tasks"]."</td><td>".$row["assigned_content"]."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "Vous n'avez aucune tache en attente.";
		}
		
		// create a new task
		if (isset($_POST['create_task'])) {
			$title = $_POST['title'];
			$tasks = $_POST['tasks'];
			$deadline = $_POST['deadline'];
			
			if(empty($title) || empty($tasks) || empty($deadline)) {
				echo "<script>alert('Please fill in all required fields.'); </script> ";
			}
			else {
				$user_id = $_SESSION['id']; // assuming user_id is stored in session variable
				$sql = "SELECT * FROM todo_list WHERE title=? AND id_user=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("si", $title, $user_id);
				$stmt->execute();
				$result = $stmt->get_result();
				
				if($result->num_rows > 0) {
					echo "<script>alert('Task already exists.'); </script> ";
				}
				else {
					$sql = "INSERT INTO todo_list (id_user, id_mar, deadline, title, tasks) VALUES (?, ?, ?, ?, ?)";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("iisss", $user_id, $brand_id, $deadline, $title, $tasks);
					if ($stmt->execute() === TRUE) {
						echo "<script>alert('New task created successfully.'); </script> ";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
		}
		
		?>
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


<!--SCRIPT POUR AFFICHAGE DU GRAPH CONTENANT LES REVENUS BASEE SUR UNE LIBRARY SUR : "CHART.JS"-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'Vos Revenues',
				backgroundColor: 'rgb(57,85,236)',
				borderColor: '#5057ae',
				data: [0, 10, 5, 2, 20, 30, 45]
			}]
		},

		// Configuration options go here
		options: {}
	});
</script>


</body>
</html>


