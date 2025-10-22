<?php
session_start();

// --- PHP LOGIN PROCESS ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Example credentials (replace with database logic)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['role'] = 'admin';
        echo 'admin';
    } elseif ($username === 'user' && $password === 'user123') {
        $_SESSION['role'] = 'user';
        echo 'user';
    } else {
        echo 'invalid';
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Faculty Class Monitoring</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover { background: #0056b3; }
        #msg { color: red; text-align: center; margin-top: 10px; }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Faculty Class Monitoring</h2>
        <form id="loginForm">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p id="msg"></p>
    </div>

    <script>
        const form = document.getElementById("loginForm");

        form.addEventListener("submit", e => {
            e.preventDefault();
            const formData = new FormData(form);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(role => {
                if (role === "admin" || role === "user") {
                    localStorage.setItem("role", role);
                    window.location.href = "index.php";
                } else {
                    document.getElementById("msg").innerText = "Invalid username or password.";
                }
            })
            .catch(() => {
                document.getElementById("msg").innerText = "Error connecting to server.";
            });
        });
    </script>
</body>
</html>
