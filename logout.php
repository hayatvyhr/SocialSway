<?php
// Start the session (if not already started)
session_start();
// Destroy all session data
session_destroy();

echo "<script> alert('Vous etes deconectez avec succes!');
			window.location.href='login.php';
		</script>";

// Redirect to the login page or any other desired page
exit;
?>
