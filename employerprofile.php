<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $companyName = $_POST['company_name'];
    $description = $_POST['company_description'];
    $companyLocation = $_POST['company_location'];
    $website = $_POST['website'];

    // Insert or update employer profile in the database
    $sql = "INSERT INTO employers (name, email, company_name, company_description, company_location, website) VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE name = VALUES(name), email = VALUES(email), company_name = VALUES(company_name), company_description = VALUES(company_description), company_location = VALUES(company_location), website = VALUES(website)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $companyName, $description, $companyLocation, $website);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_affected_rows($db) > 0) {
            echo "<script> alert('Company registered successfully.')</script>";
        } else {
            echo 'Profile updated successfully.';
        }
    } else {
        echo 'Error saving profile: ' . mysqli_error($db);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection when done
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company registration</title>
</head>
<body bgcolor="sky-blue">
    <table  width="50%" height="100%" border="3" bgcolor="maroon">
        <tr>
            <td><font color="white">
    <h1>Company profile</h1>
    <form method="POST" action="">
        <label for="name">Name</label><br>
        <input type="text" name="name" required><br><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" required><br><br>

        <label for="company_name">Company Name</label><br>
        <input type="text" name="company_name" required><br><br>

        <label for="company_description">Company Description</label><br>
        <textarea name="company_description" required></textarea><br><br>

        <label for="company_location">Company Location</label><br>
        <input type="text" name="company_location" required><br><br>

        <label for="website">Website</label><br>
        <input type="url" name="website"><br><br>

        <input type="submit" name="submit" value="Save Profile">
            </td>
        </tr>
        </table>
    </form>
</body>
</html>