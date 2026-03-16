<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Consulta de País</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Buscar País</h1>

<form method="POST">

<label>Digite o nome do país:</label>
<br>
<input type="text" name="pais">
<br><br>

<button type="submit" name="buscar">Buscar</button>

</form>

<?php

if (isset($_POST["buscar"])) {

    $pais = trim($_POST["pais"]);

    if (empty($pais)) {

        echo "<p class='erro'>Digite o nome de um país.</p>";

    } else {

        $url = "https://restcountries.com/v3.1/name/$pais";

        $resposta = @file_get_contents($url);

        if ($resposta === false) {

            echo "<p class='erro'>País não encontrado.</p>";

        } else {

            $dados = json_decode($resposta, true);

            $nome = htmlspecialchars($dados[0]["name"]["official"]);
            $capital = htmlspecialchars($dados[0]["capital"][0]);
            $regiao = htmlspecialchars($dados[0]["region"]);
            $populacao = htmlspecialchars($dados[0]["population"]);
            $bandeira = $dados[0]["flags"]["png"];

            echo "<div class='card'>";

            echo "<h2>$nome</h2>";
            echo "<p><b>Capital:</b> $capital</p>";
            echo "<p><b>Região:</b> $regiao</p>";
            echo "<p><b>População:</b> $populacao</p>";

            echo "<img src='$bandeira' width='150'>";

            echo "</div>";

        }

    }

}

?>

</body>
</html>