<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-image: url("nebula.jpeg");
            background-size: cover;
            padding: 40px;
        }
        table {
            width: 100%;
        }
        
        td {
            width: 50%;
            height: 250px;
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        td:hover::after {
            content: attr(data-role);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: yellow;
            font-weight: bold;
            font-size: 24px;
        }
        h1 {
            color: yellow;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>WELCOME TO CLEAN ENERGY INSTALLATION JOBS PLACEMENT SYSTEM</h1>
    <table>
        <tr>
            <td style="background-image: url('Admin.jpg');" onclick="location.href='login.php';" data-role="Admin"></td>
            <td style="background-image: url('Employer.png');" onclick="location.href='login.php';" data-role="Employer"></td>
        </tr>
        <tr>
            <td style="background-image: url('Job seeker.jpg');" onclick="location.href='login.php';" data-role="Job Seeker"></td>
            <td style="background-image: url('Grady.jpg');" onclick="location.href='login.php';" data-role="Graduate"></td>
        </tr>
    </table>
</body>
</html>