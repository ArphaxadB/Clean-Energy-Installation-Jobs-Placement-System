<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="green">
    <?php
    // Establish a database connection
    $db = mysqli_connect('localhost', 'root', '', 'ceijps');
    
    // Check if the connection was successful
    if (!$db) {
        die('Database connection error: ' . mysqli_connect_error());
    }
    
    // Retrieve applicant details from the database
    $query = "SELECT * FROM job_applications";
    $result = mysqli_query($db, $query);
    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Display the applicant details
        echo "<h1>Applicant Details</h1>";
        
        while ($applicant = mysqli_fetch_assoc($result)) {
            echo "<p><strong>Name:</strong> " . $applicant['full_name'] . "</p>";
            echo "<p><strong>Email:</strong> " . $applicant['email'] . "</p>";
            echo "<p><strong>Resume:</strong> <a href='resumes/" . $applicant['resume'] . "' target='_blank'>View Resume</a></p>";
            echo "<hr>"; // Add a horizontal line between each applicant
        }
    } else {
        echo "No applicants found."; // Handle the case when no rows are returned
    }
    
    // Close the database connection when done
    mysqli_close($db);
    ?>

</body>
</html>