<?php
$user_id = $_SESSION['id'];
$recever_id = $_SESSION['receiver_id'];

$typeS = $_SESSION['user_type'];
$typeR = $_SESSION['receiver_type'];
// connect to the database
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// select messages from the database

$sql = "SELECT * FROM marque";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$marques = $stmt->fetchAll(PDO::FETCH_ASSOC);


// loop through messages and print each in a new line
foreach ($marques as $mar) {
	if (!($typeS=='mar' && $mar['id']== $user_id)){



	echo '<li class="listi" onclick="changeVariable('.$mar['id'].',\'mar\')"><div class="div1">
 <img src="'.$mar['logo'].'" alt="" onerror="this.src=\'img/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg\'">
 </div>
<div class="div2"> '.$mar['nom'].'   </div>
<div class="div3"> </div> </li>';
	}}
?>


