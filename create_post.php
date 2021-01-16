<?php require('config.php') ?>
<?php require(ROOT_PATH . '/includes/public_functions.php') ?>
<?php require(ROOT_PATH . '/includes/post_CRUD.php') ?>

<?php $topics = getTopics() ?>
<?php include('includes/head.php'); ?>
<title>Jake's Blog | Create a post </title>
</head>

<body>
    <div class="container">
        <?php include('includes/navbar.php');
        include('includes/banner.php');
        ?>
        <hr>
        <div class="form-container">
            <form action="create_post.php" method="post">
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <label>Topic:
                    <select name="topic" class="dropdown">
                </label>
                <?php foreach ($topics as $topic) { ?>
                    <option value=<?php echo $topic['id'] ?>><?php echo $topic['name'] ?></option>
                <?php } ?>
                </select>
                <input type="text" name="title" placeholder="Title">
                <textarea rows="10" cols="80" name="body" class="body-text-area" placeholder="Post body"></textarea>
                <button class="btn small-btn" type="submit" name="publish_post">Publish post!</button>
            </form>
        </div>
        <?php include('includes/footer.php') ?>