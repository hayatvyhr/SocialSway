<?php

// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database

$user_id = $_SESSION['id'];


$typeS = $_SESSION['user_type'];

$sql = "SELECT * FROM marque";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);


// loop through messages and print each in a new line
foreach ($infls as $infl) {
	if (!($typeS=='mar' && $infl['id']== $user_id)){
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
                <img src="'.$infl['logo'].'" alt="">
            </div>
            <div class="follow_b">
                <button onclick="submitForm(\''.$infl['id'].'\', 1)">
                    Suivre
                </button>
            </div>
            <div class="mp_r_name">
                <h3 style="display: flex;flex-direction: row">'.$infl['nom'].'&nbsp; <p id="rank">'.$user_rank.'</p></h3>
            </div>
      
        </li>';

		echo $html;
	}
}
?>
