
<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>
<?php require 'template/cookie.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary">
        <h1>Add User</h1>
    </div>
</div>

<!-- NavBar -->
<div class="container" id="navbar">
    <?php require 'template/navbar.php'; ?>
</div>

<!-- Main Page -->
<div class="container">
    <form action="user_add.php" method="post">
        <div class="form-group">
          <label for="login">Login:</label>
          <input type="text" name="login" id="login" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="text" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <input type="submit" name="submit" value="Insert">
    </form>
</div>

<?php

    if(isset($_POST["submit"])){

        $ins_query = "INSERT INTO users (login, name, password) VALUES ('$_POST[login]','$_POST[name]','$_POST[password]')";

            if(mysqli_query($link, $ins_query))
            {
                echo "User added successfully";
            }else
            {
                echo "Could not enter user";
            }
    }

    mysqli_close($link);

?>


<!-- Footer -->
<?php require 'template/footer.php'; ?>