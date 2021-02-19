<?php

//insert.php

require_once ('../connection/dbConfig.php'); 







if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events 
 (title, hours, start_event, end_event) 
 VALUES (:title, :hours, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':hours'  => $_POST['hours'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>