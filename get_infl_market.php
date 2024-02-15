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
		$html = '<li  id="ress'.$infl['id'].'" class="search-item">
            <div class="mp_r_photo">
                <img src="image/'.$infl['imagee'].'" alt="" onerror="this.src=\'img/images.jpeg\'">
            </div>
            <div class="follow_b" style="display: flex;flex-direction: column; gap: 20px">
                <button onclick="submitForm(\''.$infl['id'].'\', 1)">
                    Suivre
                </button>
                <button onclick="window.location.href=\'make_contrat.php?id_inf='.$infl['id'].'\'">
                    Sign. Contrat
                </button>
            </div>
            <div class="mp_r_name">
                <h3 style="display: flex;flex-direction: row">'.$infl['prenom'].' '.$infl['nom'].'&nbsp; <p id="rank">'.$user_rank.'</p></h3>
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
