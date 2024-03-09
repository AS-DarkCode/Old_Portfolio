<?php
require 'db_con.php';
session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $name = mysqli_real_escape_string($con, $_POST['name']);

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $exec = $con->query($sql);

    if ($exec->num_rows > 0) {
        $user = $exec->fetch_object();
        $hashedPassword = $user->password;

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_session'] = $user;
            $_SESSION['name'] = $name;
            echo   '<script>alert("Login Successfully");
                window.location.href = "index.php";
            </script>';
        } else {
            echo '<script>
                alert("Incorrect Username or Password. Please try again.");
                window.location.href = "login.php";
            </script>';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background: linear-gradient(to right, rgb(15, 23, 42), rgb(88, 28, 135), rgb(15, 23, 42));
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            background: radial-gradient(at center top, rgb(180, 83, 9), rgb(253, 186, 116), rgb(159, 18, 57));
            -webkit-background-clip: text;
            color: transparent;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl mb-10">Login Here Thanks For Scan QR</h2>
            <form method="post">
                <div class="mb-4">
                    <label for="username" class="block text-2xl font-medium text-dark-600">Username</label>
                    <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter Username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-2xl font-medium text-dark-600">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter Password" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-2xl font-medium text-dark-600">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter Your Name Please" required>
                </div>
                <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800" type="submit" name="submit">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Login Here
                    </span>
                </button>
            </form>
        </div>
    </div>
</body>

</html>