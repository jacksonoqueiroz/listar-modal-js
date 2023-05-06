<?php

include_once "conexao.php";
	
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);
$id_cat = filter_input(INPUT_GET, "id_cat", FILTER_SANITIZE_NUMBER_INT);

if(!empty($pagina) and (!empty($id_cat))){

	//CALCULAR A VISUALIZAÇÃO
	$qnt_result_pg = 40; //QUANTIDADE DE REGISTRO POR PÁGINA
	$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

	$query_prods = "SELECT id, nome_produto 
						 FROM produtos
						 WHERE categorias_produto_id=:categorias_produto_id
						 ORDER BY id DESC
						 LIMIT $inicio, $qnt_result_pg";
	$result_prods = $conn->prepare($query_prods);
	$result_prods->bindParam(':categorias_produto_id', $id_cat, PDO::PARAM_INT);
	$result_prods->execute();

	if(($result_prods) and ($result_prods->rowCount() != 0 )){

		$dados = "<table class='table'>
					<thead>
						<tr>
					      	<th>ID</th>
					      	<th>Nome do Produto</th>
					      	<th>Ações</th>					      	
				    	</tr>
			  		</thead>
			  		<tbody>";

		while($row_prod = $result_prods->fetch(PDO::FETCH_ASSOC)){
			extract($row_prod);
			$dados .="<tr>
					      <td>$id</td>
						  <td>$nome_produto</td>
						  <td><Ações</td>
					   </tr>";
		}

		$dados .= "<tbody>
					</table>";

					//PAGINAÇÃO
					$query_pg = "SELECT COUNT(id) AS num_result 
								 FROM produtos
								 WHERE categorias_produto_id=:categorias_produto_id";
					$result_pg = $conn->prepare($query_pg);
					$result_pg->bindParam(':categorias_produto_id', $id_cat, PDO::PARAM_INT);
					$result_pg->execute();

					$row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

					//QUANTIDADE DE PÁGINA
					$quantidade_pg = ceil($row_pg['num_result'] /	$qnt_result_pg);

					$max_link = 2;

					$dados .= "<nav aria-label='Page navigation example'><ul class='pagination pagination-sm justify-content-center'>";

					    $dados.= "<li class='page-item'><a class='page-link' href='#' onclick='listarProdutosPag(1, $id_cat)'>Primeira</a></li>";

					    for($pag_ant = $pagina - $max_link; $pag_ant <= $pagina - 1; $pag_ant++){
					    	if($pag_ant >= 1){					    		
					    		$dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarProdutosPag($pag_ant, $id_cat)'>$pag_ant</a></li>";
					    	}
					    }						    
						    
						    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

						for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_link; $pag_dep++){

							if($pag_dep <= $quantidade_pg){
								$dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarProdutosPag($pag_dep, $id_cat)'>$pag_dep</a></li>";
							}
							
						}				    
						   $dados .= "<li class='page-item'>
					      		<a class='page-link' href='#' onclick='listarProdutosPag($quantidade_pg, $id_cat)'>Última</a></li>";
					  $dados .= "</ul></nav>";
		
		$retorna = ['erro' => false, 'dados' => $dados];
	}else{
		$retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Nenhum produto encontrado!</div>"];
	}

		
}else{
	$retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Nenhum produto encontrado!</div>"];
}



echo json_encode($retorna);