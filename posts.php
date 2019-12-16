<?php include 'inc/header.php'; ?>

<?php 
$category = mysqli_real_escape_string($db->link, $_GET['category']);
if (!isset($category) || $category == null) {
    header("Location:404.php");
} else {
    $id = $category;
}

 ?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">

          <?php 
            $query = "SELECT * FROM tbl_post WHERE cat=$id";
            $post = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
                    ?>

<div class="samepost clear">
            <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['tittle']; ?></a></h2>
            <h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
            
                <?php echo $fm->textShorten($result['body']); ?> 
            
            <div class="readmore clear">
                <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
            </div>
        </div>

        <?php
                }
            } else {
                ?>

     <h2>No Post Available in this Category</h2>           
<?php
            } ?>

    </div>
    <?php include 'inc/sidebar.php'; ?>
    <?php include 'inc/footer.php'; ?>
