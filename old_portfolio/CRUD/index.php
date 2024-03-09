<?php
session_start();
require "db_con.php";

if (!isset($_SESSION['cms_data'])) {
    header('Location:login.php');
}

$ownerid = !empty($_SESSION['cms_data']) ? $_SESSION['cms_data']->id : null;

// Handle search
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    
    // Use the LIKE operator with wildcard % for partial matching
    $sql = "SELECT * FROM cms_user WHERE Owner_id = $ownerid AND (fname LIKE '%$search_query%' OR phone LIKE '%$search_query%')";
    $exec = $con->query($sql);

    if ($exec->num_rows > 0) {
        while ($data = $exec->fetch_object()) {
            $users[] = $data;
        }
    } else {
        $search_message = "No matching contacts found.";
    }
} else {
    // Retrieve all contacts
    $sql = "SELECT * FROM cms_user WHERE Owner_id = $ownerid";
    $exec = $con->query($sql);

    if ($exec->num_rows > 0) {
        while ($data = $exec->fetch_object()) {
            $users[] = $data;
        }
    } else {
        $search_message = "No contacts found. Please add a contact.";
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

    <h5 class="mt-3 text-center">Contact List</h5><br>
    <form action="" method="post" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Name or Mobile" name="search_query" required>
            <button type="submit" class="btn btn-primary" name="search">Search</button>
        </div>
    </form>

    <?php if (isset($users) && count($users) > 0) : ?>
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                foreach ($users as $user) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $user->fname; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td>
                            <button type="submit" name="submit" class="btn btn-success mt-2 mb-3 text-center">
                                <a href="view-contact.php?user=<?php echo $user->id; ?>" style="text-decoration: none; color:Black;">View</a>
                            </button>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    <?php else : ?>
        <?php if (isset($search_message)) : ?>
            <p><?php echo $search_message; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>