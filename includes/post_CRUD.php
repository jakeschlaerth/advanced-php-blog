<?php
// declare vars
$title = "";
$body =  "";
// error array
$errors = array();

// do not allow users that are not logged in to access these pages
if (!isset($_SESSION['user'])) {
    // redirect to home page
    header('Location: index.php');
}

// if publish post button is clicked, it will set the $_POST['publish_post'] variable
if (isset($_POST['publish_post'])) {
    // set vars from create post form
    $title =
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    // check for user errors
    if (empty($title)) {
        array_push($errors, "No title entered");
    }
    if (empty($body)) {
        array_push($errors, "No post body entered");
    }
    // if no errors thus far, add the post to the db
    if (count($errors) == 0) {
        // convert title to unique slug
        $slug = convertTitleToSlug($_POST['title']);
        // since the create a post page is only accesible if the user is logged in, 
        // the $_SESSION variable will have a user's information
        $user_id = $_SESSION['user']['id'];
        // global connection variable
        global $conn;
        // query
        $post_query = "INSERT INTO posts (user_id, title, slug, body) VALUES ($user_id, '$title', '$slug', '$body')";
        // query the db
        if (mysqli_query($conn, $post_query)) {
            // the post was inserted into the db
            // now we must insert the topic into post_topic table
            // grab the topic id from form
            $topic_id = $_POST['topic'];
            // grab the id of last created entry from the db
            $new_post_id = mysqli_insert_id($conn);
            // post_topic insert query
            $topic_query = "INSERT INTO post_topic (post_id, topic_id) VALUES ($new_post_id, $topic_id)";
            if (mysqli_query($conn, $topic_query)) {
                // succesful post insert
                // redirect to home page
                header('Location: index.php');
            } else { // if the post was succesful but the post_topic insert was not, something strange went wrong on the backend
                array_push($errors, "Sorry, something strange has happened");
            }
        } else { // if post query not succesful, something went wrong with the backend
            array_push($errors, "Sorry, something went wrong");
        }
    }
}

// if update buton is clicked
if (isset($_POST['update_post'])) {
    // set vars from update post form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $post_id = $_POST['post_id'];

    // check for user errors
    if (empty($title)) {
        array_push($errors, "No title entered");
    }
    if (empty($body)) {
        array_push($errors, "No post body entered");
    }
    // if no errors thus far, update the post
    if (count($errors) == 0) {
        // global connection variable
        global $conn;
        // query
        $post_query = "UPDATE posts SET title = '$title', body = '$body' WHERE id = $post_id";
        // query the db
        if (mysqli_query($conn, $post_query)) {
            // the post was updated into the db
            // now we must update the post_topic table
            // grab the topic id from form
            $topic_id = $_POST['topic'];
            print_r($topic_id);
            // post_topic update query
            $topic_query = "UPDATE post_topic SET topic_id = $topic_id WHERE post_id=$post_id";
            if (mysqli_query($conn, $topic_query)) {
                // succesful post insert
                // redirect to home page
                header('Location: index.php');
            } else { // if the post was succesful but the post_topic update was not, something strange went wrong on the backend
                array_push($errors, "Sorry, something strange has happened");
            }
        } else { // if post query not succesful, something went wrong with the backend
            array_push($errors, "Sorry, something went wrong");
        }
    }
}



