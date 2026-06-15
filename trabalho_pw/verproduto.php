<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Revista</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adicoes.css">
</head>

<body>

    <div class="header-laranja">
        <div class="container header-conteudo">
            <a style="margin: 0;font-weight: 700;letter-spacing: 0.5px;white-space: nowrap;color: white;text-decoration: none;" href="index.php">
                <h3 >Visualizar</h3>
            </a>
        </div>
    </div>

    <main class="container">

        <div class="conteudo-card">

            <?php
            $nome = "";
            $id = null;

            try {
                include "conexao.php";

                // verifica se o parâmetro da URL é válido
                if (isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))) {
                    $id = base64_decode($_GET['id']);
                } else {
                    throw new Exception("Revista não encontrada!");
                }

                $sql = "select * from tabelarevista where id = $id";
                $query = $conexao->query($sql);

                if ($query->num_rows > 0) {
                    $dados = $query->fetch_assoc();

                    $nome = $dados['nome'];
                    $ano = $dados['ano'];
                    $edicao = $dados['edicao'];
                    $datacadastro = $dados['datacadastro'];
                    $foto = empty($dados['foto']) ? "SemImagem.png" : $dados['foto'];
            } else {
                throw new Exception("Produto não encontrado!");
            }
            } catch (Exception $e) {
                echo <<<ALERT
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5 class="mb-0">Aconteceu um erro:<br>
                            {$e->getMessage()}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ALERT;
            }
            ?>

            <?php if (!empty($nome)): ?>
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <img src="img/<?= htmlspecialchars($foto); ?>" class="foto-detalhe img-fluid img-thumbnail shadow" alt="<?= htmlspecialchars($nome); ?>">
                    </div>
                    <div class="col-md-8 col-lg-9 d-flex align-items-center">
                        <div class="">
                            <h4><?= htmlspecialchars($nome); ?></h4>
                            <p class="mb-1"><strong>Ano:</strong> <?= $ano; ?></p>
                            <p class="mb-1"><strong>Edição:</strong> <?= $edicao; ?></p>
                            <p class="mb-3"><strong>Cadastrado em:</strong> <?= $datacadastro; ?></p>

                            <div class="acoes-form">
                                <a href="editar.php?id=<?= base64_encode($id); ?>" class="btn btn-editar">Editar</a>
                                <a href="index.php" class="btn btn-cancelar">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>