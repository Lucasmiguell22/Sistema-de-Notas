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
        <h1 class="mb-4">Sistema de Lançamento de Notas</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Alunos</h5>
                        <p class="card-text">Gerencie os alunos cadastrados no sistema.</p>
                        <a href="cadastrar_aluno.php" class="btn btn-primary m-3">Cadastrar Aluno</a>
                        <a href="listar_alunos.php" class="btn btn-secondary m-3">Listar Alunos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Matérias</h5>
                        <p class="card-text">Cadastre e visualize as matérias disponíveis.</p>
                        <a href="cadastrar_materia.php" class="btn btn-primary m-3">Cadastrar Matéria</a>
                        <a href="listar_materias.php" class="btn btn-secondary m-3">Listar Matérias</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Notas</h5>
                        <p class="card-text">Lance e visualize as notas dos alunos.</p>
                        <a href="lancar_notas.php" class="btn btn-primary m-3">Lançar Notas</a>
                        <a href="listar_notas.php" class="btn btn-secondary m-3">Listar Notas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>