<?php
require_once 'db_con.php';
session_start();

if (isset($_POST['update-submit'])) {

    if (isset($_FILES['profile']['name']) && $_FILES['profile']['name'] !== '') {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $maxFileSize = 3 * 1024 * 1024; // 3 MB in bytes

        // Validate file type
        $fileExtension = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo '<script>alert("Invalid file type. Please upload a JPG or PNG image.");</script>';
            header("refresh: 0.1;url=index.php");
            exit();
        }

        // Validate file size
        if ($_FILES['profile']['size'] > $maxFileSize) {
            echo '<script>alert("File size exceeds the limit of 3 MB.");</script>';
            header("refresh: 0.1;url=index.php");
            exit();
        }

        // If validation passes, proceed with image upload
        $path = 'uploads/';
        $rename = $_POST['fname'] . '_' . date('Ymd') . '.' . $fileExtension;
        $profile = $rename;

        move_uploaded_file($_FILES['profile']['tmp_name'], $path . $rename);
    } else {
        // No file uploaded, use the existing profile
        $profile = $_SESSION['cms_data']->profile;
    }

    $update_data = [
        'fname' => mysqli_real_escape_string($con, $_POST['fname']),
        'lname' => mysqli_real_escape_string($con, $_POST['lname']),
        'phone' => mysqli_real_escape_string($con, $_POST['phone']),
        'email' => mysqli_real_escape_string($con, $_POST['email']),
        'password' => mysqli_real_escape_string($con, $_POST['password']),
        'profile' => mysqli_real_escape_string($con, $profile),
        'date_updated' => date('Y-m-d H:i:s')
    ];

    $sql = "UPDATE cms_data SET ";
    foreach ($update_data as $key => $value) {
        $sql .= "$key = '$value',";
    }

    $sql = rtrim($sql, ',');
    $sql .= " WHERE id =" . $_SESSION['cms_data']->id;
    $exec = $con->query($sql);
    if ($exec) {
        $_SESSION['cms_data']->fname = $update_data['fname'];
        $_SESSION['cms_data']->lname = $update_data['lname'];
        $_SESSION['cms_data']->phone = $update_data['phone'];
        $_SESSION['cms_data']->email = $update_data['email'];
        $_SESSION['cms_data']->password = $update_data['password'];
        $_SESSION['cms_data']->profile = $update_data['profile'];

        echo '<script>alert("Profile Updated Successfully");</script>';
        header("refresh: 0;url=index.php");
    } else {
        echo '<script>alert("Something Went Wrong");</script>';
        header("refresh: 0;url=index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMS-Me</title>
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
            color: #fff;
        }

        .rounded-circle-container {
            height: 150px;
            width: 150px;
            overflow: hidden;
            margin: 0 auto;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 0 10px 5px rgba(255, 0, 0, 0.7), /* Red glow */
                        0 0 10px 10px rgba(0, 255, 0, 0.7), /* Green glow */
                        0 0 10px 15px rgba(0, 0, 255, 0.7);
        }

        #imagePreview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        }

        h5 {
            font-size: 1.6em;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: rgb(0, 0, 0);
            font-family: 'Merienda', cursive;
            animation-name: glowh5;
            animation-duration: 2.5s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }

        @keyframes glowh5 {
            from {
                text-shadow: 0px 0px 5px #fb0d0d, 0px 0px 5px #614ad3;
            }

            to {
                text-shadow: 0px 0px 20px #fff, 0px 0px 20px #cfe816;
            }
        }
    </style>
</head>

<body class="custom-background">
    <?php include_once 'navbar.php'; ?>
    <h5 class="mt-3 text-center">My Profile</h5><br>
    <div class="rounded-circle-container mt-2 mb-5">
        <img id="imagePreview" name="profile" src="uploads/<?php echo $_SESSION['cms_data']->profile; ?>" class="img-fluid" alt="Image Preview">
    </div>
    <form action="" method="post" class="m-5" enctype="multipart/form-data">
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">First Name</span>
            <input type="text" class="form-control" value="<?php echo $_SESSION['cms_data']->fname; ?>" name="fname" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">Last Name</span>
            <input type="text" class="form-control" value="<?php echo $_SESSION['cms_data']->lname; ?>" name="lname" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">Mobile No.</span>
            <input type="tel" class="form-control" value="<?php echo $_SESSION['cms_data']->phone; ?>" name="phone" placeholder="+91790036****" aria-label="phoneno" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">Email</span>
            <input type="email" class="form-control" value="<?php echo $_SESSION['cms_data']->email; ?>" name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1">Current Password</span>
            <input type="text" class="form-control" value="<?php echo $_SESSION['cms_data']->password; ?>" name="password" placeholder="Add New Password" aria-label="email" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-4">
            <input type="file" name="profile" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Profile</label>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <input type="submit" class="btn btn-success mt-2 m-3 text-center" name="update-submit" value="Done" />
        </div>
    </form>
</body>

</html>