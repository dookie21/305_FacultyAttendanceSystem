<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faculty Class Monitoring</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="topbar">
        <h1>Faculty Class Monitoring</h1>
    </header>

    <div class="layout">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#" data-page="home.php" class="active">Home</a></li>
                    <li><a href="#" data-page="faculty_list.php">Faculty List</a></li>
                    <li><a href="#" data-page="schedule_list.php">Schedule</a></li>
                    <li><a href="#" data-page="attendance_list.php">Attendance</a></li>
                </ul>
            </nav>
        </aside>

        <main id="main-content" class="main-content">
            <?php include("pages/home.php"); ?>
        </main>
    </div>

    <script src="js/main.js"></script>
</body>

</html>