<?php

//update.php

require_once ('../connection/dbConfig.php'); 

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, hours=:hours, start_event=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':hours'  => $_POST['hours'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>