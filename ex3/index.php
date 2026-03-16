<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Alunos</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Alunos Cadastrados</h1>

<?php

$arquivo = "alunos.json";

if (file_exists($arquivo)) {

    $conteudo = file_get_contents($arquivo);

    $alunos = json_decode($conteudo, true);

    if (!empty($alunos)) {

        echo "<table>";
        echo "<tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Curso</th>
              </tr>";

        foreach ($alunos as $aluno) {

            echo "<tr>";
            echo "<td>" . htmlspecialchars($aluno["nome"]) . "</td>";
            echo "<td>" . htmlspecialchars($aluno["idade"]) . "</td>";
            echo "<td>" . htmlspecialchars($aluno["curso"]) . "</td>";
            echo "</tr>";

        }

        echo "</table>";

    } else {
        echo "<p>Nenhum aluno cadastrado.</p>";
    }

} else {
    echo "<p>Arquivo não encontrado.</p>";
}

?>

</body>
</html>