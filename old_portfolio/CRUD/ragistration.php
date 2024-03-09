<?php
require_once 'db_con.php';
session_start();

if (isset($_POST['submit'])) {
    $path = 'uploads/';
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $rename = $_POST['fname'] . '_' . date('YmdHis') . '.' . $extension;
    $profile = (file_exists($_FILES['file']['tmp_name']) ? $rename : null);

    $submittedEmail = $_POST['email'];
    $sqlemail = "SELECT * FROM cms_data WHERE email = '$submittedEmail'";
    $result = $con->query($sqlemail);

    if ($result->num_rows > 0) {

        echo '<script>alert("This email already exists. Please log in.");
        window.location.href = "registration.php";</script>';
        exit();
    };

    $insert_data = [
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'profile' => $profile,
    ];

    $columns = implode(',', array_keys($insert_data));
    $values =  implode("','", array_values($insert_data));
    $sql = "INSERT INTO cms_data ($columns) VALUES ('$values')";

    $insert = $con->query($sql);

    if ($insert) {
        if (!is_null($profile)) {
            move_uploaded_file($_FILES['file']['tmp_name'], $path . $rename);
        }
        echo '<script>alert("Data Uploaded successfully"); 
        window.location.href = "login.php";
        </script>';
        exit();
    } else {
        echo '<script>alert("Something Went wrong"); window.location.href = "registration.php";</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMS-Register</title>
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
            color: rgba(0, 0, 0);
            font-family: 'Merienda', cursive;
            animation-name: glowh5;
            animation-duration: 2.5s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }

        @keyframes glowh5 {
            from {
            text-shadow: 0px 0px 5px #ff1493, 0px 0px 5px #32cd32;
        }
        to {
            text-shadow: 0px 0px 20px linear-gradient(45deg, #ff4500, #008000 70%);
        }
    }
    </style>
</head>

<body class="custom-background">
    <?php include_once 'navbar.php'; ?>
    <img src="img/Contact.jpg" class="img-fluid" alt="...">
    <h5 class=" mt-3 text-center">Contact Management System <br>Register Here</h5>
    <form action="" method="post" class="m-3" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">First Name</span>
            <input type="text" class="form-control" name="fname" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Last Name</span>
            <input type="text" class="form-control" name="lname" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mobile No.</span>
            <input type="tel" class="form-control" name="phone" placeholder="+91790036****" aria-label="phoneno" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Email</span>
            <input type="email" class="form-control" name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Password</span>
            <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <input type="file" name="file" class="form-control" id="inputGroupFile02" required>
            <label class="input-group-text" for="inputGroupFile02">Profile</label>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <input type="submit" class="btn btn-success mt-2 mb-3 text-center" name="submit" value="Register" />
        </div>
    </form>

</body>

</html>