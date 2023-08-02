<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Start the session
session_start();

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $passcode = $_POST['passcode'];

    // Validate form data (you can add more validation if needed)
    if (empty($username) || empty($passcode)) {
        echo "<script> alert('Please enter both username and password')</script>";
    } else {
        // Retrieve user data from the database
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($db, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                // User found, verify the password
                $user = mysqli_fetch_assoc($result);
                if (password_verify($passcode, $user['passcode'])) {
                    // Password is correct, user is authenticated
                    $_SESSION['type'] = $user['type'];

                    // Redirect users to their specific sites based on the user type
                    if ($_SESSION['type'] === 'Employer') {
                        header('Location: Employer.php');
                        exit;
                    } elseif ($_SESSION['type'] === 'Employee') {
                        header('Location: Job seeker.php');
                        exit;
                    } elseif ($_SESSION['type'] === 'Graduate') {
                        header('Location: Graduate.php');
                        exit;
                    } elseif ($_SESSION['type'] === 'Admin') {
                        header('Location: Admin.php');
                        exit;
                    } else {
                        echo "<script> alert('Invalid user type')</script>";
                    }
                } else {
                    echo "<script> alert('Invalid password')</script>";
                }
            } else {
                echo "<script> alert('User not found')</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script> alert('Error in preparing the statement')</script>";
        }
    }
}

// Close the database connection when done
mysqli_close($db);
?>

<!-- HTML login form -->
<!DOCTYPE html>
<html lang="eg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login.php</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="form">
        <form action="" name="form" method="post" autocomplete="off">
            <label>Username:</label>
            <input type="text" id="username" name="username" required value="" autocomplete="off"><br><br>
            <label>Password:</label>
            <input type="password" id="passcode" name="passcode" required value="" autocomplete="off"><br><br>
            <input type="submit" id="btn" value="Login" name="Submit">
            <p>Not yet a member? <a href="Register.php">Register here</a></p>
        </form>
    </div>
</body>
</html>
