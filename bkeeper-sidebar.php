<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-primary text-white">BKEEPER</div>
    <center>
        <div class="rounded">
            <img src="profile_pictures/<?php echo $_SESSION['profile_picture'] ?>" width="200px" height="200px" alt="Avatar" class="avatar my-3">
        </div>
    </center>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-find-client.php"><i class="fa fa-search"></i> Find Client</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-clients.php"><i class="fa fa-users"></i> Clients</a>
        <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-documents.php"><i class="fa fa-users"></i> Documents</a> -->
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-applied.php"><i class="fa fa-user-plus"></i> Applied Clients</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-details.php"><i class="fa fa-file"></i> My Resume</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-messages.php"><i class="fa fa-envelope"></i> Messages</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="bkeeper-notification.php"><i class="fa fa-bell"></i> Notifications</a>
    </div>
</div>