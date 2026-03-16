<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Consulta de CEP</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Consultar Endereço pelo CEP</h1>

<form method="POST">

<label>Digite o CEP:</label>
<input type="text" name="cep" placeholder="Ex: 01001000">

<button type="submit" name="btnBuscar">Buscar</button>

</form>

<?php

if (isset($_POST["btnBuscar"])) {

    $cep = trim($_POST["cep"]);

    // Validação
    if (empty($cep)) {

        echo "<p class='erro'>Digite um CEP.</p>";

    } else {

        $url = "https://viacep.com.br/ws/$cep/json/";

        $resposta = file_get_contents($url);

        $dados = json_decode($resposta, true);

        if (isset($dados["erro"])) {

            echo "<p class='erro'>CEP não encontrado.</p>";

        } else {

            echo "<div class='resultado'>";

            echo "<h2>Endereço encontrado</h2>";

            echo "Rua: " . htmlspecialchars($dados["logradouro"]) . "<br>";
            echo "Bairro: " . htmlspecialchars($dados["bairro"]) . "<br>";
            echo "Cidade: " . htmlspecialchars($dados["localidade"]) . "<br>";
            echo "Estado: " . htmlspecialchars($dados["uf"]);

            echo "</div>";

        }

    }

}

?>

</body>
</html>