
<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>
<?php require 'template/cookie.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary">
        <h1>Edit User</h1>
    </div>
</div>

<!-- NavBar -->
<div class="container" id="navbar">
    <?php require 'template/navbar.php'; ?>
</div>

<!-- Main Page -->

    <div class="container">
        <?php
            
            
            if(isset($_GET['id']))
            {
                $id = $_GET["id"];

                $sel_user = "SELECT id, login, name, password FROM users WHERE id = $id";
                
                $user = mysqli_query($link, $sel_user);
                $row = mysqli_fetch_assoc($user);

                $link->close();

                ?>

                    <form action="user_edit.php" method="post">
                    <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="hidden" name="id" id="" value="<?=$row['id']?>">
                    <input type="text" name="login" id="login" class="form-control" value="<?=$row['login']?>">
                    </div>
                    <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?=$row['name']?>">
                    </div>
                    <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" class="form-control" value="<?=$row['password']?>">
                    </div>
                    <input type="submit" name="submit" value="Update">
                    </form>
                
                <?php
            }
            if(isset($_POST['submit']))
            {
                $link = mysqli_connect($host, $user, $password, $database);

                $upd_user = "UPDATE users SET login = '$_POST[login]', name = '$_POST[name]', password = '$_POST[password]' WHERE id = '$_POST[id]'";
                
                if($link->query($upd_user) === true)
                {
                    echo "Record updated successfully";
                }else
                {
                    echo "Error updating record: ". $link->error;
                }
                $link->close();
            }

        ?>    
    </div>

<!-- Footer -->
<?php require 'template/footer.php'; ?>