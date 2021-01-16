<?php require_once('config.php') ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once('includes/head.php') ?>

<?php
// get slug from url
$slug = $_GET['post-slug'];
// get post from db according to slug
$post = getPost($slug);
// get all topics
$topics = getTopics();
?>
<?php include('includes/head.php'); ?>
<title><?php echo $post['title'] ?> | Jake's Blog</title>
</head>

<body>
    <div class="container">
        <?php include(ROOT_PATH . '/includes/navbar.php'); ?>
        <div class="content">
            <div class="post-wrapper">
                <div class="full-post-div">
                    <h2 class="post-title"><?php echo $post['title']; ?></h2>
                    <div class="post-body-div">
                        <?php echo html_entity_decode($post['body']); ?>
                    </div>
                </div>
            </div>
            <div class="post-sidebar">
                <div class="card">
                    <div class="card-header">
                        <h2>Topics</h2>
                    </div>
                    <div class="card-content">
                        <?php foreach ($topics as $topic) : ?>
                            <a href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
                                <?php echo $topic['name']; ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include(ROOT_PATH . '/includes/footer.php'); ?>