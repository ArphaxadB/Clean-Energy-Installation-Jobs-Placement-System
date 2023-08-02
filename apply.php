<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve form data
    $fullName = $_GET['full_name'] ?? '';
    $email = $_GET['email'] ?? '';
    $resume = $_FILES['resume']['name'] ?? '';
    $resumeTempPath = $_FILES['resume']['tmp_name'] ?? '';

    // Specify the target directory and filename for the resume
    $resumeDirectory = 'resumes/';
    $resumePath = $resumeDirectory . $resume;

    // Check if the target directory exists, if not, create it
    if (!is_dir($resumeDirectory)) {
        mkdir($resumeDirectory, 0755, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($resumeTempPath, $resumePath)) {
        // Insert the job application into the database
        $query = "INSERT INTO job_applications (full_name, email, resume) 
                  VALUES ('$fullName', '$email', '$resumePath')";
        $result = mysqli_query($db, $query);

        if ($result) {
            $jobPositionId = mysqli_insert_id($db); // Get the auto-incremented job_position_id
            echo "<script> alert('Job application submitted successfully')</script>";
            // Redirect the user to a success page or perform any other actions
        } else {
            echo "<script> alert('Failed to submit the job application. Please try again')</script>";
        }
    } else {
        echo "<script> alert('Failed to move the uploaded file. Please check the destination directory permissions')</script>";
    }
}
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
</head>
<body bgcolor="gold">
    <h1>Job Application</h1>
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label>Full Name:</label><br>
        <input type="text" name="full_name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Resume:</label><br>
        <input type="file" name="resume" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
