<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Usuários da API</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Usuários da API</h1>

<?php

$url = "https://jsonplaceholder.typicode.com/users";

$resposta = file_get_contents($url);

$usuarios = json_decode($resposta, true);

file_put_contents(
    "usuarios_api.json",
    json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo "<p>Dados salvos no arquivo usuarios_api.json</p>";

?>

<h2>Lista de usuários</h2>

<?php

$conteudo = file_get_contents("usuarios_api.json");

$lista = json_decode($conteudo, true);

foreach ($lista as $usuario) {

    echo "<div class='card'>";

    echo "<p><b>Nome:</b> " . htmlspecialchars($usuario["name"]) . "</p>";
    echo "<p><b>Email:</b> " . htmlspecialchars($usuario["email"]) . "</p>";
    echo "<p><b>Telefone:</b> " . htmlspecialchars($usuario["phone"]) . "</p>";
    echo "<p><b>Cidade:</b> " . htmlspecialchars($usuario["address"]["city"]) . "</p>";

    echo "</div>";

}

?>

</body>
</html>