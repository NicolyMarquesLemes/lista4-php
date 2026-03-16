<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Posts</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Posts do Usuário</h1>

<div class="container">

<?php

$url = "https://jsonplaceholder.typicode.com/posts";

$resposta = file_get_contents($url);

$posts = json_decode($resposta, true);

$contador = 0;

foreach ($posts as $post) {

    if ($post["userId"] != 1) {
        continue;
    }

    if ($contador >= 10) {
        break;
    }

    $id = htmlspecialchars($post["id"]);
    $titulo = htmlspecialchars($post["title"]);
    $conteudo = htmlspecialchars($post["body"]);

    echo "<div class='post'>";
    echo "<h2>Post #$id</h2>";
    echo "<h3>$titulo</h3>";
    echo "<p>$conteudo</p>";
    echo "</div>";

    $contador++;
}

?>

</div>

</body>
</html>