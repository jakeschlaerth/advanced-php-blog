<?php require('config.php') ?>
<?php require(ROOT_PATH . '/includes/public_functions.php') ?>
<?php require(ROOT_PATH . '/includes/registration_login.php') ?>

<?php include('includes/head.php') ?>
<!-- retrive all posts from db  -->
<?php $posts = getAllPosts(); ?>

<title>Jake's Blog | Home </title>
</head>

<body>
    <!-- container wraps entire page  -->
    <div class="container">
        <?php include('includes/navbar.php') ?>
        <?php include('includes/banner.php') ?>
        <h2 class="content-title">Recent Articles</h2>
        <hr>
        <div class="posts-container">
            <?php foreach ($posts as $post) : ?>
                <div class="post" style="margin-left: 0px;">
                    <img src="<?php echo BASE_URL . '/static/images/' . $post['topic']['name'] . '.jpg'; ?>" class="post_image" alt="">
                    <?php if (isset($post['topic']['name'])) : ?>
                        <!-- attach topic id query param to url -->
                        <a href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>" class="btn category">
                            <?php echo $post['topic']['name'] ?>
                        </a>
                    <?php endif ?>
                    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                        <div class="post_info">
                            <h3><?php echo $post['title'] ?></h3>
                            <div class="info">
                                <span class="created_at"><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                                <span class="author-info"><?php echo ' | ' . getUserById($post['user_id'])['username']; ?></span>
                                <span class="read_more">Read more...</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
        <?php include('includes/footer.php') ?>