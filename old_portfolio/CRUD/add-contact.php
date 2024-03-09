<?php

session_start();
require "db_con.php";

if (!isset($_SESSION['cms_data'])) {
    header('Location:login.php');
}

$ownerid = !empty($_SESSION['cms_data']) ? $_SESSION['cms_data']->id : null;

if (isset($_POST['submit']) && !empty($_SESSION['cms_data'])) {

    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $maxFileSize = 3 * 1024 * 1024; // 3 MB in bytes

        // Validate file type
        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo '<script>alert("Invalid file type. Please upload a JPG or PNG image.");</script>';
            header("refresh: 0.1;url=index.php");
            exit();
        }

        // Validate file size
        if ($_FILES['file']['size'] > $maxFileSize) {
            echo '<script>alert("File size exceeds the limit of 3 MB.");</script>';
            header("refresh: 0.1;url=index.php");
            exit();
        }

        // If validation passes, proceed with image upload
        $path = 'cms_data/';
        $rename = $_POST['fname'] . '_' . date('Ymd') . '.' . $fileExtension;
        $profile = $rename;

        move_uploaded_file($_FILES['file']['tmp_name'], $path . $rename);
    } else {
        // No file uploaded, use the existing profile
        $profile = $_SESSION['cms_data']->profile;
    }
    // $path = 'cms_data/';
    // $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    // $rename = $_POST['fname'] . '_' . date('Ymd') . '.' . $extension;
    // $profile = (file_exists($_FILES['file']['tmp_name']) ? $rename : null);

    $insert_data = [
        'fname' => mysqli_real_escape_string($con, $_POST['fname']),
        'lname' => mysqli_real_escape_string($con, $_POST['lname']),
        'phone' => mysqli_real_escape_string($con, $_POST['phone']),
        'email' => mysqli_real_escape_string($con, $_POST['email']),
        'comment' => mysqli_real_escape_string($con,$_POST['comment']),
        'file' => mysqli_real_escape_string($con, $profile),
        'Owner_id' => mysqli_real_escape_string($con, $ownerid)
    ];

    $col = implode(',', array_keys($insert_data));
    $value = implode("','", array_values($insert_data));
    $sql = "INSERT INTO cms_user ($col) VALUES ('$value')";
    $insert = $con->query($sql);



    if ($insert) {
        if (!is_null($profile)) {
            move_uploaded_file($_FILES['file']['tmp_name'], $path . $rename);
        }
        echo '<script>alert("Contact Saved");</script>';
        header("Refresh: 0.1;url = index.php");
    } else {
        echo '<script>alert("Something Went wrong"); window.location.href = "registration.php";</script>';
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMS-Add Contact</title>
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
            color: rgba(0,0,0,.3);
            font-family: 'Merienda', cursive;
            animation-name: glowh5;
            animation-duration: 2.5s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
        }

        @keyframes glowh5 {
        from {
            text-shadow: 0px 0px 5px #ff4500, 0px 0px 5px #8a2be2; /* Orange and purple */
        }

        to {
            text-shadow: 0px 0px 20px #00ced1, 0px 0px 20px #ffd700; /* Turquoise and gold */
        }
    }
    </style>
</head>

<body class="custom-background">
    <?php include_once 'navbar.php' ?>

    <div class="add">
        <div class="add_div">
        <h5 class="mt-3 text-center">Add Contact</h5><br>

            <div class="rounded-circle-container mt-2 mb-5">
                <img id="imagePreview" class="rounded-circle mx-auto d-block" alt="">
            </div>
            <div id="imagePreviewContainer">
            </div>

            <form action="" method="post" class="mt-3" enctype="multipart/form-data">
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
                    <span class="input-group-text" id="basic-addon1">Address</span>
                    <input type="text" class="form-control" name="comment" placeholder="Address" aria-label="Username" aria-describedby="basic-addon1" required>
                </div><br>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="file" id="imageInput" required onchange="previewImage()">
                </div>
                <div class="d-flex align-items-center justify-content-center">
                <input type="submit" class="btn btn-success mt-2 mb-3 text-center" name="submit" value="Save" />
                </div>
            </form>
        </div>
    </div>

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
</body>

</html>