<?php
// Establish a database connection
$db = mysqli_connect('localhost', 'root', '', 'ceijps');

// Check if the connection was successful
if (!$db) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform form validation
    $errors = array();
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $education = isset($_POST['education']) ? $_POST['education'] : '';
    $jobObjectives = isset($_POST['job_objectives']) ? $_POST['job_objectives'] : '';
    $experience = isset($_POST['experience']) ? $_POST['experience'] : '';
    $skills = isset($_POST['skills']) ? $_POST['skills'] : '';
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : '';
    $referees = isset($_POST['referees']) ? $_POST['referees'] : '';

    // Validate the "name" field
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    // Validate the "age" field
    if (empty($age)) {
        $errors[] = 'Age is required.';
    }

    // Validate the "gender" field
    if (empty($gender)) {
        $errors[] = 'Gender is required.';
    }

    // Validate the "location" field
    if (empty($location)) {
        $errors[] = 'Current location is required.';
    }

    // Validate the "email" field
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate the "phone" field
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    }

    // If there are no errors, generate the resume
    if (empty($errors)) {
        // Generate the resume content based on entered profile information
        $resume = "Name: $name\n";
        $resume .= "Age: $age\n";
        $resume .= "Gender: $gender\n";
        $resume .= "Current Location: $location\n\n";
        $resume .= "Email: $email\n";
        $resume .= "Phone: $phone\n\n";
        $resume .= "Education:\n$education\n\n";
        $resume .= "Job Objectives:\n$jobObjectives\n\n";
        $resume .= "Experience:\n$experience\n\n";
        $resume .= "Skills:\n$skills\n\n";
        $resume .= "Hobbies:\n$hobbies\n\n";
        $resume .= "Referees:\n$referees\n";

        // Insert the resume details into the database
        $query = "INSERT INTO resumes (name, age, gender, location, email, phone, education, job_objectives, experience, skills, hobbies, referees) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sissssssssss", $name, $age, $gender, $location, $email, $phone, $education, $jobObjectives, $experience, $skills, $hobbies, $referees);

        if (mysqli_stmt_execute($stmt)) {
            // Display success message or redirect to another page
        } else {
            // Display error message
        }

        // Provide the option to download the generated resume
        echo '<h2>Generated Resume:</h2>';
        echo '<pre>' . $resume . '</pre>';
        echo '<a href="download_resume.php?resume=' . urlencode($resume) . '">Download Resume</a>';
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo '<p class="error">' . $error . '</p>';
        }
    }
}

// Close the database connection when done
mysqli_close($db);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Generation</title>
    <style>
        body {
            background-color: chocolate;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <table  width="50%" height="100%" border="3" bgcolor="blue">
        <tr>
            <td><font color="cream">
                <h1>Resume Generation</h1>

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label>Name:</label><br>
                    <input type="text" name="name" required><br><br>

                    <label>Age:</label><br>
                    <input type="number" name="age" required><br><br>

                    <label>Gender:</label><br>
                    <input type="text" name="gender" required><br><br>

                    <label>Current Location:</label><br>
                    <input type="text" name="location" required><br><br>

                    <label>Email:</label><br>
                    <input type="email" name="email" required><br><br>

                    <label>Phone:</label><br>
                    <input type="tel" name="phone" required><br><br>

                    <label>Education:</label><br>
                    <textarea name="education" rows="4" required></textarea><br><br>

                    <label>Job Objectives:</label><br>
                    <textarea name="job_objectives" rows="4" required></textarea><br><br>

                    <label>Experience:</label><br>
                    <textarea name="experience" rows="4" required></textarea><br><br>

                    <label>Skills:</label><br>
                    <textarea name="skills" rows="4" required></textarea><br><br>

                    <label>Hobbies:</label><br>
                    <textarea name="hobbies" rows="4" required></textarea><br><br>

                    <label>Referees:</label><br>
                    <textarea name="referees" rows="4" required></textarea><br><br>

                    <input type="submit" value="Generate Resume">
                </form>
            </td>
        </tr>
    </table>
</body>
</html>
