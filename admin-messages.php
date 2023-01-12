<?php
session_start();

if (!isset($_SESSION['role'])) {
    echo '<script>window.location.href="login.php"</script>';
}
require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>BKEEPER</title>
    <!-- Favicon-->
    <!-- <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="dashboard/css/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .avatar {
            vertical-align: middle;
            border-radius: 50%;
        }

        .checked {
            color: orange;
        }
    </style>
</head>

<body>
<div class="d-flex" id="wrapper">
    <?php
    include('admin-sidebar.php');
    ?>

    <?php
    if(isset($_GET['code'])){
        $sql2 = "UPDATE notification SET `code`='"."' WHERE `code` = '" .$_GET['code']. "'";
        $conn->query($sql2);
    }

    ?>

    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <?php
        include('admin-nav.php');
        ?>
        <!-- Page content-->
        <div class="container-fluid">
            <h1 class="mt-4">Messages</h1>
            <!-- <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p> -->
            <div class="row px-5 mt-5">
                <div class="col-md-3 bg-primary p-2">
                    <ul class="list-group">
                        <?php
                        $sql = "SELECT distinct id, name FROM users WHERE id != " . $_SESSION['user_id'] . "
                        AND id IN (SELECT bkeeper_id FROM applicants WHERE client_id = " . $_SESSION['user_id'] . ")
                        OR id IN (SELECT bkeeper_id FROM bkeepers WHERE client_id = " . $_SESSION['user_id'] . ")
                        OR id IN (SELECT `from` FROM message WHERE `to` = " . $_SESSION['user_id'] . ") ";

                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['id'] !== $_SESSION['user_id']) {
                                    echo ' <li class="list-group-item">
                                <a href="http://localhost/bkeeper_laragon/admin-messages.php?to_id=' . $row['id'] . '&to_name=' . $row['name'] . '" class="text-decoration-none">
                                <h6>' . $row['name'] . '</h6>
                                </a>
                            </li>';
                                }
                            }
                        }
                        ?>

                    </ul>
                </div>
                <div class="col-md-9 px-5 h-96">
                    <?php echo isset($_GET['to_name']) ? '<h4>' . $_GET['to_name'] . '</h4>' : '' ?>
                    <?php

                    if (isset($_GET['to_id']) && isset($_GET['to_name'])) {

                        $sql2 = "SELECT `id`, `message`, `date`, (SELECT name from users WHERE users.id = `from`) as `from_name`,
                            (SELECT name from users WHERE users.id = `to`) as `to_name` from message WHERE `to` = " . $_GET['to_id'] . " OR `to` = " . $_SESSION['user_id']
                            . ' AND `from` = ' . $_SESSION['user_id'] . ' OR `from` = ' . $_GET['to_id'];

                        $result = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="row mb-3">';
                            echo '<div class="col-md-4" style="height:250px; overflow:scroll">';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="p-2">
                                            <h6>' . $row['date'] . ' <br/> <span>' . $row['from_name'] . '</span></h6>
                                            <p>' . $row['message'] . '</p>
                                        </div>
                                       ';
                            }
                            echo '</div>';
                            echo '</div>';

                        }
                    }
                    ?>

                    <?php
                    if (isset($_POST['send_message'])) {
                        $message = $_POST['message'];
                        $to_id = $_POST['to_id_post'];
                        $to_name = $_POST['to_name_post'];

                        $sql = "INSERT INTO message (`from`, `to`, `date`, `message`)
                                VALUES (" . $_SESSION['user_id'] . ", " . $to_id . ", '" . date("Y-m-d h:i:sa") . "', '" . $message . "')";

                        $str = rand();
                        $rand = md5($str);

                        $sql2 = "INSERT INTO notification (`title`, `link`, `user_id`, `date`, `code`)
                                VALUES ('Message From Client', 
                                        'http://localhost/bkeeper_laragon/bkeeper-messages.php?to_id=" . $_SESSION['user_id'] . "&to_name=" . $_SESSION['name'] . "',
                                        '" . $to_id . "',
                                        '" . date("Y-m-d h:i:sa") . "', '".$rand."')";

                        mysqli_query($conn, $sql2);

                        if (mysqli_query($conn, $sql)) {
                            echo '<script>alert("Message Successfully Send"); window.location.href="http://localhost/bkeeper_laragon/admin-messages.php?to_id=' . $to_id . '&to_name=' . $to_name . '" </script>';
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        echo $message;
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-4">

                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <textarea class="form-control" rows="5" name="message"></textarea>
                                <input class="btn btn-primary float-end mt-2" type="submit" name="send_message"
                                       value="Send Message"/>
                                <input name="to_id_post" value="<?php echo (isset($_GET['to_id'])) ? $_GET['to_id']: ''; ?>" hidden/>
                                <input name="to_name_post" value="<?php echo (isset($_GET['to_name'])) ? $_GET['to_name']: ''; ?>" hidden/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="dashboard/js/scripts.js"></script>
</body>

</html>