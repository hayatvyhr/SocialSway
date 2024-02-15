<?php

$pdo = new PDO("mysql:host=localhost;port=3306;dbname=projet","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
if (!isset($_SESSION['user_type'],$_SESSION['id'])) {
	// Handle the case when the session variables are not set
	// Redirect or display an error message
	echo '<script>
                    alert("Vous n\'etes pas encore connecte !! connectez vous afin d\'acceder a votre dashboard");
            window.location.href = "login.php";
        </script>';
	exit;
}
$user_id = $_SESSION['id'];
$recever_id = $_SESSION['receiver_id'];
$message_text = $_POST['text'];
$typeS = $_SESSION['user_type'];
$typeR = $_SESSION['receiver_type'];

$sql = "INSERT INTO message (user_id, recever_id, messagetext, typeS, typeR) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id, $recever_id, $message_text, $typeS, $typeR]);
$message_id = $pdo->lastInsertId();

$sql = "SELECT * FROM message WHERE msg_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$message_id]);
$message = $stmt->fetch(PDO::FETCH_ASSOC);

header("Location: chat.php");
echo json_encode(['success' => true, 'message' => $message]);
