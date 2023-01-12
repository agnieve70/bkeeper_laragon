<!-- Top navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary btn-sm" id="sidebarToggle"><i class="fa fa-bars"></i></button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i> <span class="badge bg-secondary">
                            <?php
                            $sql = "SELECT * FROM notification WHERE user_id =  " . $_SESSION['user_id']. " AND code != ''";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            echo $count;
                            ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end px-2" aria-labelledby="navbarDropdown">

                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<span class="fs-6" style="font-size: 8px">
                                        <a  style="font-size: 8px" class="text-decoration-none fs-6" href="'.$row['link'].'&code='.$row['code'].'">'.$row['title'].'</a>
                                        </span>
                        <div class="dropdown-divider"></div>';
                            }
                        }
                        ?>
                        <center><a  href="http://localhost/bkeeper_laragon/bkeeper-notification.php" class="text-center text-decoration-none">View All</a></center>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
                        Profile</a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <span class="text-center ms-2 text-primary"><b>Hello Bookkeeper!</b></span>
<!--                        <a class="dropdown-item" href="#!"><i class="fa fa-cog"></i> Settings</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>