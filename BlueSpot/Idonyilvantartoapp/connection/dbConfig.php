
<?php 

//PDO database connect
$config['db'] = array(
    'host'      => '127.0.0.1',
    'username'  => 'testuser',
    'password'  => 'testpassword',
    'dbname'    => 'idonyilvantarto'
    );
    
    try {
        $connect = new PDO('mysql:host=' .$config['db']['host']. ';dbname=' .$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $connect->exec("SET CHARACTER SET utf8");
    } catch(PDOException $e) {
        echo 'Problema az adatbazissal:' . $e->getMessage();
    }



// $connect = new PDO('mysql:host=127.0.0.1;dbname=idonyilvantarto', 'testuser', 'testpassword');



// $sql = "CREATE TABLE IF NOT EXISTS events (
//     id int(11) NOT NULL AUTO_INCREMENT ,
//     title varchar(255) NOT NULL,
//     hour varchar(255) NOT NULL,
//     start_event datetime NOT NULL,
//     end_event datetime NOT NULL,
//     PRIMARY KEY (id);
//   ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

//   $result = mysqli_query($connect, $sql) or die("sikertelen"); 