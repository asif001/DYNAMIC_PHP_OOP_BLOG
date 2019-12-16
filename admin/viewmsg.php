<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php
$msgid = mysqli_real_escape_string($db->link, $_GET['msgid']);
if (!isset($msgid) || $msgid == null) {
    echo "<script>window.location = 'inbox.php'; </script>";
    // header("Location:catlist.php");
} else {
    $id = $msgid;
}

 ?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>View Message</h2>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php'; </script>";
}


 ?>

                <div class="block">               
                 <form action="" method="POST">   
                 <?php 
                        $query = "SELECT * FROM tbl_contact WHERE id='$id'";
                        $msg = $db->select($query);
                        if ($msg) {
                            while ($result = $msg->fetch_assoc()) {
                                ?>                 
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->formatDate($result['date']); ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly colspan="10"><?php echo $result['body']; ?></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    <?php
                            }
                        } ?>
                    </form>
                </div>
            </div>
        </div>

<!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <?php include 'inc/footer.php' ?>



