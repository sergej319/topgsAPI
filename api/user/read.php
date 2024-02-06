<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog user object
  $user = new User($db);

  // Blog user query
  $result = $user->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $user_arr = array();
    // $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $user_item = array(
        'id_user' => $id_user,
        'fname' => $fname,
        'lname' => html_entity_decode($lname),
        'username' => $username,
        'email' => $email,
        'password' => $password
      );

      // Push to "data"
      array_push($user_arr, $user_item);
      // array_push($user_arr['data'], $user_item);
    }

    // Turn to JSON & output
    echo json_encode($user_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Users Found')
    );
  }
