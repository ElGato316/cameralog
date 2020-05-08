
<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>
<?php require 'template/cookie.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary">
        <h1>Edit Log Entry</h1>
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

                //Populate dropdowns
                $sel_cameras = "SELECT id, SerialNumber from cameras ORDER BY SerialNumber asc";
                $sel_locations = "SELECT id, location from locations ORDER BY location asc";

                $cameras = mysqli_query($link, $sel_cameras);
                $locations = mysqli_query($link, $sel_locations);

                $sel_query = "SELECT
                                w.id,
                                w.datereported,
                                w.officername,
                                w.officerbadge,
                                l.id AS locationid,
                                l.location,
                                c.id AS damcamid,
                                c.serialnumber AS damaged,
                                w.symptom,
                                w.solution,
                                c2.id AS newcamid,
                                c2.serialnumber AS newcamera
                            FROM
                                walkinlog AS w
                            LEFT JOIN cameras AS c
                            ON
                                w.damagedcameraid = c.id
                            LEFT JOIN cameras AS c2
                            ON
                                w.newcameraid = c2.id
                            LEFT JOIN locations AS l
                            ON
                                w.locationid = l.id
                            WHERE
                                w.id = $id";

                
                $entry = mysqli_query($link, $sel_query);
                $row = mysqli_fetch_assoc($entry);

                $link->close();

                ?>

                <form action="log_edit.php" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <input type="hidden" name="id" value="<?=$row['id'];?>">
                                <label for="name">Officer Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?=$row['officername'];?>">
                                <label for="badge">Officer Badge:</label>
                                <input type="text" name="badge" id="badge" class="form-control" value="<?=$row['officerbadge'];?>">
                                <label for="date">Date Reported:</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?=$row['datereported'];?>">
                                <label for="location">Location:</label>
                                <select name="location" class="form-control">
                                    <option value="0">Select Location</option>
                                    <?php foreach ($locations as $location) { ?>
                                        <option value="<?=$location['id'];?>"><?=$location['location'];?></option>
                                    <?php } ?>
                                        <option selected="<?=$row['locationid'];?>" value="<?=$row['locationid'];?>"><?=$row['location'];?></option>
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
                                        <option value="<?=$row['damcamid'];?>" selected="<?=$row['damcamid'];?>"><?=$row['damaged'];?></option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="symptom">Symptom:</label>
                                <textarea name="symptom" id="symptom" cols="30" rows="10"><?=$row['symptom'];?></textarea>
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
                                        <option value="<?=$row['newcamid'];?>" selected="<?=$row['newcamid'];?>"><?=$row['newcamera'];?></option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="solution">Solution:</label>
                                <textarea name="solution" id="solution" cols="30" rows="10"><?=$row['solution'];?></textarea>
                                </div>
                            </div>
                                
                        </div>
                            <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    </form>

                
                <?php
            }
            if(isset($_POST['submit']))
            {
                $link = mysqli_connect($host, $user, $password, $database);

                //echo $_POST['newcam'];

                if(($_POST['newcam'] > 0))
                {
                    $upd_entry = "UPDATE walkinlog SET 
                    OfficerName = '$_POST[name]', 
                    OfficerBadge = '$_POST[badge]', 
                    DateReported = '$_POST[date]',
                    LocationID = '$_POST[location]', 
                    DamagedCameraID = '$_POST[damaged]', 
                    Symptom = '$_POST[symptom]',
                    NewCameraID = '$_POST[newcam]', 
                    Solution = '$_POST[solution]' 
                    WHERE id = '$_POST[id]'";
                }
                else
                {
                    $upd_entry = "UPDATE walkinlog SET 
                    OfficerName = '$_POST[name]', 
                    OfficerBadge = '$_POST[badge]', 
                    DateReported = '$_POST[date]',
                    LocationID = '$_POST[location]', 
                    DamagedCameraID = '$_POST[damaged]', 
                    Symptom = '$_POST[symptom]',
                    Solution = '$_POST[solution]' 
                    WHERE id = '$_POST[id]'";
                }

                
                //echo $upd_entry;
                if($link->query($upd_entry) === true)
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