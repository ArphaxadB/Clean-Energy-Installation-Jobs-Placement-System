<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Commission Remittance</title>
</head>
<body bgcolor="silver">
    <h1>Commission Remittance</h1>
    <form action="cprocess.php" method="POST">
        <label>Employer Name:</label>
        <input type="text" name="employer_name" required><br><br>
        <label>Commission Amount:</label>
        <input type="number" name="commission_amount" min="0" step="0.01" required><br><br>
        <input type="submit" value="Remit Commission">
    </form>
</body>
</html>
