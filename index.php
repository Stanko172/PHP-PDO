<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'php_pdo';

//Postavke za DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

//Kreirane PDO objekta
$pdo = new PDO($dsn, $user, $password);

//Kreiranje upita
$query1 = $pdo->query('SELECT * FROM post');

//Prikaz svakog redka upita
while($row = $query1->fetch(PDO::FETCH_ASSOC)){
    echo $row['title'] . "<br>";
}

?>