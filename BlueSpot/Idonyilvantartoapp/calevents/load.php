<?php

//load.php


require_once ('../connection/dbConfig.php'); 

// $user_id = $_SESSION['user_id'];



$data = array();

$query = "SELECT * FROM events  ORDER BY id";
// $strSQL = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'hours'   => $row["hours"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>