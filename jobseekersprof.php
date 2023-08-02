<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Profile Management</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Job Seeker Profile Management</h1>
    
    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform form validation
        $errors = array();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        
        if (empty($email)) {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        }
        
        if (empty($phone)) {
            $errors[] = 'Phone number is required.';
        }
        
        // If there are no errors, store the profile information in the database
        if (empty($errors)) {
            // Establish a database connection
            $db = mysqli_connect('localhost', 'root', '', 'ceijps');

            // Check if the connection was successful
            if (!$db) {
                die('Database connection error: ' . mysqli_connect_error());
            }
            
            // Escape special characters to prevent SQL injection
            $name = mysqli_real_escape_string($db, $name);
            $email = mysqli_real_escape_string($db, $email);
            $phone = mysqli_real_escape_string($db, $phone);
            
            // Insert the profile information into the database
            $query = "INSERT INTO job_seeker_profiles (name, email, phone) VALUES ('$name', '$email', '$phone')";
            $result = mysqli_query($db, $query);
            
            if ($result) {
                echo 'Profile created successfully.';
            } else {
                echo 'Error creating profile.';
            }
            
            // Close the database connection
            mysqli_close($db);
        } else {
            // Display validation errors
            foreach ($errors as $error) {
                echo '<p class="error">' . $error . '</p>';
            }
        }
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone:</label><br>
        <input type="tel" name="phone" required><br><br>

        <input type="submit" value="Save Profile">
    </form>
</body>
</html>
