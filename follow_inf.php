<?php
session_start();
// Get the form data
$userId=$_SESSION['id'];
$userType=$_SESSION['user_type'];

$influencer_id = $_POST['influencer_id'];
$type = $_POST['link_type'];

// Connect to the database
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");

// Prepare the SQL statement
$stmt = $pdo->prepare('INSERT INTO friendship (id_inf, id_mar, link) VALUES (:influencer_id, :brand_id, :link_type)');


// Prepare the SQL statement to check if the record already exists
$stmt_select = $pdo->prepare('SELECT COUNT(*) FROM friendship WHERE id_inf = :influencer_id AND id_mar = :brand_id AND link = :link_type');
if ($userType == 'inf'){
	$stmt_select->bindParam(':influencer_id', $userId);
	$stmt_select->bindParam(':brand_id', $influencer_id);
	$stmt_select->bindParam(':link_type', $type);
}
else if ($userType == 'mar'){
	$stmt_select->bindParam(':brand_id', $userId);
	$stmt_select->bindParam(':influencer_id', $influencer_id);
	$stmt_select->bindParam(':link_type', $type);
}

// Execute the SELECT statement
$stmt_select->execute();
$count = $stmt_select->fetchColumn();

if ($count > 0) {
	// If a record already exists, show an alert and stop the script
	echo "<script>alert('Vous Suivez deja cette personne');window.location.href='marketPlace_inf.php'</script>";
} else {
	// If the record doesn't exist, prepare and execute the INSERT statement
	$stmt_insert = $pdo->prepare('INSERT INTO friendship (id_inf, id_mar, link) VALUES (:influencer_id, :brand_id, :link_type)');
	if ($userType == 'inf'){
		$stmt_insert->bindParam(':influencer_id', $userId);
		$stmt_insert->bindParam(':brand_id', $influencer_id);
		$stmt_insert->bindParam(':link_type', $type);
	}
	else if ($userType == 'mar'){
		$stmt_insert->bindParam(':brand_id', $userId);
		$stmt_insert->bindParam(':influencer_id', $influencer_id);
		$stmt_insert->bindParam(':link_type', $type);
	}
	$stmt_insert->execute();

	// Redirect the user to a confirmation page
	header('Location: marketplace_inf.php');
	exit;
}