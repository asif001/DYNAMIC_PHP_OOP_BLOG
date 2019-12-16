<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                $seenid = mysqli_real_escape_string($db->link, $_GET['seenid']);
if (isset($seenid)) {
    $seenid = $seenid;
    $query = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenid'";
    $update_row = $db->update($query);
    if ($update_row) {
        echo "<span class='success'>Message move to seen box</span>";
    } else {
        echo "<span class='error'>Something Wrong</span>";
    }
}



 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Sender</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
                        $query = "SELECT * FROM tbl_contact WHERE status ='0' ORDER BY id DESC";
                        $msg = $db->select($query);
                        if ($msg) {
                            $i = 0;
                            while ($result = $msg->fetch_assoc()) {
                                $i++; ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->textShorten($result['body'], 30); ?></td>
                            <td><?php echo $fm->formatDate($result['date']); ?></td>
                            <td>
                                <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
                                <a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || 
                                <a onclick="return confirm('Are you sure to Move this message?');" href="?seenid=<?php echo $result['id']; ?>">Seen</a>
                                
                            </td>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
               </div>
            </div>
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <?php
                // Seen Message Delete Query
                if (isset($_GET['delid'])) {
                    $delid = $_GET['delid'];
                    $delquery = "DELETE FROM tbl_contact WHERE id = '$delid'";
                    $deldata = $db->delete($delquery);
                    if ($deldata) {
                        echo "<span class='success'>Message Deleted Successfully.</span>";
                    } else {
                        echo "<span class='error'>Message Not Deleted.</span>";
                    }
                }
                 ?>
                <?php 
                // Move to inbox
                if (isset($_GET['unseenid'])) {
                    $unseenid = $_GET['unseenid'];
                    $query = "UPDATE tbl_contact SET status = '0' WHERE id = '$unseenid'";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success'>Message move to Unseen Box</span>";
                    } else {
                        echo "<span class='error'>Something Wrong</span>";
                    }
                }                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Sender</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
                        $query = "SELECT * FROM tbl_contact WHERE status ='1' ORDER BY id DESC";
                        $msg = $db->select($query);
                        if ($msg) {
                            $i = 0;
                            while ($result = $msg->fetch_assoc()) {
                                $i++; ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->textShorten($result['body'], 30); ?></td>
                            <td><?php echo $fm->formatDate($result['date']); ?></td>
                            <td>
                                <a onclick="return confirm('Are you sure to Delete?');" href="?delid=<?php echo $result['id']; ?>">Delete</a> || 
                                <a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
                                <a href="?unseenid=<?php echo $result['id']; ?>">Unseen</a>                             
                            </td>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
               </div>
            </div>
        </div>

        <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>

        <?php include 'inc/footer.php' ?>
