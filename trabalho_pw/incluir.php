<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Revista</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="header-laranja">
        <div class="container header-conteudo">
            <h3>Incluir Revista</h3>
        </div>
    </div>

    <main class="container">

        <div class="conteudo-card">

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    include "conexao.php";

                    $nome = $_POST['nome'];
                    $ano = $_POST['ano'];
                    $edicao = $_POST['edicao'];

                    if (!empty($_FILES['foto']['name'])) {
                        $target_dir = "img/";
                        $arquivo = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $arquivo;
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                    } else {
                        $arquivo = "";
                    }

                    $sql = "insert into tabelarevista (nome, ano, edicao, foto, datacadastro) 
                            values ('" . htmlspecialchars($nome) . "', $ano, $edicao, '$arquivo', now())";

                    $conexao->query($sql);

                    echo <<<ALERT
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5 class="mb-0">Revista cadastrada com sucesso!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ALERT;
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
            }
            ?>

            <form name="revista" action="incluir.php" method="post" enctype="multipart/form-data">

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" maxlength="100" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Ano</label>
                        <input type="number" name="ano" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Edição</label>
                        <input type="number" name="edicao" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-4 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Foto da capa</label>
                        <input type="file" name="foto" id="imagemnova" accept="image/*" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <p class="mb-1">Pré-visualização:</p>
                        <img src="img/SemImagem.png" id="preview" class="foto img-thumbnail shadow" alt="sem imagem">
                    </div>
                </div>

                <div class="acoes-form">
                    <input type="submit" class="btn btn-salvar" value="Salvar">
                    <input type="reset" class="btn btn-limpar" value="Limpar">
                    <a href="index.php" class="btn btn-cancelar">Cancelar</a>
                </div>

            </form>

        </div>

    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/dialogo.js"></script>
</body>

</html>