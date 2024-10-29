<?php
include 'conexao.php';

$sql = "SELECT * FROM materias";
$stmt = $conn->prepare($sql);
$stmt->execute();
$materias = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2 class="mb-4">Listar Matérias</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar ao Menu Principal</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Matéria</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($materias) > 0): ?>
                    <?php foreach ($materias as $materia): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($materia['id']); ?></td>
                            <td><?php echo htmlspecialchars($materia['nome']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">Nenhuma matéria cadastrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    <?php include "footer.php"; ?>
</body>

</html>