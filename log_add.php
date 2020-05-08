
<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>
<?php require 'template/cookie.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary">
        <h1>Add Entry</h1>
    </div>
</div>

<!-- NavBar -->
<div class="container" id="navbar">
    <?php require 'template/navbar.php'; ?>
</div>

<?php
    //Populate dropdowns
    $sel_cameras = "SELECT id, SerialNumber from cameras ORDER BY SerialNumber asc";
    $sel_locations = "SELECT id, location from locations ORDER BY location asc";

    $cameras = mysqli_query($link, $sel_cameras);
    $locations = mysqli_query($link, $sel_locations);

    mysqli_close($link);
?>

<!-- Main Page -->
<div class="container align-top">

    <form action="log_add.php" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                <label for="name">Officer Name:</label>
                <input type="text" name="name" id="name" class="form-control">
                <label for="badge">Officer Badge:</label>
                <input type="text" name="badge" id="badge" class="form-control">
                <label for="date">Date Reported:</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                <label for="location">Location:</label>
                <select name="location" class="form-control">
                    <option value="0">Select Location</option>
                    <?php foreach ($locations as $location) { ?>
                        <option value="<?=$location['id'];?>"><?=$location['location'];?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <label for="damaged">Damaged Camera:</label>
                <select name="damaged" class="form-control">
                    <option value="0">Select Camera</option>
                    <?php foreach ($cameras as $camera) { ?>
                        <option value="<?=$camera['id'];?>"><?=$camera['SerialNumber'];?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group">
                <label for="symptom">Symptom:</label>
                <textarea name="symptom" id="symptom" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <label for="newcam">New Camera:</label>
                <select name="newcam" class="form-control">
                    <option value="0">Select Camera</option>
                    <?php foreach ($cameras as $camera) { ?>
                        <option value="<?=$camera['id'];?>"><?=$camera['SerialNumber'];?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group">
                <label for="solution">Solution:</label>
                <textarea name="solution" id="solution" cols="30" rows="10"></textarea>
                </div>
            </div>
                
        </div>
            <input type="submit" name="submit" value="Insert" class="btn btn-primary">
    </form>
</div>

<?php

    if(isset($_POST["submit"])){

        $link = mysqli_connect($host, $user, $password, $database);

        $ins_query = "INSERT INTO walkinlog (OfficerName, OfficerBadge, Symptom, Solution, DamagedCameraID, NewCameraID,
        LocationID, DateReported) 
        VALUES 
        ('$_POST[name]','$_POST[badge]','$_POST[symptom]', '$_POST[solution]','$_POST[damaged]','$_POST[newcam]',
        '$_POST[location]','$_POST[date]')";

        //echo $ins_query;

            if(mysqli_query($link, $ins_query))
            {
                echo "Record added successfully";
            }else
            {
                echo "Could not enter record";
            }
            mysqli_close($link);
    }

?>


<!-- Footer -->
<?php require 'template/footer.php'; ?>