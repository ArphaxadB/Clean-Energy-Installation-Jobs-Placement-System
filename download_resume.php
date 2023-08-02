<?php
if (isset($_GET['resume'])) {
    $resumeContent = $_GET['resume'];

    // Set the appropriate headers for file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="resume.txt"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($resumeContent));

    // Output the resume content for download
    echo $resumeContent;
    exit;
} else {
    // Redirect to the main page if resume content is not provided
    header('Location: index.php');
    exit;
}
?>
