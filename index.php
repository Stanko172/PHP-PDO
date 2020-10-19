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

echo "<hr>";

#Fetching single row
$id = 1;

$query = "SELECT * FROM post WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);

$post = $stmt->fetch(PDO::FETCH_OBJ);

echo "<h1>$post->title</h1>";

echo "<hr>";

#Broj redaka(row count)
$stmt = $pdo->prepare("SELECT * FROM post WHERE author = ?");
$stmt->execute([$author]);

$postNumber = $stmt->rowCount();

echo "<h5>Broj postova autora $author je: $postNumber</h5>";

echo "<hr>";

#Dodavanje redaka(INSERT)
$title = "dodani blog post";
$body = "Ovo je neki random tekst";
$author = "Milorad";
$published = false;

$sql = "INSERT INTO post(title, body, author, published) VALUES (:title, :body, :author, :published)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['title' => $title, 'body' => $body, 'author' => $author, 'published' => $published]);
echo "<h1>Post added!</h1>";

echo "<hr>";

#Ažuriranje redaka(UPDATE)
$title = "ažurirani blog post";

$sql = "UPDATE post SET title = :title WHERE id = 4";
$stmt = $pdo->prepare($sql);
$stmt->execute(['title' => $title]);
echo "<h1>Post updated!</h1>";

echo "<hr>";

#Brisanje redaka(DELETE)
$id = 3;

$sql = "DELETE FROM post WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
echo "<h1>Post deleted!</h1>";





?>