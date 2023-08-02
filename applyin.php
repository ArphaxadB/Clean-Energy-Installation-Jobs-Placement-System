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

// Handle the internship application submission form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';

    // Check if a file was uploaded
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $resume = $_FILES['resume']['name'];

        // Upload the resume file to a folder on the server
        $resumePath = 'resumes/' . $resume;
        move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath);
    } else {
        $resume = '';
    }

    // Insert the internship application into the database
    $query = "INSERT INTO internship_applications (full_name, email, resume) 
              VALUES ('$fullName', '$email', '$resume')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'Internship application submitted successfully.';
        // Redirect the user to a success page or perform any other actions
    } else {
        echo 'Failed to submit the internship application. Please try again.';
    }
}

// Close the database connection when done
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Application</title>
</head>
<body>
    <h1>Internship Application</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label>Full Name:</label><br>
        <input type="text" name="full_name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Resume:</label><br>
        <input type="file" name="resume" required><br><br>
        <input type="submit" value="Apply">
    </form>
</body>
</html>
