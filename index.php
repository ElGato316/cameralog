<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary rounded mb-0" style="padding:15px;">
        <h1>Log In Page</h1>
    </div>
</div>

<!-- Main Page -->
<div class="container">
    <div class="row" style="margin-top:20px;">
        <div class="col">
        </div>
        <div class="col">

            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="">User Name:</label>
                    <input type="text" name="login" id="login" class="form-control">
                    <label for="">Password:</label>
                    <input type="text" name="password" id="password" class="form-control">
                </div>
                <input type="submit" value="Enter" name="submit" class="btn btn-primary">

            </form>
        </div>
        <div class="col">
        </div>
    </div>

</div>

<?php


if (isset($_POST['submit'])) {

    if ($_POST['login'] != "" && $_POST['password'] != "") {
        $login = $_POST['login'];
        $ck_user = "SELECT id, login, name, password from users where login = '$login'";
        $result = $link->query($ck_user);
        $access = mysqli_fetch_assoc($result);

        mysqli_close($link);

        if (mysqli_num_rows($result) === 1) {
            if ($_POST['password'] === $access['password']) {
                $cookie_name = "user";
                $cookie_value = $_POST['login'];
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                header("Location:log_view.php");
            } else {
                echo "Wrong Password";
            }
        } else {
            echo "No User in Database";
        }
    } else {
        echo "Field(s) are Empty";
    }
}

?>

<!-- Footer -->
<?php require 'template/footer.php'; ?>