<?php

// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM influencer";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);


// loop through messages and print each in a new line
foreach ($infls as $infl) {
	if ($infl['id']!= $user_id){
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
		$html = '<li id="ress'.$infl['id'].'" class="search-item">
            <div class="mp_r_photo">
                <img src="img/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg" alt="">
            </div>
            <div class="follow_b">
                <button>
                <a href="make_contrat.php?id_inf='.$infl['id'].'">SIGN CONTRAT</a>
                </button>
            </div>
            <div class="mp_r_name">
                <h3 style="display: flex;flex-direction: row">'.$infl['prénom'].' '.$infl['nom'].'&nbsp; <p id="rank">'.$user_rank.'</p></h3>
                <h6 style="display: flex;flex-direction: row">Suivi par +<p id="followers">'.$infl['followers'].' </p> &nbsp; sur ses reseaux sociaux </h6>
            </div>
            <div class="mp_r_rating" style="text-align: center; flex-direction: column">
                 <h4>Zone_Geo : </h4>
                <p id="zone">'.$infl['continent'].'</p>
            </div>
            <div class="mp_r_info" style="text-align: center">
                <h4>Langue :</h4>
                <p id="language">'.$infl['langue'].'</p>
            </div>
        </li>';

		echo $html;
	}
}
?>
