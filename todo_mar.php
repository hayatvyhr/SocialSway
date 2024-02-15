<?php
// establish database connection
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "projet";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

session_start();
// retrieve all tasks assigned to the brand
$brand_id = $_SESSION['id']; // assuming brand_id is stored in session variable
$sql = "SELECT * FROM todo_list WHERE id_mar =".$brand_id." AND ASSIGNED=0";
$result = $conn->query($sql);

// display tasks in a table
if ($result->num_rows > 0) {
	echo "<table><tr><th>Title</th><th>Tasks</th><th>Deadline</th></tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row["title"]."</td><td>".$row["tasks"]."</td><td>".$row["deadline"]."</td></tr>";
	}
	echo "</table>";
} else {
	echo "No tasks assigned to you yet.";
}

// create a new task
if (isset($_POST['create_task'])) {
	$title = $_POST['title'];
	$tasks = $_POST['tasks'];
	$deadline = $_POST['deadline'];
	$sql = "INSERT INTO todo_list (id_user, id_mar, deadline, title, tasks) VALUES (?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iisss", $user_id, $brand_id, $deadline, $title, $tasks);
	$user_id = $_SESSION['id']; // assuming user_id is stored in session variable
	if ($stmt->execute() === TRUE) {
		echo "New task created successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// close database connection
$conn->close();
?>

<!-- HTML form to create a new task -->
<form method="post">
	<label for="title">Title:</label><br>
	<input type="text" id="title" name="title"><br>
	<label for="tasks">Tasks:</label><br>
	<textarea id="tasks" name="tasks"></textarea><br>
	<label for="deadline">Deadline:</label><br>
	<input type="date" id="deadline" name="deadline"><br>
	<input type="submit" name="create_task" value="Create Task">
</form>
