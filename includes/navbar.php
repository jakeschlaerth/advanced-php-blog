<div class="navbar">
    <div class="logo_div">
        <a href="index.php">
            <h1>Jake's Blog</h1>
        </a>
    </div>
    <ul>
        <?php if (isset($_SESSION['user'])) { ?>
            <li><a class="active" href="create_post.php">Create new post</a></li>
            <li><a class="active" href="edit_posts.php">Edit your posts</a></li>
        <?php } ?>
        <li><a class=active href="index.php">Home</a></li>
        <li><a class=active href="https://www.jakeschlaerth.com">About</a></li>
    </ul>
</div>