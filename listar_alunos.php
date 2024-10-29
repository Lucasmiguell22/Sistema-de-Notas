<?php
include 'conexao.php';

$sql = "SELECT * FROM alunos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2 class="mb-4">Lista de Alunos</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar ao Menu Principal</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>RA</th>
                    <!-- <th>ID</th> -->
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?php echo $aluno['ra']; ?></td>
                        <!-- <td><?php echo $aluno['id']; ?></td> -->
                        <td><?php echo $aluno['nome']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>