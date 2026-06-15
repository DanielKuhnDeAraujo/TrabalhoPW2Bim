<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revistas</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <style>
        
    </style>
</head>

<body>

    <div class="header-laranja">
        <div class="container header-conteudo">
            <h3 class="logo">QuadriVerse</h3>

            <div class="header-acoes">
                <form action="#" method="post" class="d-flex">
                    <div class="input-group">
                        <input type="search" size="30" maxlength="50" placeholder="Pesquisar por nome..."
                            id="busca" name="filtro" class="form-control">
                        <input type="submit" value="Pesquisar" class="btn btn-pesquisar">
                    </div>
                </form>

                <a href="incluir.php" class="btn btn-incluir">Incluir</a>
            </div>
        </div>
    </div>

    <main class="container">

        <div class="conteudo-card">

            <div class="table-responsive">
                <?php
                try {
                    include "conexao.php";

                    $sql = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["filtro"])) {
                        $filtro = $_POST["filtro"];
                        $sql = "select * from tabelarevista where nome like '%$filtro%' order by nome";
                    } else {
                        $sql = "select * from tabelarevista order by nome";
                    }

                    $query = $conexao->query($sql);

                    echo <<<DOC
                        <table class="table table-revistas align-middle">
                            <thead>
                                <tr>
                                    <th width="50px" class="centraliza">Id</th>
                                    <th>Nome</th>
                                    <th width="80px" class="centraliza">Ano</th>
                                    <th width="80px" class="centraliza">Edição</th>
                                    <th width="150px">Cadastro</th>
                                    <th width="160px" class="centraliza">Foto</th>
                                    <th width="250px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>\n
                    DOC;

                    while ($dados = mysqli_fetch_array($query)) {

                        if (empty($dados['foto'])) {
                            $imagem = "SemImagem.png";
                        } else {
                            $imagem = $dados['foto'];
                        }

                        $id = base64_encode($dados['id']);

                        echo "\t\t\t\t\t<tr>\n";
                        echo "\t\t\t\t\t\t<td class=\"centraliza\">{$dados['id']}</td>\n";
                        echo "\t\t\t\t\t\t<td>" . htmlspecialchars($dados['nome']) . "</td>\n";
                        echo "\t\t\t\t\t\t<td class=\"centraliza\">" . $dados['ano'] . "</td>\n";
                        echo "\t\t\t\t\t\t<td class=\"centraliza\">" . $dados['edicao'] . "</td>\n";
                        echo "\t\t\t\t\t\t<td>" . date('d/m/Y', strtotime($dados['datacadastro'])) . "</td>\n";
                        echo "\t\t\t\t\t\t<td class=\"centraliza\">
                            <a href=\"verproduto.php?id=$id\">
                                <img src=\"img/$imagem\" class=\"foto shadow\" alt=\"{$dados['nome']}\">
                            </a>
                        </td>\n";

                        echo "\t\t\t\t\t\t<td>
                            <a href=\"verproduto.php?id=$id\" class=\"btn btn-sm btn-visualizar\">
                                Visualizar
                            </a>&nbsp;
                            <a href=\"editar.php?id=$id\" class=\"btn btn-sm btn-editar\">
                                Editar
                            </a>&nbsp;
                            <a href=\"#\" class=\"btn btn-sm btn-apagar\" data-bs-toggle=\"modal\" data-bs-target=\"#excluirModal\" data-produto=\"$id\">
                                Apagar
                            </a>
                        </td>\n";
                        echo "\t\t\t\t\t</tr>\n";
                    }
                    echo "\t\t\t\t</tbody>\n\t\t\t</table>\n";

                } catch (Exception $e) {
                    echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n
                            <h2>Aconteceu um erro:<br>\n
                                {$e->getMessage()}\n
                            </h2>\n
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>\n
                        </div>\n";
                }
                ?>
            </div>

        </div>

    </main>

    <?php include "modal.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/dialogo.js"></script>
</body>

</html>