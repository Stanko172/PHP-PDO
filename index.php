<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'php_pdo';

//Postavke za DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

//Kreirane PDO objekta
$pdo = new PDO($dsn, $user, $password);
//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//Kreiranje upita
//$query1 = $pdo->query('SELECT * FROM post');

//Prikaz svakog redka upita
//while($row = $query1->fetch(PDO::FETCH_ASSOC)){
//    echo $row['title'] . "<br>";
//}

#Pripremljeni parametri(Prepared params)
$author = 'Stanko Bebek';
$published = true;

//Pozicijski parametri(Positional params)
$query = "SELECT * FROM post WHERE author = ?";
$stmt = $pdo->prepare($query);

$stmt->execute([$author]);

$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach($posts as $post){
    echo $post->title . "<br>";
}

echo "<hr>";

//Imenovani parametri(Named params)
$query = "SELECT * FROM post WHERE author = :author AND published = :published";
$stmt = $pdo->prepare($query);

$stmt->execute(['author' => $author, 'published' => $published]);

$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach($posts as $post){
    echo $post->title . ' - published' . "<br>";
}

?>