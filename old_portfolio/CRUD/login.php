<?php
include 'db_con.php';
session_start();

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM cms_data WHERE email = '$email' AND password = '$password'";
    $exec = $con->query($sql);

    if ($exec->num_rows > 0) {
        $_SESSION['cms_data'] = $exec->fetch_object();

        echo '<script>
            alert("Login Successfully ");
            window.location.href = "index.php";
        </script>';
        exit();
    } else {
        echo '<script>alert("Email or Password is invalid.");
        window.location.href = "ragistration.php";</script>';
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMS-Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .custom-background {
            background: linear-gradient(to right, #2c3e50, #34495e, #2c3e50, #34495e);  
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); 
            margin: 0;
            padding: 0; 
            color: white;
        }

                h5 {
            font-size: 1.6em;
            font-weight: 600;
            text-align: center;
            color: rgba(0,0,0);
            font-family: 'Merienda', cursive;
            animation-name: glowh5;
            animation-duration: 2.5s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }

        @keyframes glowh5 {
        from {
            text-shadow: 0px 0px 5px #008080, 0px 0px 5px #800080; /* Teal and purple */
        }

        to {
            text-shadow: 0px 0px 20px #ff1493, 0px 0px 20px #32cd32; /* Deep pink and lime green */
      
    </style>
</head>

<body class="custom-background">

    <?php include_once 'navbar.php'; ?>
    <img src="img/Contact.jpg" class="img-fluid" alt="...">
    <?php
    if (isset($_SESSION['cms_data'])) {
        echo "<h4 style='color: rgb(53, 248, 53);'> Welcome " . $_SESSION['cms_data']->fname . " " . $_SESSION['cms_data']->lname . "</h4>";
    }
    ?>
    <h5 class=" mt-3 text-center">Contact Management System <br>Login Here</h5>
    <form method="post" class="mt-3">
        <div class="mb-3 m-4">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text mt-2 " style="color: rgb(231, 79, 104);">We'll never share your email with anyone else .<b>Please Use Dummy data</div>
        </div>
        <div class="mb-3 m-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="mb-3 m-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Check me</label>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <button type="submit" name="login" class="btn btn-dark mt-2 mb-3 text-center">Submit</button>
        </div>
    </form>
</body>

</html>