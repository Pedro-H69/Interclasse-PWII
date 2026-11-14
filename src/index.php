<?php
require_once 'includes/header.php';

// Buscando estatísticas rápidas direto do banco para o Dashboard
try {
    $totalTurmas = $pdo->query("SELECT COUNT(*) FROM turmas")->fetchColumn();
    $totalModalidades = $pdo->query("SELECT COUNT(*) FROM modalidades")->fetchColumn();
    $totalTimes = $pdo->query("SELECT COUNT(*) FROM times")->fetchColumn();
    $totalInscricoes = $pdo->query("SELECT COUNT(*) FROM inscricoes WHERE status = 'aprovada'")->fetchColumn();
} catch (PDOException $e) {
    $totalTurmas = $totalModalidades = $totalTimes = $totalInscricoes = 0;
}
?>

<h2>Painel Principal - Sistema Interclasse</h2>
<p>Bem-vindo ao sistema de gerenciamento do interclasse. Utilize o menu superior para navegar entre os cadastros e o gerenciamento do campeonato.</p>

<div class="cards">
    
    <div>
        <h3>Total de Turmas</h3>
        <p><?= $totalTurmas ?></p>
        <a href=""></a>
    </div>

    <div>
        <h3>Modalidades</h3>
        <p ><?= $totalModalidades ?></p>
        <a href=""></a>
    </div>

    <div>
        <h3>Times</h3>
        <p><?= $totalTimesAprovados ?></p>
        <a href=""></a>
    </div>


     <div>
        <h3>classificacao</h3>
        <a href=""></a>
    </div>


</div>

<?php require_once 'includes/footer.php'; ?>