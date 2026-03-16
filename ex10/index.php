<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Consulta de CEP</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Consulta de CEP</h1>

<form method="POST">

<label>Digite o CEP:</label>
<br>
<input type="text" name="cep">
<br><br>

<button type="submit" name="buscar">Consultar</button>

</form>

<?php

$arquivo = "consultas.json";

if (isset($_POST["buscar"])) {

    $cep = trim($_POST["cep"]);

    if (empty($cep)) {

        echo "<p class='erro'>Digite um CEP.</p>";

    } else {

        $url = "https://viacep.com.br/ws/$cep/json/";

        $resposta = file_get_contents($url);

        $dados = json_decode($resposta, true);

        if (isset($dados["erro"])) {

            echo "<p class='erro'>CEP não encontrado.</p>";

        } else {

            $logradouro = $dados["logradouro"];
            $bairro = $dados["bairro"];
            $cidade = $dados["localidade"];
            $estado = $dados["uf"];

            echo "<div class='resultado'>";

            echo "<h2>Endereço encontrado</h2>";
            echo "CEP: " . htmlspecialchars($cep) . "<br>";
            echo "Rua: " . htmlspecialchars($logradouro) . "<br>";
            echo "Bairro: " . htmlspecialchars($bairro) . "<br>";
            echo "Cidade: " . htmlspecialchars($cidade) . "<br>";
            echo "Estado: " . htmlspecialchars($estado);

            echo "</div>";

            $dataHora = date("d/m/Y H:i:s");

            if (file_exists($arquivo)) {

                $conteudo = file_get_contents($arquivo);
                $consultas = json_decode($conteudo, true);

                if (!is_array($consultas)) {
                    $consultas = [];
                }

            } else {

                $consultas = [];

            }

            $novaConsulta = [
                "cep" => $cep,
                "logradouro" => $logradouro,
                "bairro" => $bairro,
                "cidade" => $cidade,
                "estado" => $estado,
                "data" => $dataHora
            ];

            $consultas[] = $novaConsulta;

            file_put_contents(
                $arquivo,
                json_encode($consultas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );

        }

    }

}

?>

<h2>Histórico de consultas</h2>

<?php

if (file_exists($arquivo)) {

    $conteudo = file_get_contents($arquivo);

    $consultas = json_decode($conteudo, true);

    if (!empty($consultas)) {

        foreach ($consultas as $consulta) {

            echo "<div class='card'>";

            echo "CEP: " . htmlspecialchars($consulta["cep"]) . "<br>";
            echo "Rua: " . htmlspecialchars($consulta["logradouro"]) . "<br>";
            echo "Bairro: " . htmlspecialchars($consulta["bairro"]) . "<br>";
            echo "Cidade: " . htmlspecialchars($consulta["cidade"]) . "<br>";
            echo "Estado: " . htmlspecialchars($consulta["estado"]) . "<br>";
            echo "Data: " . htmlspecialchars($consulta["data"]);

            echo "</div>";

        }

    } else {

        echo "<p>Nenhuma consulta realizada.</p>";

    }

}

?>

</body>
</html>