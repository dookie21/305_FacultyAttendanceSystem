<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-container td {
            padding: 8px 5px;
            vertical-align: middle;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"],
        input[type="button"] {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"] {
            background: #4CAF50;
            color: #fff;
            margin-right: 10px;
        }

        input[type="button"] {
            background: #f44336;
            color: #fff;
        }

        .form-actions {
            text-align: right;
            margin-top: 15px;
        }

        small {
            color: gray;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Add Faculty</h2>
        <form method="post" action="../php/action_add_faculty.php">
            <table>
                <tr>
                    <td>ID No.</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="id_no" disabled placeholder="Auto-generated ID">
                        <small>* This ID will be generated automatically.</small>
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>:</td>
                    <td><input type="text" name="lastname" placeholder="Enter last name"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>:</td>
                    <td><input type="text" name="firstname" placeholder="Enter first name"></td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td>:</td>
                    <td><input type="text" name="middlename" placeholder="Enter middle name"></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>:</td>
                    <td>
                        <select name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Faculty Rank</td>
                    <td>:</td>
                    <td>
                        <select name="rank">
                            <option value="">Select Rank</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Part Time">Part Time</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Faculty Status</td>
                    <td>:</td>
                    <td>
                        <select name="status">
                            <option value="">Select Status</option>
                            <option value="Core Faculty">Core Faculty</option>
                            <option value="Adjunct Faculty">Adjunct Faculty</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>:</td>
                    <td><input type="text" name="department" placeholder="Enter department"></td>
                </tr>
            </table>
            <div class="form-actions">
                <input type="submit" value="Save">
                <input type="button" value="Cancel" onclick="window.history.back();">
            </div>
        </form>
    </div>

</body>

</html>