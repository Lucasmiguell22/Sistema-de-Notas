<?php
include 'conexao.php';

$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];

    $sql = "INSERT INTO alunos (nome, ra) VALUES (:nome, :ra)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([':nome' => $nome, ':ra' => $ra])) {
        $mensagem = "Aluno cadastrado com sucesso!";
        $tipoMensagem = "success";
    } else {
        $mensagem = "Erro ao cadastrar aluno.";
        $tipoMensagem = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Lançamento de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Cadastrar Aluno</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar ao Menu Principal</a>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6">
                <label for="ra" class="form-label">RA</label>
                <input type="text" class="form-control" id="ra" name="ra" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cadastrar Aluno</button>
            </div>
        </form>
        <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mensagemModalLabel">Resultado do Cadastro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-<?php echo $tipoMensagem; ?>">
                            <?php echo $mensagem; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <?php if (!empty($mensagem)): ?>
        <script>
            var mensagemModal = new bootstrap.Modal(document.getElementById('mensagemModal'));
            mensagemModal.show();
        </script>
    <?php endif; ?>
</body>
</html>