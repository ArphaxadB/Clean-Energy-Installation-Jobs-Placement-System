<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Applicant Management</title>
</head>
<body bgcolor="blue">
    <h1>Applicant Management</h1>
    <table width="50%" height="100%" border="3" bgcolor="yellow">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Resume</th>
            <th>Action</th>
        </tr>
        <?php
        // Establish a database connection
        $db = mysqli_connect('localhost', 'root', '', 'ceijps');

        // Check if the connection was successful
        if (!$db) {
            die('Database connection error: ' . mysqli_connect_error());
        }

        // Retrieve applicants from the database
        $query = "SELECT * FROM job_applications";
        $result = mysqli_query($db, $query);

        // Display the list of applicants
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><a href='resumes/" . $row['resume'] . "' target='_blank'>View Resume</a></td>";
            echo "<td><a href='view_applicant.php?id=" . $row['id'] . "'>View Details</a></td>";
            echo "</tr>";
        }

        // Close the database connection when done
        mysqli_close($db);
        ?>
    </table>
</body>
</html>
