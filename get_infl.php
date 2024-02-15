<?php

$user_id = $_SESSION['id'];
$recever_id = $_SESSION['receiver_id'];

$typeS = $_SESSION['user_type'];
$typeR = $_SESSION['receiver_type'];


// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database


$sql = "SELECT * FROM influencer";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$infls = $stmt->fetchAll(PDO::FETCH_ASSOC);



foreach ($infls as $infl) {
	if (!($typeS=='inf' && $infl['id']== $user_id)){

	echo '<li class="listi" onclick="changeVariable('.$infl['id'].',\'inf\')"><div class="div1"><img src="'.$infl['imagee'].'" alt="" onerror="this.src=\'img/images.jpeg\'"> </div>
<div class="div2"> '.$infl['nom'].' '.$infl['prenom'].'  </div></li>';
	}
}
?>


