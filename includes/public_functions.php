<?php 
/* - - - - - - - - - - - - - - - - - - - - -
getPublishedPosts()
- params: none
- return: all published posts from db
- - - - - - - - - - - - - - - - - - - - - - -*/
function getAllPosts() {
    // global db connection variable
    global $conn;
    // query
    $query = "SELECT * FROM posts ORDER BY created_at";
    // send the query, return a mysqli_result object
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to associative array of posts, similar to JS object
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // since  posts to topics are a many-to-many relationship,
    // we must grab the topic from the post_topic table
    // init array that will be returned
    $final_posts = array();
    // iterate through all posts
    foreach ($posts as $post) {
        // set the key'topic' to the return value of getPostTopic(), an array of all topic data (id, name, slug)
        $post['topic'] = getPostTopic($post['id']);
        // append that post to the return array
        array_push($final_posts, $post);
    }
    return $final_posts;
}

/* - - - - - - - - - - - - - - - - - - - - -
getPostTopic($post_id)
- params: $post_id, the id of a post
- return: the topic associated with that post
- - - - - - - - - - - - - - - - - - - - - - -*/
function getPostTopic($post_id) {
    // global db connection variable
    global $conn;
    // query
    $query = "SELECT DISTINCT topics.id as id, topics.name AS name, topics.slug AS slug FROM post_topic
        INNER JOIN topics ON topics.id=post_topic.topic_id
        INNER JOIN posts ON  post_topic.post_id=$post_id";
    // query the db
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to associative array with the topic info for the passed post
    $topic = mysqli_fetch_assoc($result);
    return $topic;
}

/* - - - - - - - - - - - - - - - - - - - - -
getPublishedPostsByTopic(topic_id)
- params: $topic_id, id of a topic
- return: all posts associated with a particular topic
- - - - - - - - - - - - - - - - - - - - - - -*/
function getPublishedPostsByTopic($topic_id) {
    // global db connection variable
    global $conn;
    // query
    // TODO there has to be some clever SQL to get the topic info in this query, 
    // thereby avoiding the the foreach loop below 
    $query = "SELECT * FROM posts 
			    WHERE posts.id IN 
			        (SELECT post_topic.post_id FROM post_topic
				    WHERE post_topic.topic_id=$topic_id GROUP BY post_topic.post_id 
                    HAVING COUNT(1) = 1)";
    // query the db
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to associative array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // init return array
    $final_posts = array();
    // iterate through all posts
    foreach ($posts as $post) {
        $post['topic'] = getPostTopic($post['id']);
        array_push($final_posts, $post);
    }
    return $final_posts;
}

/* - - - - - - - - - - - - - - - - - - - - -
getTopicNameById($topic_id)
- params: $topic_id, id of a topic
- return: name of the topic assoiciated with the given topic id
- - - - - - - - - - - - - - - - - - - - - - -*/
function getTopicNameById($topic_id) {
    // global db connection variable
    global $conn;
    // query
    $query = "SELECT name FROM topics WHERE id=$topic_id";
    // query db
    $result = mysqli_query($conn, $query);
    //convert mysqli_result to array
    $topic = mysqli_fetch_assoc($result);
    return($topic['name']);
}

/* - - - - - - - - - - - - - - - - - - - - -
getPost($post_slug)
- params: $post_slug, the slug of the post
- return: post associated with slug
- - - - - - - - - - - - - - - - - - - - - - -*/
function getPost($post_slug) {
    // global db connection var
    global $conn;
    // query
    $query = "SELECT * FROM posts WHERE slug='$post_slug'";
    // query the db
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to assoc array
    $post = mysqli_fetch_assoc($result);
    return $post;
}

/* - - - - - - - - - - - - - - - - - - - - -
getTopics()
- params: none
- return: assoc array containing all topics
- - - - - - - - - - - - - - - - - - - - - - -*/
function getTopics() {
    // global db connection var
    global $conn;
    // query
    $query = "SELECT * FROM topics";
    // query the db
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to array
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $topics;
}

/* - - - - - - - - - - - - - - - - - - - - -
getUserById($user_id)
- params: $user_id, a user id
- return: all user data for that id
- - - - - - - - - - - - - - - - - - - - - - -*/
function getUserById($user_id) {
    // global connection variable
    global $conn;
    // db query
    $query = "SELECT * FROM users WHERE id=$user_id";
    // query the db
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to array
    $user = mysqli_fetch_assoc($result);
    return $user;
}

/* - - - - - - - - - - - - - - - - - - - - -
convertTitleToSlug($title)
- params: $title, the title of a post
- return: $slug, a url friendly identifier for a post
- - - - - - - - - - - - - - - - - - - - - - -*/
function convertTitleToSlug($title) {
    // lower case
    $slug = strtolower($title);
    // replace disallowed characters with dashes
    // this is slightly quick and dirty, im sure it could be done better using regex
    $tokens = [' ', '\'', '"', '', ':'];
    $slug = str_replace($tokens, '-', $slug);
    // we must make the slug unique, as it is how we query the database for the single post view
    $slug = $slug . uniqid();
    // debug statement
    echo "<script>console.log('" . $slug . "')</script>";
    return $slug;
}

/* - - - - - - - - - - - - - - - - - - - - -
getPostsByUser($user_id)
- params: $user_id
- return: array of all posts authored by that user
- - - - - - - - - - - - - - - - - - - - - - -*/
function getPostsByUser($user_id) {
    // global connection variable
    global $conn;
    // db query
    $query = "SELECT * FROM posts WHERE user_id=$user_id";
    // query the db
    $result = mysqli_query($conn, $query);
    // convert mysqli_result to array
    $posts= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $final_posts = array();
    // iterate through all posts
    foreach ($posts as $post) {
        // set the key'topic' to the return value of getPostTopic(), an array of all topic data (id, name, slug)
        $post['topic'] = getPostTopic($post['id']);
        // append that post to the return array
        array_push($final_posts, $post);
    }
    return $final_posts;
}