<?php
include 'conexao.php';

$mensagem = "";
$p1 = $p2 = $p3 = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $materia_id = $_POST['materia_id'];
    $p1 = isset($_POST['p1']) ? floatval($_POST['p1']) : null;
    $p2 = isset($_POST['p2']) ? floatval($_POST['p2']) : null;

    $media = ($p1 + $p2) / 2;


    $sql = "INSERT INTO notas (aluno_id, materia_id, p1, p2, p3, media) VALUES (:aluno_id, :materia_id, :p1, :p2, NULL, :media)";
    $stmt = $conn->prepare($sql);


    if ($media < 2) {
        $mensagem = "A média é inferior a 2. Aluno reprovado.";
        $tipoMensagem = "danger";

        if ($stmt->execute([':aluno_id' => $aluno_id, ':materia_id' => $materia_id, ':p1' => $p1, ':p2' => $p2, ':media' => $media])) {
            $mensagem .= " Notas lançadas com sucesso!";
        } else {
            $mensagem = "Erro ao lançar notas.";
            $tipoMensagem = "danger";
        }
    } elseif ($media < 6) {

        $mensagem = "A média é inferior a 6. Por favor, insira a nota P3.";
        $tipoMensagem = "warning";
        $solicitarP3 = true;


        if ($stmt->execute([':aluno_id' => $aluno_id, ':materia_id' => $materia_id, ':p1' => $p1, ':p2' => $p2, ':media' => $media])) {
            $mensagem .= " Notas lançadas com sucesso! Insira P3.";
        } else {
            $mensagem = "Erro ao lançar notas.";
            $tipoMensagem = "danger";
        }
    } else {

        $mensagem = "Notas lançadas com sucesso! Aluno aprovado.";
        $tipoMensagem = "success";


        if ($stmt->execute([':aluno_id' => $aluno_id, ':materia_id' => $materia_id, ':p1' => $p1, ':p2' => $p2, ':media' => $media])) {
            $mensagem .= " Notas lançadas com sucesso!";
        } else {
            $mensagem = "Erro ao lançar notas.";
            $tipoMensagem = "danger";
        }
    }


    if (isset($solicitarP3) && !empty($_POST['p3'])) {
        $p3 = floatval($_POST['p3']);
        if ($p1 < $p2) {
            $p1 = $p3;
        } else {
            $p2 = $p3;
        }
        $media = ($p1 + $p2) / 2;


        $sql = "UPDATE notas SET p1 = :p1, p2 = :p2, p3 = :p3, media = :media WHERE aluno_id = :aluno_id AND materia_id = :materia_id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([':p1' => $p1, ':p2' => $p2, ':p3' => $p3, ':media' => $media, ':aluno_id' => $aluno_id, ':materia_id' => $materia_id])) {
            $mensagem = "Notas lançadas com sucesso!";
            $tipoMensagem = "success";
        } else {
            $mensagem = "Erro ao lançar notas.";
            $tipoMensagem = "danger";
        }
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
        <h2 class="mb-4">Lançar Notas</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar ao Menu Principal</a>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-4">
                <label for="aluno_id" class="form-label">ID do Aluno</label>
                <input type="number" class="form-control" id="aluno_id" name="aluno_id" required>
            </div>
            <div class="col-md-4">
                <label for="materia_id" class="form-label">ID da Matéria</label>
                <input type="number" class="form-control" id="materia_id" name="materia_id" required>
            </div>
            <div class="col-md-4">
                <label for="p1" class="form-label">Nota P1</label>
                <input type="number" step="0.01" class="form-control" id="p1" name="p1" required>
            </div>
            <div class="col-md-4">
                <label for="p2" class="form-label">Nota P2</label>
                <input type="number" step="0.01" class="form-control" id="p2" name="p2" required>
            </div>
            <div class="col-md-4">
                <label for="p3" class="form-label">Nota P3 (se necessário)</label>
                <input type="number" step="0.01" class="form-control" id="p3" name="p3">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lançar Notas</button>
            </div>
        </form>
        <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mensagemModalLabel">Resultado do Lançamento</h5>
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