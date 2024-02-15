<?php
session_start();

// Check if the session variables are set
if (isset($_SESSION['user_type'],$_SESSION['id'])) {
	if ($_SESSION['user_type'] != 'mar') {
		if ($_SESSION['user_type'] == 'inf') {
			header("Location: dashboard_inf.php");
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
        .revenus{
            grid-column: 3 / 9;
            grid-row: 2 / 8;
        }
        .form ,.profil{
          margin: 60px;
        }
        label,input{
          margin: 30px;
        }
        .forum{
          display: flex;
          gap: 60px;
          margin: 40px;
        }
        .submit,.btn{
          background-color: #4CAF50;
          border: none; 
          color: white;
          padding: 12px 24px; 
          text-align: center; 
          text-decoration: none; 
          display: inline-block;
          font-size: 16px; 
          cursor: pointer; 
          border-radius: 4px;
        }
        .submit{
          margin-left: 80%;
        }
        h1{
          color: black;
          DISPLAY: flex;
           JUSTIFY-CONTENT: center;
        }
        label{
          color: black;
          font-weight: bold;
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
			<img src="image/<?php echo $infls[0]['logo'] ?>" alt="">

		</div>
		<div class="ml_name">
			<h2> <?php echo $infls[0]['nom'].' '.$user_rank; ?> </h2>
		</div>
		<div class="ml_list">
			<ul>
				<li>
					<button onclick="window.location.href='dashboard_mar.php'">
						<ion-icon name="grid-outline"></ion-icon>
						Dashboard</button>
				</li>
				<li>

					<button onclick="window.location.href='profil_marque.php'">
						<ion-icon name="person-outline"></ion-icon>Profil</button>
				</li>
				<li>

					<button onclick="window.location.href='chat.php'">
						<ion-icon name="chatbubbles-outline"></ion-icon>Chat</button>
				</li>
				<li>

					<button onclick="window.location.href='partenaire_marque.php'">
						<ion-icon name="document-text-outline"></ion-icon>Partenariat</button>
				</li>
				<li>

					<button onclick="window.location.href='marketPlace.php'">
						<ion-icon name="person-add-outline"></ion-icon>Decouvrir</button>
				</li>
				<li>

					<button onclick="window.location.href='add_todo.php'">
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


	
	
	

	<div class="revenus block" >
    <?php
  $conn = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");

$update =array();
$update_st = null;
$email_id=$_SESSION['email'];
$logo_name=null;
$fax_tel=null;
$chiffredaffaire=null;
$datedecreation=null;

   //On donne a l'influenceur de modifier n'importe quel champs apres submit
   // si un champs est non vide , on va l'ajouter au tableau $update et en utilisant implode(', ', $update) on concate les elements a modifier pour les changer  

if (isset($_POST['submit'])) {


              if ($_POST['nom']) {
                  $update[]=' nom = :nom';
              }
     
              if ($_POST['motdepasse']) {
              $update[]=' motdepasse =:motdepasse';
              }

              if ($_POST['datedecreation']) {
              $update[]=' datedecreation=:datedecreation';
              }  
                if ($_POST['email']) {
                  $update[]=' email = :email';
              }
              if ($_POST['fax_tel']) {
                $update[]='fax_tel =:fax_tel';
                }
              if ($_POST['adresse']) {
                $update[]=' adresse =:adresse';
                }
              
              if ($_POST['domaine']) {
                $update[]=' domaine =:domaine';
                }
                if ($_POST['chiffredaffaire']) {
                $update[]=' chiffredaffaire =:chiffredaffaire';
                }
                if ($_POST['nomderep']) {
                $update[]=' nomderep =:nomderep';
                }
                if ($_POST['prenomderep']) {
                $update[]=' prenomderep =:prenomderep';
                }
                if ($_POST['emailderep']) {
                $update[]=' emailderep =:emailderep';
                }
                if ($_POST['gsm']) {
                $update[]=' gsm =:gsm';
                }          
                  if (!empty($_FILES['logo']['tmp_name'])) {
                  $logo_name = $_FILES['logo']['name'];
                  $logo_tmp_name = $_FILES['logo']['tmp_name'];
                  move_uploaded_file($logo_tmp_name, "image/$logo_name");
                  $update[] = 'logo = :logo';

                }

                if ($_POST['offre']) {
                            
                               
                  // on va verifier si la marque a deja des offres ou non 
                  $select_offre = $conn->prepare('SELECT id_mar FROM offres WHERE id_mar = :id_marque');
                  $select_offre->bindParam(':id_marque',$_SESSION['id']);
                  $select_offre->execute();
                  $date_offre = date('Y-m-d');

                  if ($select_offre->fetchColumn() > 0) {
                    //si il ya deja un offre on va la changer 
                      $update_offre = $conn->prepare('UPDATE offres SET nb_postes=:nb_postes, date_offre=:date_offre WHERE id_mar = :id_marque');
                      $update_offre->bindParam(':nb_postes', $_POST['offre']);
                      $update_offre->bindParam(':date_offre',  $date_offre );
                      $update_offre->bindParam(':id_marque',$_SESSION['id']);
                      $update_offre->execute();
                  } else {
                    // sinon on va inserer une nouvelle offre 
                      $insert_offre = $conn->prepare('INSERT INTO offres (id_mar, nb_postes, date_offre) VALUES (:id_marque, :nb_postes, :date_offre)');
                      $insert_offre->bindParam(':id_marque',$_SESSION['id']);
                      $insert_offre->bindParam(':nb_postes', $_POST['offre']);
                      $insert_offre->bindParam(':date_offre', $date_offre );
                      $insert_offre->execute();
                  }
                  }

              if (!empty($update)) {
                $update_st = $conn ->prepare ('UPDATE marque SET ' . implode(',', $update) . '  WHERE id=:id');
                $update_st->bindParam(':id',$_SESSION['id']);
                
                
                if ($_POST['nom']) {
                  $update_st ->bindParam('nom',$_POST['nom']);
                  }

                      if ($_POST['email']) {
                        $email = $_POST['email'];
                        $verify_query = $conn->prepare("SELECT * FROM marque WHERE email=?");
                        $verify_query->execute(array($email));

                        if ($verify_query->rowCount() > 0) {
                            echo "<p>This email is already used. Please use a different email.</p>";
                            $update_st =null;
                        $_SESSION['email'] = $email_id;

                        } else {
                            $update_st->bindParam('email', $_POST['email']);
                        }
                    }
                          
                    if ($_POST['motdepasse']) {
                  $update_st ->bindParam('motdepasse',$_POST['motdepasse']);
                      } 
                    if ($_POST['datedecreation']) {
                        $update_st ->bindParam('datedecreation',$_POST['datedecreation']);
                            }
                    if ($_POST['fax_tel']) {
                        $update_st ->bindParam('fax_tel',$_POST['fax_tel']);
                            }
                    if ($_POST['adresse']) {
                        $update_st ->bindParam('adresse',$_POST['adresse']);
                            }

                    if ($_POST['domaine']) {
                        $update_st ->bindParam('domaine',$_POST['domaine']);
                            }  
            
                           
                     if ($_POST['chiffredaffaire']) {
                         $update_st ->bindParam('chiffredaffaire',$_POST['chiffredaffaire']);
                             }
                    if ($_POST['nomderep']) {
                         $update_st ->bindParam('nomderep',$_POST['nomderep']);
                             }
                     if ($_POST['prenomderep']) {
                         $update_st ->bindParam('prenomderep',$_POST['prenomderep']);
                             }  

                      if ($_POST['emailderep']) {
                          $update_st ->bindParam('emailderep',$_POST['emailderep']);
                              }
                      if ($_POST['gsm']) {
                          $update_st ->bindParam('gsm',$_POST['gsm']);
                              }  
                                   
                      if ( $logo_name) {
                        $update_st->bindParam(':logo', $logo_name);
                      } 
    
                      if ($update_st !=null && $update_st->execute()) {
                        header('Location:profil_marque.php');
                      }else {
                        echo 'ERREUR DE MODIFICATION';
                      }
                  }

                }
         
  ?>
                  
                <div class="form">


                        <h1>EDITER VOTRE PROFILE</h1>

                    <form action=""  method="POST" enctype="multipart/form-data" >
                      <div class="forum">

                      
                    <div class="marque">
                <label for="image">Entrez votre photo <span> *</span> : </label>
                <input type="file" name="logo" id="image" accept="image/*">
                <br>

                <label for="nom">Nom <span> *</span> :</label>
                <input type="text" name="nom"   placeholder="entrez votre Nom">
                <br>



                <label for="motdepasse">Mot de passe <span> *</span>:</label>
                <input type="password" name="motdepasse" id = "motdepasse"  placeholder="entrez votre mot de passe">
                <br>

                <label for="datedecreation">Date <span> *</span> :</label>
                <input type="date"   name="datedecreation">
                <br>


                <label for="email">Email <span> *</span> :</label>
                <input type="text" name="email" value=""  placeholder="entrez votre email">
                <br>

                <label for="fix">FAX TEL <span> *</span> :</label>
                <input type="text" name="fax_tel" value=""  placeholder="entrez votre email">
                <br>

                  <label for="adresse">Adresse <span> *</span> :</label>
                  <input type="text" name="adresse"   placeholder="entrez votre adresse">
                  <br>


                <label for="domaine">Domaine <span> *</span>:</label>

                <input type="text" name="domaine"  placeholder="entrez votre domaine">
                <br>


                <label for="chiffredaffaire">chiffre <span> *</span> :</label>
                <input type="text" name="chiffredaffaire" value=""  placeholder="entrez votre email">
                <br>
                </div>
                <div class="rep">
                <label for="nomderep">NOM DE REPRESENTANT <span> *</span> :</label>
                <input type="text" name="nomderep" value=""  placeholder="entrez votre email">
                <br>

                  <label for="prenomderep">PRENOM DE REPRESENTANT <span> *</span> :</label>
                  <input type="text" name="prenomderep"   placeholder="entrez votre adresse">
                  <br>


                <label for="emailderep">EMAIL DE REPRESENTANT <span> *</span>:</label>
                <input type="text" name="emailderep"  placeholder="entrez votre domaine">
                <br>


                <label for="gsm">GSM DE REPRESENTANT <span> *</span>:</label>
                <input type="text" name="gsm"  placeholder="entrez votre domaine">
                <br>
                <label for="offre">LE NOMBRE DES OFFRES <span> *</span>:</label>
                <input type="text" name="offre"  placeholder="entrez votre domaine">
                </div>
                </div>
               

                  <input class="submit" type="submit" value="upload" name="submit">
                </form>

                 
                  <a  href="profil_marque.php"> <button class="btn">return</button></a>



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


