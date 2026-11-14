<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '/../config/conexao.php';
require_once '/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema Interclasse</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Início</a>
    <a href="turmas.php">Turmas</a>
    <a href="modalidades.php">Modalidades</a>
    <a href="times.php">Times & Jogadores</a>
    <a href="inscricoes.php">Inscrições</a>
    <a href="partidas.php">Partidas</a>
    <a href="classificacao.php">Classificação</a>
</nav>
<div class="container">
    <?php exibirMensagem(); ?>