<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');// * means public
  header('Content-Type: application/json');

  include_once '../../config/Database.php';//references the db folder in this project's directory
  include_once '../../models/Post.php';//interacts with the models/Post.php

  // Instantiate DB & connect
  $database = new Database();//refers to config/Database.php connection file
  $db = $database->connect();//public function connect in Database.php file

  // Instantiate blog post object
  $post = new Post($db);//from Post.php

  // Blog post query
  $result = $post->read();//calls public function read() inside Post.php
  // Get row count
  $num = $result->rowCount();//row count from $result above

  // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) { //fetch as assoc array
      extract($row);//specify columns below-line 30ff

      $post_item = array(
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),//html_entity_decode is a function to allow html in body
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
