<?php

$mensagem = "";

$arquivo = "alunos.json";

if (isset($_POST["btnCadastrar"])) {

$nome = trim($_POST["nome"]);
$idade = trim($_POST["idade"]);
$curso = trim($_POST["curso"]);

if (empty($nome) || empty($idade) || empty($curso)) {

$mensagem = "Preencha todos os campos.";

} else {

if (file_exists($arquivo)) {

$conteudo = file_get_contents($arquivo);

$alunos = json_decode($conteudo, true);

if (!is_array($alunos)) {

$alunos = [];

}

} else {

$alunos = [];

}

$novoAluno = [

"nome" => $nome,
"idade" => $idade,
"curso" => $curso

];

$alunos[] = $novoAluno;

$jsonFinal = json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

file_put_contents($arquivo, $jsonFinal);

$mensagem = "Aluno cadastrado com sucesso!";

}

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Cadastro de Alunos</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<h1>Cadastro de Alunos</h1>

<form method="POST">

<input type="text" name="nome" placeholder="Nome do aluno">

<input type="number" name="idade" placeholder="Idade">

<input type="text" name="curso" placeholder="Curso">

<button type="submit" name="btnCadastrar">Cadastrar</button>

</form>

<?php

if (!empty($mensagem)) {

echo "<p>" . htmlspecialchars($mensagem) . "</p>";

}

?>

</body>
</html>