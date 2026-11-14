<?php
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_turma'])) {
    $serie = trim($_POST['serie']);
    $curso = trim($_POST['curso']);
    $turno = trim($_POST['turno']);

    if (!empty($serie) && !empty($curso) && !empty($turno)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO turmas (serie, curso, turno) VALUES (?, ?, ?)");
            $stmt->execute([$serie, $curso, $turno]);
            setMensagem('sucesso', 'Turma cadastrada com sucesso!');
        } catch (PDOException $e) {
            setMensagem('erro', 'Erro ao cadastrar turma: ' . $e->getMessage());
        }
    } else {
        setMensagem('erro', 'Preencha todos os campos!');
    }

    header("Location: turmas.php");
    exit;
}

// processar exclusao de turma
if (isset($_GET['acao']) && $_GET['acao'] === 'excluir' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM turmas WHERE id = ?");
        $stmt->execute([$id]);
        setMensagem('sucesso', 'Turma excluída com sucesso!');
    } catch (PDOException $e) {
        setMensagem('erro', 'Não é possível excluir esta turma pois existem times vinculados a ela.');
    }
    header("Location: turmas.php");
    exit;
}

$turmas = $pdo->query("SELECT * FROM turmas ORDER BY serie ASC, curso ASC")->fetchAll();
?>

<h2>Gerenciamento de Turmas</h2>
<p>Cadastre as turmas participantes do interclasse selecionando a série, curso e turno.</p>

<form class="FormularioCadastro" method="POST">
    <h3 >Cadastrar Nova Turma</h3>
    
    <div>
        
        <div>
            <label>Série:</label>
            <select name="serie" required>
                <option value="">Selecione</option>
                <option value="1-MTec">1º MTec</option>
                <option value="2-MTec">2º MTec</option>
                <option value="3-MTec">3º MTec</option>
                <option value="Tec">Técnico</option>
            </select>
        </div>

        <div>
            <label>Curso:</label>
            <select name="curso" required ;">
                <option value="">Selecione</option>
                <option value="DS">Desenvolvimento de Sistemas (DS)</option>
                <option value="ADM">Administração (ADM)</option>
                <option value="RH">Recursos Humanos (RH)</option>
                <option value="CONT">Contabilidade (CONT)</option>
            </select>
        </div>

        <div >
            <label>Turno:</label>
            <select name="turno" required>
                <option value="">Selecione</option>
                <option value="Manha">Manhã</option>
                <option value="tarde">Tarde</option>
                <option value="noite">Noite</option>
            </select>
        </div>

        <div>
            <button type="submit" name="cadastrar_turma" class="btn-success">Cadastrar Turma</button>
        </div>
    </div>
</form>

<!-- Tabela de Listagem -->
<h3>Turmas Cadastradas</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Série</th>
            <th>Curso</th>
            <th>Turno</th>
            <th >Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($turmas)): ?>
            <tr>
                <td>Nenhuma turma cadastrada até o momento.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($turmas as $t): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= htmlspecialchars($t['serie']) ?></td>
                    <td><?= htmlspecialchars($t['curso']) ?></td>
                    <td><?= htmlspecialchars($t['turno']) ?></td>
                    <td>
                        <a href="turmas.php?acao=excluir&id=<?= $t['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta turma?')" class="Badges">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>