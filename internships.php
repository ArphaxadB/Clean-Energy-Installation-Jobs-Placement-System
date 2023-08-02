<?php
// Database connection code
$hostname = "localhost";
$username = "root";
$password = "";
$database = "ceijps";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Upload internship position
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $positionTitle = $_POST['position_title'];
    $positionDescription = $_POST['position_description'];
    $positionLocation = $_POST['position_location'];

    $sql = "INSERT INTO internship_positions (title, description, location, status) 
            VALUES ('$positionTitle', '$positionDescription', '$positionLocation', 'open')";

    if ($conn->query($sql) === TRUE) {
        echo "Internship position uploaded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Internship Position</title>
</head>
<body>
    <h1>Post Internship Position</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Position Title:</label><br>
        <input type="text" name="position_title" required><br><br>

        <label>Position Description:</label><br>
        <textarea name="position_description" required></textarea><br><br>

        <label>Location:</label><br>
        <input type="text" name="position_location" required><br><br>

        <input type="submit" value="Post Position">
    </form>
</body>
</html>
