<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Usuários</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Usuários da API</h1>

<div class="container">

<?php

$url = "https://jsonplaceholder.typicode.com/users";

$resposta = file_get_contents($url);

$usuarios = json_decode($resposta, true);

foreach ($usuarios as $usuario) {

    $nome = htmlspecialchars($usuario["name"]);
    $email = htmlspecialchars($usuario["email"]);
    $telefone = htmlspecialchars($usuario["phone"]);
    $cidade = htmlspecialchars($usuario["address"]["city"]);

    echo "<div class='card'>";
    echo "<h2>$nome</h2>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Telefone:</strong> $telefone</p>";
    echo "<p><strong>Cidade:</strong> $cidade</p>";
    echo "</div>";
}

?>

</div>

</body>
</html>