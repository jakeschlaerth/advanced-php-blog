<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php include('includes/head.php'); ?>
<?php
// get posts of a specific topic
// check URL query params
if (isset($_GET['topic'])) {
    // grab topic id param from url query
    $topic_id = $_GET['topic'];
    $posts = getPublishedPostsByTopic($topic_id);

    $errors = array();
}
?>
<title>Jake's Blog | Filtered Posts </title>
</head>

<body>
    <div class="container">
        <?php include('includes/navbar.php') ?>
        <?php include('includes/banner.php') ?>
        <h2 class="content-title">
            Articles on <u><?php echo getTopicNameById($topic_id); ?> </u>
        </h2>
        <hr>
        <div class="posts-container">
            <!-- iterate through posts -->
            <?php foreach ($posts as $post) : ?>
                <div class="post" style="margin-left: 0px;">
                    <!-- get image url from post -->
                    <img src="<?php echo BASE_URL . '/static/images/' . $post['topic']['name'] . '.jpg'; ?>" class="post_image" alt="">
                    <!-- attach link to url query string -->
                    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                        <div class="post_info">
                            <!-- get post title -->
                            <h3><?php echo $post['title'] ?></h3>
                            <div class="info">
                                <!-- get time post created -->
                                <span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                                <span class="read_more">Read more...</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div> <!-- content -->       
        <?php include(ROOT_PATH . '/includes/footer.php'); ?>