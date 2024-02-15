<?php
// Démarre ou reprend une session existante
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
        form {
          margin: 60px;
          display: flex;
          flex-direction: column
        }

        .forum{
          display: flex;
          gap: 60px;

        }
        h1{
          margin: 40px;
          color: black;
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
        label, select{
          margin: 30px;
        }
        form input{
         margin: 30px;
        }
        .btn{
          width: 40px;
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
		LOGO
	</div>


	
	
	

	<div class="revenus block" >
		
    <?php 
       $conn = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");

   $update =array();
   $update_st = null;
   $image_name=null;
   //On donne a l'influenceur de modifier n'importe quel champs apres submit
   // si un champs est non vide , on va l'ajouter au tableau $update et en utilisant implode(', ', $update) on concate les elements a modifier pour les changer  

   if (isset($_POST['submit'])) {
 
    if ($_POST['disponible'] === '0' || $_POST['disponible']=== '1' ) {
      $update[]=' disponible =:disponible';
   }
      if ($_POST['nom']) {
         $update[]=' nom = :nom';
      }
      if ($_POST['prenom']) {
        $update[]=' prenom =:prenom';
     }
      if ($_POST['email']) {
         $update[]=' email = :email';
      }

      if ($_POST['genre']) {
        $update[]=' genre =:genre';
     }

     if ($_POST['password']) {
      $update[]=' motdepasse =:password';
     }

     if ($_POST['gsm']) {
      $update[]=' gsm =:gsm';
     }
         if ($_POST['adresse']) {
      $update[]=' adresse =:adresse';
     }

     if ($_POST['datenaissance']) {
      $update[]=' datenaissance =:datenaissance';
     }
     if ($_POST['domaine']) {
      $update[]=' domaine =:domaine';
     }
     if ($_POST['langue']) {
        $update[]=' langue =:langue';
       }
       if ($_POST['continent']) {
        $update[]=' continent =:continent';
       }
     if (!empty($_FILES['image']['tmp_name'])) {
      $image_name = $_FILES['image']['name'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp_name, "image/$image_name");
      $update[] = 'imagee = :image';

  }


            if (!empty($update)) {
              $update_st = $conn ->prepare ('UPDATE influencer SET ' . implode(',', $update) . '  WHERE id=:id');
              $update_st->bindParam(':id',$_SESSION['id']);
              if ($_POST['nom']) {
               $update_st ->bindParam('nom',$_POST['nom']);
               }

              if ($_POST['prenom']) {
                $update_st ->bindParam('prenom',$_POST['prenom']);
              } 

                    if ($_POST['email']) {
                      $email = $_POST['email'];
                      $verify_query = $conn->prepare("SELECT * FROM influencer WHERE email=?");
                      $verify_query->execute(array($email));

                      if ($verify_query->rowCount() > 0) {
                          echo "<p>This email is already used. Please use a different email.</p>";
                          $update_st =null;
                          header('Location: profil_influenceur.php');

                      } else {
                          $update_st->bindParam('email', $_POST['email']);
                      }
                  }
                        
               if ($_POST['genre']) {
              $update_st ->bindParam('genre',$_POST['genre']);
                  } 
               if ($_POST['password']) {
                    $update_st ->bindParam('password',$_POST['password']);
                        }
               if ($_POST['gsm']) {
                    $update_st ->bindParam('gsm',$_POST['gsm']);
                        }
                if ($_POST['disponible'] === '0' || $_POST['disponible']=== '1' ) {
                  $update_st ->bindParam('disponible',$_POST['disponible']);
                      }
               if ($_POST['adresse']) {
                    $update_st ->bindParam('adresse',$_POST['adresse']);
                        }
               if ($_POST['datenaissance']) {
                    $update_st ->bindParam('datenaissance',$_POST['datenaissance']);
                        }
                if ($_POST['domaine']) {
                    $update_st ->bindParam('domaine',$_POST['domaine']);
                        }  
                if ($_POST['langue']) {
                    $update_st ->bindParam('langue',$_POST['langue']);
                        }  
                
                        if ($_POST['continent']) {
                            $update_st ->bindParam('continent',$_POST['continent']);
                                }  
                                        
              if ( $image_name) {
                $update_st->bindParam(':image', $image_name);
              } 
                  
             if ($update_st !=null && $update_st->execute()) {
               echo 'good';
               header('Location: profil_influenceur.php');
               exit();
               
              }else {
               echo 'non';
              }
            }
         }
        
            ?>

        <h1>EDITER VOTRE PROFIL</h1>
    <?php 
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$id = $_SESSION['id'];
$sql = "SELECT * FROM influencer WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);


?>
    <form action=""  method="POST" enctype="multipart/form-data" >
      <div class="forum">
<div class="d1">
<label for="image">Entrez votre photo: </label>
<input type="file" name="image" id="image" accept="image/*">

<br>
<label for="disponible">DISPONIBILITÉ:</label>
<select  name="disponible">
   <option value=" ">choose</option>
   <option value="0">DISPONIBLE</option>
   <option value="1">NON DISPONIBLE</option>
  </select><br><br>
<label for="nom">Nom    :</label>
<input type="text" name="nom"   placeholder="entrez votre Nom"><br>
<br>
<label for="prenom">Prénom  :</label>
<input type="text" name="prenom"   placeholder="entrez votre Prénom "><br>
<br>

<label for="password">PASSWORD :</label>
<input type="password" name="password" id = "password"  placeholder="entrez votre mot de passe">
<br>
<br>

<label for="date">Date  : </label>
<input type="date"   name="datenaissance"><br>
<br>

  
 <label for="email">Email  :</label>
 <input type="text" name="email" value=""  placeholder="entrez votre email"><br>
 <br>
</div>
<div class="d2">
 <label for="gsm">GSM  :</label>
 <select  name="country-code">
   <option value="+212">Morocco (+212)</option>
   <option value="+1">United States (+1)</option>
   <option value="+44">United Kingdom (+44)</option>
   <option value="+33">France (+33)</option>
 </select>
 <input type="text" name="gsm" id ="gsm"   placeholder="entrez votre telephone"><br>
  <br>
  <label for="adresse">Adresse  :</label>
  <input type="text" name="adresse"   placeholder="entrez votre adresse"><br>
 <br>
 <label for="langue">langue  :</label>
  <input type="text" name="langue"   placeholder="entrez votre langue"><br>
  <label for="continent">continent  :</label>
  <input type="text" name="continent"   placeholder="entrez votre continent"><br>
 <label for="genre">Genre:                </label>
 <select  name="genre">
   <option value="F">F</option>
   <option value="M">M</option>
  </select><br><br>
 <label for="domaine">Domaine :</label>
<input type="text" name="domaine"  placeholder="entrez votre domaine"><br><br>

  </div>
  </div>
  <input type="submit" value="upload" name="submit" class="submit">
  <br>
 <a href="profil_influenceur.php" class="btn" >return</a>


</form>

   <br/>
  
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


