<nav class="navbar navbar-expand-lg navbar-dark text-white sticky-top">

    <a href="" class="navbar-brand">
        <img src="../images/logo.jpg" width="50" height="50" class="img-thumbnail rounded-circle">
    </a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="home.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="charges.php" class="nav-link">Charges</a>
            </li>
            <li class="nav-item">
                <a href="charges_details.php" class="nav-link">Charges Summary</a>
            </li>
        </ul>
        <p class="my-2 my-lg-0">Welcome! <?php echo $_SESSION['name'];?></p>
        <p class="ml-2 my-2 my-lg-0"><a href="../logout.php">Logout</a> </p>
    </div>
</nav>