<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Get the logged-in job seeker's ID (You need to implement the login system)
$jobSeekerId = 1; // Replace with the actual logged-in job seeker's ID

// Retrieve open job positions for the job seeker
$query = "SELECT * FROM jobs WHERE status = 'open'";
$result = mysqli_query($db, $query);

// Get the number of new job positions since the last visit
$query = "SELECT COUNT(*) AS new_jobs FROM jobs WHERE status = 'open' AND created_at > (SELECT last_login FROM job_seekers WHERE id = $jobSeekerId)";
$newJobsResult = mysqli_query($db, $query);
$newJobsData = mysqli_fetch_assoc($newJobsResult);
$newJobsCount = $newJobsData['new_jobs'];

// Update the last login time for the job seeker
$query = "UPDATE job_seekers SET last_login = NOW() WHERE id = $jobSeekerId";
mysqli_query($db, $query);
// Close the database connection when done
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Energy Job Seeker Dashboard</title>
 <style>
    body {
    background-color: blueviolet;
    background-repeat: no-repeat;
    background-size: cover;
        }
 </style>
</head>
<body>
    <h1>Welcome to the Clean Energy Job Seeker Dashboard</h1>
    <h2>Notifications</h2>
    <p><?php echo $newJobsCount; ?> new job positions available</p>

    <h2>Open Job Positions</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <table>
                    <tr>
                   <h3><?php echo $row['title']; ?></h3>
                   <p><?php echo $row['description']; ?></p>
                   <p>Company:<?php echo $row['company']; ?></p>
                  <p>Location:<?php echo $row['location']; ?></p>
                    <form action="apply.php" method="POST">
                        <input type="submit" value="Apply">
                    </form>
                    </tr>
                </table>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No open job positions found.</p>
    <?php endif; ?>
</body>
</html>