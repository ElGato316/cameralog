
<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>
<?php require 'template/cookie.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary">
        <h1>All Users</h1>
    </div>
</div>

<!-- NavBar -->
<div class="container" id="navbar">
    <?php require 'template/navbar.php'; ?>
</div>

<!-- Main Page -->
<div class="container">
            <!-- Get table data -->
            <?php
                $query = "SELECT id, login, name FROM users ORDER BY name desc";
                $users = mysqli_query($link, $query);
                $link->close();
            ?>
                <!-- Search Box -->
                <div class="container">
                <label for="SeachBox">Search For:</label>
                <input type="text" id="search" class="form-controll">                
                </div>

                <!-- Table Data -->
                <div class="container" id="table">
                <table id="users" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                        <th>Edit</th>
                        <th>ID</th>
                        <th>Login</th>
                        <th>Name</th>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $entry) { ?>
                    <tr>
                        <td><a href="user_edit.php?id=<?php echo $entry['id']?>">Edit</a></td>
                        <td><?=$entry['id'];?></td>
                        <td><?=$entry['login'];?></td>
                        <td><?=$entry['name'];?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="container">
                    <button class="btn btn-primary" onclick="location.href='user_add.php'">Add New User</button>
                </div>

                <script>
                $(document).ready(function(){
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#users tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                });
                </script>
</div>


<!-- Footer -->
<?php require 'template/footer.php'; ?>