<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Retrieve form data
$employerName = $_POST['employer_name'];
$commissionAmount = $_POST['commission_amount'];

// Insert commission details into the database
$query = "INSERT INTO commissions (employer_name, amount) VALUES ('$employerName', $commissionAmount)";
$result = mysqli_query($db, $query);

if ($result) {
    echo "Commission remittance successful.";
} else {
    echo "Error remitting commission.";
}

// Close the database connection when done
mysqli_close($db);
?>
