<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Revista</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="header-laranja">
        <div class="container header-conteudo">
            <a style="margin: 0;font-weight: 700;letter-spacing: 0.5px;white-space: nowrap;color: white;text-decoration: none;" href="index.php">
                <h3 >Editar Revista</h3>
            </a>
        </div>
    </div>

    <main class="container">
        <a href=""></a>
        <div class="conteudo-card">

            <?php
            $nome = $ano = $edicao = $foto = "";
            $id = null;

            try {
                include "conexao.php";

                if (isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))) {
                    $id = base64_decode($_GET['id']);
                } else {
                    throw new Exception("Revista não encontrada!");
                }

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    // carrega os dados atuais para preencher o formulário
                    $sql = "select * from tabelarevista where id = $id";
                    $resultado = $conexao->query($sql);
                    $dados = $resultado->fetch_assoc();

                    if (!$dados) {
                        throw new Exception("Revista não encontrada!");
                    }

                    $nome = $dados['nome'];
                    $ano = $dados['ano'];
                    $edicao = $dados['edicao'];
                    $foto = empty($dados['foto']) ? "SemImagem.png" : $dados['foto'];
                } else {
                    // recuperando os dados enviados pelo formulário
                    $nome = $_POST['nome'];
                    $ano = $_POST['ano'];
                    $edicao = $_POST['edicao'];
                    $foto = $_POST['fotoatual'];

                    // se uma nova imagem foi enviada, substitui a foto atual
                    if (!empty($_FILES['foto']['name'])) {
                        $target_dir = "img/";
                        $arquivo = basename($_FILES["foto"]["name"]);
                        $target_file = $target_dir . $arquivo;
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                        $foto = $arquivo;
                    }

                    // criando a linha do UPDATE
                    $sql = "update tabelarevista set nome='" . htmlspecialchars($nome) . "', 
                            ano=$ano, edicao=$edicao, foto='$foto' where id=$id";

                    $conexao->query($sql);

                    header("Location: index.php");
                    exit;
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

            <?php if (!empty($nome) && $id !== null): ?>
            <form name="revista" action="editar.php?id=<?= base64_encode($id); ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="fotoatual" value="<?= htmlspecialchars($foto); ?>">

                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <img src="img/<?= htmlspecialchars($foto); ?>" id="preview" class="foto-detalhe img-fluid img-thumbnail shadow" alt="<?= htmlspecialchars($nome); ?>">
                    </div>
                    <div class="col-md-8 col-lg-9 d-flex align-items-center">
                        <div class="w-100">
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" maxlength="100" required value="<?= htmlspecialchars($nome); ?>">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Ano</label>
                                    <input type="number" name="ano" class="form-control" required value="<?= $ano; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Edição</label>
                                    <input type="number" name="edicao" class="form-control" required value="<?= $edicao; ?>">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nova foto da capa (opcional)</label>
                                <input type="file" name="foto" id="imagemnova" accept="image/*" class="form-control">
                            </div>

                            <div class="acoes-form">
                                <input type="submit" class="btn btn-salvar" value="Salvar">
                                <a href="index.php" class="btn btn-cancelar">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <?php endif; ?>

        </div>

    </main>
    <script>
        document.getElementById('imagemnova').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('preview');
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/dialogo.js"></script>
</body>

</html>
