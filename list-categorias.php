<?php

include_once "conexao.php";
	
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if(!empty($pagina)){

	//CALCULAR A VISUALIZAÇÃO
	$qnt_result_pg = 40; //QUANTIDADE DE REGISTRO POR PÁGINA
	$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

	$query_cats_prods = "SELECT id, nome_cat_prod 
						FROM categorias_produtos
						ORDER BY id DESC
						LIMIT $inicio, $qnt_result_pg";
	$result_cats_prods = $conn->prepare($query_cats_prods);
	$result_cats_prods->execute();

	if(($result_cats_prods) and ($result_cats_prods->rowCount() != 0 )){

		$dados = "<table class='table'>
					<thead>
						<tr>
					      	<th>ID</th>
					      	<th>Nome</th>
					      	<th>Ações</th>					      	
				    	</tr>
			  		</thead>
			  		<tbody>";

		while($row_cat_prod = $result_cats_prods->fetch(PDO::FETCH_ASSOC)){
			extract($row_cat_prod);
			$dados .="<tr>
					      <td>$id</td>
						  <td>$nome_cat_prod</td>
						  <td><button class='btn btn-outline-primary btn-sm' onclick='listarProdutos(1, $id)'>Produtos</button></td>
					   </tr>";
		}

		$dados .= "<tbody>
					</table>";

					//PAGINAÇÃO
					$query_pg = "SELECT COUNT(id) AS num_result FROM categorias_produtos";
					$result_pg = $conn->prepare($query_pg);
					$result_pg->execute();

					$row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

					//QUANTIDADE DE PÁGINA
					$quantidade_pg = ceil($row_pg['num_result'] /	$qnt_result_pg);

					$max_link = 2;

					$dados .= "<nav aria-label='Page navigation example'><ul class='pagination pagination-sm justify-content-center'>";

					    $dados.= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos(1)'>Primeira</a></li>";

					    for($pag_ant = $pagina - $max_link; $pag_ant <= $pagina - 1; $pag_ant++){
					    	if($pag_ant >= 1){					    		
					    		$dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos($pag_ant)'>$pag_ant</a></li>";
					    	}
					    }						    
						    
						    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

						for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_link; $pag_dep++){

							if($pag_dep <= $quantidade_pg){
								$dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCatProdutos($pag_dep)'>$pag_dep</a></li>";
							}
							
						}
						    
						    
						    
						    $dados .= "<li class='page-item'>
					      		<a class='page-link' href='#' onclick='listarCatProdutos($quantidade_pg)'>Última</a></li>";
					  $dados .= "</ul></nav>";
		
		$retorna = ['erro' => false, 'dados' => $dados];


	}else{
		$retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Nenhuma categoria encontrada!</div>"];
	}

}else{
	$retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Nenhuma categoria encontrada!</div>"];
}



echo json_encode($retorna);