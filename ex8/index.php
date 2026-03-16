<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Consulta de CEP com cURL</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Buscar Endereço</h1>

<form method="POST">

<label>Digite o CEP:</label>
<br>
<input type="text" name="cep">
<br><br>

<button type="submit" name="buscar">Buscar</button>

</form>

<?php

if (isset($_POST["buscar"])) {

    $cep = trim($_POST["cep"]);

    if (empty($cep)) {

        echo "<p class='erro'>Digite um CEP.</p>";

    } else {

        $url = "https://viacep.com.br/ws/$cep/json/";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resposta = curl_exec($ch);

        curl_close($ch);

        $dados = json_decode($resposta, true);

        if (isset($dados["erro"])) {

            echo "<p class='erro'>CEP não encontrado.</p>";

        } else {

            echo "<div class='resultado'>";

            echo "<h2>Endereço</h2>";

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