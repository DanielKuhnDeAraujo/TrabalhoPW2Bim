<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Revista</title>
    <link rel="icon" type="image/icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .centraliza {
            text-align: center;
        }

        .foto {
            width: 150px;
        }
    </style>
</head>

<body>
    <main class="container">
        <?php
        try {
            include "conexao.php";
            if (isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))) {
                $id = base64_decode($_GET['id']);
            } else {
                header("Location: index.php");
            }

            $sql = "delete from tabelarevista where id=$id";

            $resultado = $conexao->query($sql);

            echo <<<ALERT
                <div class="alert alert-info container alert-dismissible fade show" role="alert">
                    <h2>Aconteceu um erro:<br>
                        Excluido com sucesso!
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <a href="index.php" class="btn btn-primary">Voltar</a>
                </div>\n
            ALERT;
        } catch (Exception $e) {
            echo <<<ALERT
                <div class="alert alert-danger container alert-dismissible fade show" role="alert">
                    <h2>Aconteceu um erro:<br>
                        {$e->getMessage()}
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <a href="index.php" class="btn btn-primary">Voltar</a>
                </div>\n
            ALERT;
        }
        ?>
    </main>
</body>

</html>