<?php
session_start();

// If not logged in, redirect
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}
$role = $_SESSION['role'];
?>

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

                    <!-- Faculty List (ADMIN ONLY) -->
                    <li class="admin-only"><a href="#" data-page="faculty_list.php">Faculty List</a></li>

                    <!-- Schedule (Both) -->
                    <li><a href="#" data-page="schedule_list.php">Schedule</a></li>

                    <!-- Attendance (Both) -->
                    <li><a href="#" data-page="attendance_list.php">Attendance</a></li>

                    <!-- Logout -->
                    <li><a href="javascript:void(0)" id="logout">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main id="main-content" class="main-content">
            <?php include("pages/home.php"); ?>
        </main>
    </div>

    <script src="js/main.js"></script>

    <script>
        // Get role from PHP session
        const role = "<?php echo $role; ?>";

        // Hide admin-only links for users
        if (role === "user") {
            document.querySelectorAll(".admin-only").forEach(el => el.style.display = "none");
        }

        // Logout confirmation
        document.getElementById("logout").addEventListener("click", e => {
            e.preventDefault();

            if (confirm("Are you sure you want to log out?")) {
                fetch("logout.php")
                    .then(() => window.location.href = "login.php");
            } else {
                document.querySelector('[data-page="home.php"]').click();
            }
        });
    </script>
</body>

</html>