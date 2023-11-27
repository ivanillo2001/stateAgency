<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>List of News</title>
</head>
<body>
<?php
require_once "Connection.php";
session_start();
$conn = (new Connection())->getPdo();
try {
    $stmt = $conn->prepare("select titulo, texto,categoria,fecha,imagen from noticias");
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<table>";
    echo "<tr class='columna'>";
    echo "<th class='columna'>Titulo</th>";
    echo "<th class='columna'>Texto</th>";
    echo "<th class='columna'>Categoria</th>";
    echo "<th class='columna'>Fecha</th>";
    echo "<th class='columna'>Imagen</th>";

    echo "</tr>";
    foreach ($result as $noticia){
        echo "<tr>";
        // Itera sobre cada elemento del array $noticia
        foreach ($noticia as $clave => $valor) {
            if ($clave=='imagen'){
                echo "<td><a href='imagenesCasas/$valor'><img src='imagenesCasas/camara.jpg' width='50px' height='50px'></a></td>";
            }else {
                echo "<td>$valor</td>";
            }
            //aquí la clave es el nombre de la columna y el valor es el contenido de cada una
        }
        echo "</tr>";
    }
    echo "</table>";
}catch (PDOException $exception){
    echo $exception ->getMessage();
    die("Connection to database failed!");
}
?>
<a href="logIn.php">Back Home</a>
</body>
</html>
