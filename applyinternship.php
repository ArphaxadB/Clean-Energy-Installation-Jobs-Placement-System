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

// Retrieve internship positions
$sql = "SELECT * FROM internship_positions";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Positions</title>
</head>
<body>
    <h1>Internship Positions</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <form action="apply.php" method="POST">
                        <input type="hidden" name="internshipId" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Apply">
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No internship positions available.</p>
    <?php endif; ?>
</body>
</html>
