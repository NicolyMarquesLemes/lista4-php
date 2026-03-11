<?php

$arquivo = "produtos.json";

if (file_exists($arquivo)) {

    $conteudo = file_get_contents($arquivo);

    $produtos = json_decode($conteudo, true);

    if (!is_array($produtos)) {
        $produtos = [];
    }

} else {

    $produtos = [];

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">
<title>Lista de Produtos</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<h1>Lista de Produtos</h1>

<table>

<tr>
<th>Nome</th>
<th>Preço</th>
<th>Categoria</th>
</tr>

<?php

foreach ($produtos as $produto) {

echo "<tr>";

echo "<td>" . htmlspecialchars($produto["nome"]) . "</td>";

echo "<td>R$ " . htmlspecialchars($produto["preco"]) . "</td>";

echo "<td>" . htmlspecialchars($produto["categoria"]) . "</td>";

echo "</tr>";

}

?>

</table>

</body>
</html>