<?php

// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database

$user_id = $_SESSION['id'];
$receiver_id = $_SESSION['receiver_id'];

$typeS = $_SESSION['user_type'];
$typeR = $_SESSION['receiver_type'];

$sql = "SELECT * FROM MESSAGE WHERE (USER_ID=? and RECEVER_ID=? and typeS=?) or (USER_ID=? and RECEVER_ID=? and typeR=?)  ORDER BY timeDate ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id,$receiver_id,$typeS,$receiver_id,$user_id,$typeS]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2= "select * from influencer";
$stmt2 = $pdo ->prepare($sql2);
$stmt2->execute();
$users=$stmt2->fetchAll(PDO::FETCH_ASSOC);

// loop through messages and print each in a new line
foreach ($messages as $message) {
	if ($typeS=='mar'){

		if ($message['user_id']==$user_id && $message['typeS']==$typeS){
//				cette section est reserve pour les messages envoyer par l'utilisateur
			echo "<li class='right_bubble' )\"><p>".$message['messagetext']."</p>"."</li>";
		}else{
//				cette partie est consacre pour les msg recu par d'autres contacts
			echo "<li class='left_bubble' )\"><p>".$message['messagetext']."</p>".' '."</li>";
		}

	}elseif ($typeS=='inf'){

		if ($message['user_id']==$user_id && $message['typeS']==$typeS){
//				cette section est reserve pour les messages envoyer par l'utilisateur
			echo "<li class='right_bubble' )\"><p>".$message['messagetext']."</p>"."</li>";
		}else{
//				cette partie est consacre pour les msg recu par d'autres contacts
			echo "<li class='left_bubble' )\"><p>".$message['messagetext']."</p>".' '."</li>";
		}


	}



}
?>


