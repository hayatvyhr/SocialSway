<?php
// Démarre ou reprend une session existante
session_start();

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
			<img src="img/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg" alt="">

		</div>
		<div class="ml_name">
			<h2>Nom Prenom</h2>
		</div>
		<div class="ml_list">
			<ul>
				<li>
					<button>Dashboard</button>
				</li>
				<li>
					<button onclick="window.location.href='profil_marque.php'">Profil</button>
				</li>
				<li>
					<button onclick="window.location.href='chat.php'">Chat</button>
				</li>
				<li>
				<button onclick="window.location.href='partenaire_marque.php'">Partenariat</button>
				</li>
				<li>
					<button onclick="window.location.href='marketPlace.php'">Decouvrir</button>
				</li>
				<li>
					<button>Cree...</button>
				</li>
				<li>
					<button>Parametres</button>
				</li>
				<li>
					<button>Deconnexion</button>
				</li>

			</ul>
		</div>
	</div>
	<div class="header block">
		LOGO
	</div>
	<div class="e1 block">
		<div class="description">
			<div class="descc">
				<strong>
					Revenue
					<i style="text-align: right"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5140 Dhs </i>
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
					Points
					<i style="text-align: right ;color: #1B4794"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;620 Pts </i>
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
					Libre
					<i style="text-align: right"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;35 poste </i>
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
					Interactions
					<i style="text-align: right"> &nbsp;&nbsp;&nbsp;&nbsp;51 Visites </i>
				</strong>

				<div class="progress-bar">
					<div class="progress" style="width: 75%; background-color: #C40A11"></div>
				</div>

			</div>
		</div>
		<div class="icon">
			<ion-icon name="person-outline" style="color: #C40A11"></ion-icon>
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
				<li>
					<div class="off_icn"><ion-icon name="newspaper-outline"></ion-icon></div>

					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque1</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="newspaper-outline"></ion-icon></div>

					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque2</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="newspaper-outline"></ion-icon></div>

					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque3</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
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
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>

					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque1</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>

					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque2</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>

					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque3</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>
					
					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque4</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>
					
					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque5</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>
					
					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque6</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
				<li>
					<div class="off_icn"><ion-icon name="checkbox-outline"></ion-icon></ion-icon></div>
					
					<div class="date_offre">2022-01-01</div>
					<div class="main_offre">
						<h2>Marque7</h2>
						<p>
							this is siis hkfjh dkjhflk fhjkd
						</p>
					</div>
				</li>
			</ul>

			</div>

		</div>
	</div>
	<div class="revenus block"></div>
	<div class="footer block"></div>
	<div class="best_brands block"></div>
	<div class="impressions block"></div>
	<div class="requests block"></div>
	<div class="free block"></div>
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


