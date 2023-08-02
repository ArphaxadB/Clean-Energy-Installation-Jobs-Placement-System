<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graduate</title>
    <style>
        body {
            background-image: url("path/to/your/image.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<h1>Graduate</h1>
<body bgcolor="lime"><font color="yellow">
   <p>Fill out the following form to generate an online CV or Resume</p> 
  <form action="post" bgcolor="blue" >
    <table width="50%" height="100%" border="3" bgcolor="blue" >
        <tr>
            <tr><td>Biological data</td></tr>
    <td align="left">
        <label for="name">First name</label><br/>
        <input type="text" name="Name" size="20" spaceholder="First name" required>
    </td>
<td align="left">
    <label for="name">Middle name</label><br/>
    <input type="text" name="Name" size="20" spaceholder="Middle name" required>
</td>
<td align="left">
    <label for="name">Last name</label><br />
    <input type="text" name="Name" size="20" spaceholder="Last name" required>
</td>
        </tr>
        <tr>
            <td><p>Gender
                <select name="Gender">
                <optgroup label="Gender">
                    <option value="Select">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Bisexual">Bisexual</option>
                    <option value="Transgender">Transgender</option>
                    </optgroup required>
                </select></p>
            </td>
        </tr>
        <tr>
            <td><label for="Date of Birth">Date of Birth</label><br />
            <input type="date" name="Date of Birth" size="20" spaceholder="Date of Birth" required></td>
        </tr>
        <tr>
            <td>
                <label for="national identification card">ID</label><br />
                    <input type="number" name="national identification card" size="20"  required>
            </td>
        </tr>
        <tr>
            <td><label for="County">County</label><br />
            <input type="text" id="County" name="County" size="20" spaceholder="County" required></td><br/>
            <td><label for="postal code">Postal code</label><br />
                <input type="text" id="postal code" name="postal code" size="20" spaceholder="postal code" required>
            </td>
            <td><label for="Country">Country</label><br />
                <input type="text" id="Country" name="Country" size="20" spaceholder="Country" required>
            </td>
        </tr>
        <tr>
            <td><label for="telephone-number">Telephone number</label><br />
                <input type="tel" pattern="[0-9]{3}-[0-9]{8}" id="telephone-number" name="telephone-number" size="20" spaceholder="telephone-number" required></td>
        </tr>
        <tr>
            <td><label for="email">Email</label><br />
                <input type="email"  name="email" size="20"
                    spaceholder="email" required></td>
        </tr>
        <tr>
            <td><p>Language<select name="Language">
                <option value="Select">Select</option>
                <option value="English">English</option>
                <option value="Kiswahili">Kiswahili</option>
            </select></p></td>
            <td><label for="Language">Second language</label>
                <input type="text" name="Second language" Spaceholder="Kiswahili"></td></tr>
            <tr>
                <td>Work experience</td>
            </tr>
                <td>
                    <p>Have you ever worked as a volunteer in any organization before?</p>
                    <select name="volunteered">
                        <option value="Select">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </td><td>
                    If yes, in which organization?
                    <input type="text" name="organization">
                </td><td><label for="Position">Position</label><input type="text" name="Position" Spaceholder="Position"></td>
            </tr>
            <tr>
                <td> What is your level of education?
                    <select name="level of education">
                        <option value="Select">Select</option>
                        <option value="Certificate">Certificate</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Degree">Degree</option>
                        <option value="Masters degree">Masters degree</option>
                        <option value="Phd">Phd</option>
                    </select>
                </td>
            </tr>
        </tr>
    </table>
  </form> 
</font>
</body>
</html>