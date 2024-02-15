<!doctype html>
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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="ressources/css/marketplace.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
	<title>Market Place|SocialSway</title>
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
	<div class="footer"></div>
	<div class="market_place">
		<div class="mp_header">
			<div class="mp_h_choice">
				<select name="mp_h_choice" id="mp_h_choice">
					<option value="I">Influenceur</option>
					<option value="m">Marque</option>
				</select>
			</div>
			<div class="mp_h_searchBar">
				<input type="text" name="mp_srch_bar" placeholder="Rechercher" style="padding-left:20px ">
			</div>
		</div>
		<div class="mp_filters">
			<div class="mp_filter_content">
				<h3 style="padding: 15px">Filtres:</h3>
				<hr color="black">
				<h4 style="padding: 15px">Afficher les resultats celon :</h4>
				<div class="filter_choix">
					<fieldset>
						<legend style="padding: 25px"> <h4>Rank :</h4></legend>
						<label>
							<input type="radio" name="rank" value="💎">
							Diamond 💎
						</label>
						<label>
							<input type="radio" name="rank" value="🥇">
							Gold    🥇
						</label>
						<label>
							<input type="radio" name="rank" value="🥈">
							Silver  🥈
						</label>
						<label>
							<input type="radio" name="rank" value="🥉">
							Bronze  🥉
						</label>
					</fieldset>

					<button class="anuller_filtres" style="margin-top: 25px;height: 30px" onclick="location.reload()">Annuler Tous les filtres  </button>

				
				
				</div>

			</div>

		</div>
		<div class="mp_results">
			<div class="results">
				
			<ul>
				<?php include("get_brands_market.php"); ?>
			
			
			
			</ul>
			</div>
		
		
		
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script type="text/javascript">
	$(document).ready(function() {
		// initialize all filter values to empty
		var rankFilter = "";
		var followersFilter = "";
		var zoneFilter = "";
		var languageFilter = "";

		// update the filter values when a radio button is clicked
		$("input[name=rank]").click(function() {
			rankFilter = $(this).val();
			filterResults();
		});

		$("input[name=followers]").click(function() {
			followersFilter = $(this).val();
			filterResults();
		});

		$("input[name=zone]").click(function() {
			zoneFilter = $(this).val();
			filterResults();
		});

		$("input[name=language]").click(function() {
			languageFilter = $(this).val();
			filterResults();
		});

		// function to filter the results based on the current filter values
		function filterResults() {
			$(".search-item").each(function() {
				var rankValue = $(this).find("#rank").text();
				var followersValue = $(this).find("#followers").text();
				var zoneValue = $(this).find("#zone").text();
				var languageValue = $(this).find("#language").text();

				// show the result only if it matches all the filter values
				if (
						(rankFilter === "" || rankValue === rankFilter) &&
						(followersFilter === "" ||
								(followersFilter === "<1000" && parseInt(followersValue) < 1000) ||
								(followersFilter === ">1000 and <10000" && parseInt(followersValue) >= 1000 && parseInt(followersValue) < 10000) ||
								(followersFilter === ">10000 and <100000" && parseInt(followersValue) >= 10000 && parseInt(followersValue) < 100000) ||
								(followersFilter === "+1000000" && parseInt(followersValue) >= 1000000)
						) &&
						(zoneFilter === "" || zoneValue === zoneFilter) &&
						(languageFilter === "" || languageValue === languageFilter)
				) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		}
	});

</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<script>
	const searchBar = document.querySelector('input[name="mp_srch_bar"]');
	const searchItems = document.querySelectorAll('.search-item');
	
	searchBar.addEventListener('input', () => {
		const searchValue = searchBar.value.toLowerCase();
		searchItems.forEach((item) => {
			const name = item.querySelector('.mp_r_name h3').textContent.toLowerCase();
			if (name.includes(searchValue)) {
				item.style.display = 'grid';
			} else {
				item.style.display = 'none';
			}
		});
	});
	function submitForm(influencerId, type) {
		// Create the form element
		var form = document.createElement('form');
		form.action = 'follow_inf.php';
		form.method = 'POST';

		// Create the hidden input fields
		var influencerIdInput = document.createElement('input');
		influencerIdInput.type = 'text';
		influencerIdInput.name = 'influencer_id';
		influencerIdInput.value = influencerId;
		influencerIdInput.hidden = true;


		var linkTypeInput = document.createElement('input');
		linkTypeInput.type = 'text';
		linkTypeInput.name = 'link_type';
		linkTypeInput.value = type;
		linkTypeInput.hidden = true;

		// Add the input fields to the form element
		form.appendChild(influencerIdInput);
		form.appendChild(linkTypeInput);

		// Submit the form
		document.body.appendChild(form);
		form.submit();
	}

</script>


</body>
</html>