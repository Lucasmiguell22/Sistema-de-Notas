<?php
include 'conexao.php';

$sql = "
    SELECT 
        n.id AS nota_id,
        a.nome AS aluno_nome,
        m.nome AS materia_nome,
        n.p1,
        n.p2,
        n.p3,
        n.media
    FROM notas n
    JOIN alunos a ON n.aluno_id = a.id
    JOIN materias m ON n.materia_id = m.id
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        <h2 class="mb-4">Lista de Notas</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar ao Menu Principal</a>

        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <!-- <th>ID Nota</th> -->
                    <th>Nome do Aluno</th>
                    <th>Matéria</th>
                    <th>Nota P1</th>
                    <th>Nota P2</th>
                    <th>Nota P3</th>
                    <th>Média</th>
                    <th>Status</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notas as $nota): ?>
                    <tr>
                        <!-- <td><?php echo $nota['nota_id']; ?></td> -->
                        <td><?php echo $nota['aluno_nome']; ?></td>
                        <td><?php echo $nota['materia_nome']; ?></td>
                        <td><?php echo $nota['p1']; ?></td>
                        <td><?php echo $nota['p2']; ?></td>
                        <td><?php echo $nota['p3'] !== null ? $nota['p3'] : 'N/A'; ?></td>
                        <td><?php echo $nota['media']; ?></td>
                        <td>
                            <?php echo $nota['media'] >= 6 ? "<span class='text-success'>Aprovado</span>" : "<span class='text-danger'>Reprovado</span>"; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>