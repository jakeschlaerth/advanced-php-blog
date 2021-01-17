# Jake's PHP Blog

This is a blog developed using the Bitnami Wampstack, specifically using Apache web server, MySQL, and PHP, in additon to HTML and CSS. 

## Features

- backend DB connection
- registration with a username and md5 encrypted password
- creation of posts associated a username
- post creation, updating, and deletion for a specific user's posts
- each post is associated with a topic in a many-to-many relationship utilizing an associative entity
    
## Design Choices
- Using Wampstack, it was relatively simple to connect to a database using PHP and the MySQLi extension. Making a global connection variable with mysqli_connect() allowed the connection to be easily accessed using a config.php file that was inclulded across all PHP files that needed access to the DB. 

- The rudimentary authentication system was made with a database table called users that contained a username, email, and password. The password was encrypted using a Message Digest 5 hash function, which is easily accesible in PHP with the built-in md5(). Registering a username, email, and password combination stores those values in the users table via an INSERT query. Filling out the login form with good credentials sets the $_SESSION['user'] variable. If that variable is set, includes/navbar.php shows a different navbar that includes "Create post" and "Edit your posts". 

- Logging out destroys/restarts the session variable and redirects to the home page.

- The posts table in the database stores the user_id who was logged in at the time of the creation of the post. Its columns include a title, a foreign key that references references a user_id, a url-friendly unique slug, the body of the post, and a timestamp that stores the creation time of the post. 

- Each post's slug is made by converting the title to url-friendly characters dashes and then appending a unique time stamp to the slug. This is becuase the single_post.php page searches the posts table using the slug as an identifier.

- A user can only edit/delete posts that are associated with their user_id. While logged in, clicking on "Edit your posts" brings the user to edit_posts.php. This file serves the user with all of the posts associated with their user_id. Clicking on a post sets a url query containg that post id, and generates a form that is pre-populated with the chosen post's data, including topic, title, and body. The user can then freely edit that data and click the update button, thereby submitting an UPDATE query to the database. The edit page also contains a delete button that will send a DELETE query to the database.

- Any user (logged in or not) can view all posts on the blog's home page. Each post preview card has a button showing the topic associated with that post. Clicking this button shows all posts associated with that topic. Topics and posts are related through an associative table called topic_post. This table has 2 foreign keys referencing posts['id'] and topics['id']. 








