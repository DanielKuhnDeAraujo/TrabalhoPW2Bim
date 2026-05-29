<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exemplo PHP PW1</title>
	<link rel="icon" type="image/icon" href="img/icon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilo.css">
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
		<h3>Semana 01 - Exemplo 13 - Listagem Geral de Produtos - Imagem</h3>
		<header class="mb-2"
			<div class="row">
				<div class="col-4">
					<a href="incluir.php" class="btn btn-primary">Incluir</a>
				</div>
			</div>
		</header>
		<?php
		try {
			// include_once "conexao.php";
			// require "conexao.php";
			// require_once "conexao.php";
			include "conexao.php";

			// ajustando a instrução select para ordenar por produto
			//$query = mysqli_query($conexao, "select * from tabelaimg order by produto");
			$sql = "select * from tabelaimg order by produto";
			$query = $conexao->query($sql);
			// if (!$query) {
			// 	die('Query Inválida: ' . @mysqli_error($conexao));
			// }
			echo <<<DOC
				<table class="table table-info table-hover">
					<tr>
						<th width="30px">Id</th>
						<th width="100px">Código</th>
						<th width="250px">Produto</th>
						<th width="100px">Valor</th>
						<th width="100px">Produto</th>
						<th width="200px">Ações</th>
					</tr>\n
				DOC;

			while ($dados = mysqli_fetch_array($query)) {
				echo "<tr>\n";
				echo "<td class=\"centraliza\">{$dados['id']}</td>\n";
				echo "<td>" . $dados['codigo'] . "</td>\n";
				echo "<td>" . $dados['produto'] . "</td>\n";
				echo "<td> R$ " . number_format($dados['valor'], 2, ",", ".") . "</td>\n";
				// buscando a na pasta imagem
				if (empty($dados['imagem'])) {
					$imagem = "SemImagem.png";
				} else {
					$imagem = $dados['imagem'];
				}
				//$id_del = $dados['id'];
				$id = base64_encode($dados['id']);
				echo "<td>\n
					<a href=\"verproduto.php?id=$id\">\n
						<img src=\"img/$imagem\" class=\"foto img-thumbnail shadow\">\n
					</a>\n
					</td>\n";
				echo "<td>\n
						<a href=\"verproduto.php?id=$id\" class=\"btn btn-primary\">\n
							Visualizar\n
						</a>&nbsp;&nbsp;\n
						<a href=\"editar.php?id=$id\" class=\"btn btn-primary\">\n
							Editar\n
						</a>&nbsp;&nbsp\n 
						<!-- Acrescentado para apagar e chamar o modal -->
						<a href=\"#\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#excluirModal\" data-produto=\"$id\">\n 
							Apagar\n
						</a>\n
					</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

			//mysqli_close($conexao);
			//$conexao = null;
		
		} catch (Exception $e) {
			echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n
					<h2>Aconteceu um erro:<br>\n
						{$e->getMessage()}\n
					</h2>\n
					<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>\n
				</div>\n";
		}
		?>
	</main>
	<?php include "modal.php";  //Acrescentado para incluir o modal ?>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/dialogo.js"></script> <!-- Acrescentado para personalizar o modal -->
</body>

</html>