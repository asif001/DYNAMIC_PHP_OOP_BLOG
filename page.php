<?php include 'inc/header.php' ?>
<?php
$pagesid = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($pagesid) || $pagesid == null) {
    // echo "<script>window.location = 'index.php'; </script>";
    header("Location:404.php");
} else {
    $pageid = $pagesid;
}

 ?>
<?php 
                    $pagequery = "SELECT * FROM tbl_page WHERE id = '$pageid'";
                    $pagedetails = $db->select($pagequery);
                    if ($pagedetails) {
                        while ($result = $pagedetails->fetch_assoc()) {
                            ?>  
    <div class="contentsection contemplete clear">
        <div class="maincontent clear">
            <div class="about">
                
                <h2><?php echo $result['name']; ?></h2>
    
                <?php echo $result['body']; ?>


    </div>

        </div>
        <?php
                        }
                    } else {
                        header("Location:404.php");
                    }
                        ?>
        <?php include 'inc/sidebar.php'; ?>
    <?php include 'inc/footer.php'; ?>
