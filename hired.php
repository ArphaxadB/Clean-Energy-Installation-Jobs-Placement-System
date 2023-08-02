<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="purple">
    <?php
    // Establish a database connection
    $db = mysqli_connect('localhost', 'root', '', 'ceijps');
    
    // Check if the connection was successful
    if (!$db) {
        die('Database connection error: ' . mysqli_connect_error());
    }
    
    // Get the job applicant's details
    $id = 1; 
    $query = "SELECT * FROM job_seekers WHERE id = $id";
    $result = mysqli_query($db, $query);
    
    if (!$result) {
        die('Error in job_seekers query: ' . mysqli_error($db));
    }
    
    $jobSeeker = mysqli_fetch_assoc($result);
    
    if (!$jobSeeker) {
        die('No job seeker found with ID: ' . $id);
    }
    
    // Get the employer's details and the job they offered to the applicant
    $id = 1; 
    $query = "SELECT title, company, created_at FROM jobs j JOIN employers e ON j.id = id WHERE j.id = $id";
    $result = mysqli_query($db, $query);
    
    if (!$result) {
        die('Error in jobs query: ' . mysqli_error($db));
    }
    
    $job = mysqli_fetch_assoc($result);
    
    if (!$job) {
        die('No job found with ID: ' . $id);
    }
    
    // Prepare the email content
    $to = $jobSeeker['email'];
    $subject = 'Job Offer Notification';
    $message = "Dear {$jobSeeker['name']},\n\n";
    $message .= "Congratulations! You have been employed by {$job['company']} for the position of {$job['title']}.\n";
    $message .= "Please contact us for further information.\n\n";
    $message .= "Best regards,\nThe Clean Energy Job Portal";
    
    // Send the email notification
    $headers = "From: bravoagevi12@gmail.com"; 
    if (mail($to, $subject, $message, $headers)) {
        echo 'Notification sent successfully.';
    } else {
        echo 'Error sending notification.';
    }
    
    mysqli_close($db);
    ?>

</body>
</html>