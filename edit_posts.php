<?php require('config.php') ?>
<?php require(ROOT_PATH . '/includes/public_functions.php') ?>
<?php require(ROOT_PATH . '/includes/post_CRUD.php') ?>

<?php
$topics = getTopics();
$posts = getPostsByUser($_SESSION['user']['id']);
?>
<?php include('includes/head.php'); ?>
<title>Edit existing posts</title>
</head>

<body>
    <div class="container">
        <?php include('includes/navbar.php') ?>
        <?php include('includes/banner.php') ?>
        <!-- if post slug exists in url query string, load an edit form. else load all posts to choose from. -->
        <?php if (isset($_GET['post-slug'])) { ?>
            <?php
            $post = getPost($_GET['post-slug']);
            $post_topic = getPostTopic($post['id']);
            ?>
            <h2 class="content-title"><?php echo 'Editing: ' . $post['title']; ?></h2>
            <hr>
            <form action="edit_posts.php" method="post">
                <input type="number" name="post_id" style="display:none" value=<?php echo $post['id']; ?>>
                <?php include(ROOT_PATH . '/includes/errors.php'); ?>
                <label>Topic:
                    <select name="topic" class="dropdown">
                </label>
                <?php foreach ($topics as $topic) { ?>
                    <option value=<?php echo $topic['id'];
                                    if ($topic['id'] == $post_topic['id']) { ?> selected="selected" <?php } ?>> <?php echo $topic['name'] ?>
                    </option>
                <?php } ?>
                </select>
                <input type="text" name="title" value="<?php echo $post['title']; ?>">
                <textarea name="body" class="body-text-area"><?php echo $post['body']; ?></textarea>
                <button class="btn small-btn update-btn" type="submit" name="update_post">Update post</button>
            </form>

            <form class="delete-form" action="edit_posts.php" method="get">
                <input type="number" name="post_id" style="display:none" value=<?php echo $post['id']; ?>>
                <span>This button will permanently delete your post!</span>
                <button class="btn small-btn delete-btn" type="submit" name="delete_post">DELETE</button>
            </form>
        <?php } else { ?>
            <h2 class="content-title">Click on a post to edit</h2>
            <hr>
            <div class="posts-container">
                <?php foreach ($posts as $post) : ?>
                    <div class="post" style="margin-left: 0px;">
                        <a href="edit_posts.php?post-slug=<?php echo $post['slug']; ?>">
                            <img src="<?php echo BASE_URL . '/static/images/' . $post['topic']['name'] . '.jpg'; ?>" class="post_image" alt="">
                            <div class="post_info">
                                <h3><?php echo $post['title'] ?></h3>
                                <div class="info">
                                    <span class="created_at"><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        <?php } ?>
        <?php include('includes/footer.php') ?>