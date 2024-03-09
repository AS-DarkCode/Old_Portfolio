<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: white; font-weight: bold;">CMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['cms_data'])) {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="add-contact.php" style="color: white;">Add</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="me.php" style="color: white;">Me</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php" style="color: white;">Logout</a>
                    </li>';
                
                } else {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="about.php" style="color: white;">About</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="login.php" style="color: white;">Login</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="ragistration.php" style="color: white;">Registration</a>
                     </li>'
                     ;
                }
                ?>
            </ul>
        </div>
    </div>
</nav>