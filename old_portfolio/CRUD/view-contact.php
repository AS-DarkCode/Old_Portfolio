<?php

session_start();
require "db_con.php";

if ($_GET['user']) {
    $uid = mysqli_real_escape_string($con, $_GET['user']);
    $select_user = "SELECT * FROM cms_user WHERE id=$uid";
    $select_exec = $con->query($select_user);
    $user_data = $select_exec->fetch_object();
} else {
    header("Location:index.php");
}


$ownerid = !empty($_SESSION['cms_data']) ? $_SESSION['cms_data']->id : null;

if (isset($_POST['update']) && !empty($_SESSION['cms_data'])) {

    // File upload conditions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $maxFileSize = 3 * 1024 * 1024; // 3 MB in bytes

    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
        // Validate file type
        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo '<script>alert("Invalid file type. Please upload a JPG, JPEG, or PNG image.");</script>';
            header("refresh: 0.1;url=view-contact.php?user=$uid");
            exit();
        }

        // Validate file size
        if ($_FILES['file']['size'] > $maxFileSize) {
            echo '<script>alert("File size exceeds the limit of 3 MB.");</script>';
            header("refresh: 0.1;url=view-contact.php?user=$uid");
            exit();
        }

        // If validation passes, proceed with image upload
        $path = 'cms_data/';
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $rename = $_POST['fname'] . '_' . date('Ymd') . '.' . $extension;
        $profile = $rename;

        move_uploaded_file($_FILES['file']['tmp_name'], $path . $rename);
    } else {
        // No file uploaded, use the existing profile
        $profile = $user_data->file;
    }

    // $path = 'cms_data/';
    // $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    // $rename = $_POST['fname'] . '_' . date('Ymd') . '.' . $extension;
    // $profile = (file_exists($_FILES['file']['tmp_name'])) ? $rename : $user_data->file;

    $update_data = [
        'fname' => mysqli_real_escape_string($con, $_POST['fname']),
        'lname' => mysqli_real_escape_string($con, $_POST['lname']),
        'phone' => mysqli_real_escape_string($con, $_POST['phone']),
        'email' => mysqli_real_escape_string($con, $_POST['email']),
        'comment' => mysqli_real_escape_string($con, $_POST['comment']),
        'file' => mysqli_real_escape_string($con, $profile),
        'Owner_id' => mysqli_real_escape_string($con, $ownerid)
    ];
    $sql = "UPDATE cms_user SET ";
    foreach ($update_data as $key => $value) {
        $sql .= "$key = '$value',";
    }

    $sql = rtrim($sql, ',');
    $sql .= "WHERE id =" . $uid;
    $exec = $con->query($sql);

    if ($exec) {
        echo '<script>alert("Contact Updated Successfully");</script>';
        header("refresh: 0.1;url=index.php");
    } else {
        echo '<script>alert("Something Went wrong"); window.location.href = "registration.php";</script>';
        header("refresh: 5;url=index.php");
    }
}

if (isset($_POST['delete'])) {
    $deleteUserId = $_GET['user'];

    $deleteSql = "DELETE FROM cms_user WHERE id = $deleteUserId AND Owner_id = $ownerid";
    $deleteResult = $con->query($deleteSql);

    if ($deleteResult) {
        echo '<script>alert("Contact Deleted Successfully"); window.location.href = "index.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error deleting contact"); window.location.href = "index.php";</script>';
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMS-View-contact</title>
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
            box-shadow: 0 0 10px 5px rgba(255, 0, 0, 0.7),
                /* Red glow */
                0 0 10px 10px rgba(0, 255, 0, 0.7),
                /* Green glow */
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
            color: white;
            font-family: 'Merienda', cursive;
            animation-name: glowh5;
            animation-duration: 2.5s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }

        @keyframes glowh5 {
        from {
            text-shadow: 0px 0px 5px #ff0000, 0px 0px 5px #00ff00; /* Red and green */
        }

        to {
            text-shadow: 0px 0px 20px #0000ff, 0px 0px 20px #ffff00; /* Blue and yellow */
        }
    }
    </style>
</head>

<body class="custom-background">

    <?php include_once 'navbar.php' ?>

    <h5 class="mt-3 text-center">View-Edit-Delete (:- Contact</h5><br>
    <div class="rounded-circle-container mt-2 mb-5">
        <img id="imagePreview" src="cms_data/<?php echo $user_data->file; ?>" class="rounded-circle mx-auto d-block" alt="">
    </div>
    <form action="" method="post" class="mt-3" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">First Name</span>
            <input type="text" class="form-control" value="<?php echo $user_data->fname; ?>" name="fname" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Last Name</span>
            <input type="text" class="form-control" value="<?php echo $user_data->lname; ?>" name="lname" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mobile No.</span>
            <input type="tel" class="form-control" value="<?php echo $user_data->phone; ?>" name="phone" placeholder="+91790036****" aria-label="phoneno" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Email</span>
            <input type="email" class="form-control" value="<?php echo $user_data->email; ?>" name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Address</span>
            <input type="text" class="form-control" value="<?php echo $user_data->email; ?>" name="comment" placeholder="Address" aria-label="email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <input type="file" name="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Profile</label>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <input type="submit" class="btn btn-success mt-2 m-3 text-center" name="update" value="Update" />
            <button type="submit" class="btn btn-danger mt-2 m-3 text-center" name="delete">Delete</button>
        </div>
    </form>
</body>
<script>
    function previewImage() {
        var input = document.getElementById('imageInput');
        var previewContainer = document.getElementById('imagePreviewContainer');
        var previewImage = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var file = input.files[0];

            // Create a FileReader object to read the file
            var reader = new FileReader();

            // Set up the FileReader onload event to display the image when loaded
            reader.onload = function(e) {
                previewImage.src = e.target.result; // Set the source of the preview image
            };

            // Read the selected file as a data URL, triggering the onload event
            reader.readAsDataURL(file);

            // Show the image preview container
            previewContainer.style.display = 'block';
        } else {
            // If no file is selected, hide the image preview container
            previewContainer.style.display = 'none';
        }
    }
</script>

</html>