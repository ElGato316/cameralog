
<!-- Header -->
<?php require 'template/header.php'; ?>
<?php require 'template/config.php'; ?>
<?php require 'template/cookie.php'; ?>

<!-- Page Banner -->
<div class="container" id="pageheader">
    <div class="page-header text-center bg-primary">
        <h1>Walk In Log</h1>
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
                      $sel_query = "select
                                    w.id,
                                    w.datereported,
                                    w.officername,
                                    w.officerbadge,
                                    l.location,
                                    c.serialnumber as damaged,
                                    w.symptom,
                                    w.solution,
                                    c2.serialnumber as newcamera
                                from
                                    walkinlog as w
                                        left join cameras as c on w.damagedcameraid = c.id
                                        left join cameras as c2 on w.newcameraid = c2.id
                                    left join locations as l on w.locationid = l.id

                                order by w.datereported desc";
                $entries = mysqli_query($link, $sel_query);
                $link->close();
            ?>
                <!-- Search Box
                <div class="container">
                <label for="SeachBox">Search For:</label>
                <input type="text" id="search" class="form-controll">                
                </div> -->

                <!-- Table Data -->
                <div class="container" id="table">
                <table id="entry" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                        <th>Edit</th>
                        <!-- <th>ID</th> -->
                        <th>Date Reported</th>
                        <th>Officer</th>
                        <th>Badge</th>
                        <th>Location</th>
                        <th>Damaged</th>
                        <th>Symptom</th>
                        <th>Solution</th>
                        <th>New Cam</th>
                    </thead>
                    <tbody>
                    <?php foreach ($entries as $entry) { ?>
                    <tr>
                        <td><a href="log_edit.php?id=<?php echo $entry['id']?>">Edit</a></td>
                        <!-- $entry['id'] place holder-->
                        <td><?=$entry['datereported'];?></td>
                        <td><?=$entry['officername'];?></td>
                        <td><?=$entry['officerbadge'];?></td>
                        <td><?=$entry['location'];?></td>
                        <td><?=$entry['damaged'];?></td>
                        <td><?=$entry['symptom'];?></td>
                        <td><?=$entry['solution'];?></td>
                        <td><?=$entry['newcamera'];?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="container">
                    <button class="btn btn-primary" onclick="location.href='log_add.php'">Add New Entry</button>
                </div>

                <script>
                    $(document).ready(function () {
                    $('#entry').DataTable({
                        "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
                    });
                    $('.dataTables_length').addClass('bs-select');
                    });
                </script>

                <!-- <script>
                $(document).ready(function(){
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#entry tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                });
                </script> -->
</div>


<!-- Footer -->
<?php require 'template/footer.php'; ?>