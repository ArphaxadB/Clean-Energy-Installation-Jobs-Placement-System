<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Handle the registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $regname = $_POST['regname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $passcode = $_POST['passcode'];
    $confirmpasscode = $_POST['confirmpasscode'];
    $type = $_POST['type'];

    // Validate form data 
    if (empty($regname) || empty($email) || empty($username) || empty($passcode) || empty($confirmpasscode) || empty($type)) {
        echo 'Please fill in all the fields.';
    } elseif ($passcode !== $confirmpasscode) {
        echo "<script> alert('Passwords do not match')</script>";
    } else {
        // Check if the username already exists in the database
$query = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo "<script> alert('Username already exists. Please choose a different username.')</script>";
} else {
        // Hash the password for security
        $hashedPasscode = password_hash($passcode, PASSWORD_DEFAULT);

        // Insert the user into the database
        $query = "INSERT INTO users (regname, email, username, passcode, type) VALUES ('$regname', '$email', '$username', '$hashedPasscode', '$type')";
        $result = mysqli_query($db, $query);

        if ($result) {
            echo "<script> alert('Successfully registered')</script>";
            header("location: login.php");
        } else {
            echo 'Registration failed. Please try again.';
        }
    }
}
}
// Close the database connection when done
mysqli_close($db);
?>

<!-- HTML registration form -->
<!DOCTYPE html>
<html>
<head>
    <html>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <style>
      .container{
        background-color: yellow;
        width: 25%;
        margin: 120px auto;
        padding: 50px;
        box-shadow: 20px 20px 10px rgb(red, green, blue);
        border-radius: 7px;
        opacity: 0.9;
      }
      .form-group{
        margin-bottom: 10px;
      }
    </style>
    <script src='main.js'></script>
</head>
<body>
    <div class="container">
    <h2>User Registration</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
        <label>Name:</label><br>
         <input type="text" name="regname" class="form-control" id="regname" required value="" 
        size="20" spaceholder="Name" required><br><br>
    </div>
    <div class="form-group">
        <label>Email:</label><br>
        <input type="text" name="email" class="form-control" id="email" required value="" size="20" spaceholder="email" required autocomplete="off"><br><br>
        
      <div class="form-group">
        <label>Username:</label><br>
        <input type="text" name="username" class="form-control" id="username" required value="" 
        size="20"  spaceholder="username" autocomplete="off" required><br><br>
        
      </div>
      <div class="form-group">
        <label>Password:</label><br>
        <input type="password" name="passcode" class="form-control" id="passcode" required value="" size="20" spaceholder="password" required><br><br>
        
      </div>
      <div class="form-group">
        <label>Confirm Password:</label><br>
        <input type="password" name="confirmpasscode" class="form-control" id="confirmpasscode" 
            required value="" size="20" spaceholder="password" required><br><br>
        
      </div>
      <div class="form-group">
        <label>Register as:</label><br>
        <select name="type">
             <option value="select">Select</option>
            <option value="admin">Admin</option>
            <option value="employer">Employer</option>
            <option value="employee">Job seeker</option>
            <option value="graduate">Graduate</option>
        </select><br><br>
      </div>
      <div class="form-group">
        <input type="submit" class="form-control btn btn-primary" id="btn" value="Register" 
        name="submit">
        <p>Already registered? <a href = "login.php">login here</a></p>
      </div>
    </form>
    </div>
</body>
</html>