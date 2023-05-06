
const listarCatProdutos = async (pagina) => {
	const dados = await fetch("./list-categorias.php?pagina=" + pagina);
	//const dados = await fetch("./list-categorias.php");
	const resposta = await dados.json();

	if(resposta['erro']){
		document.getElementById("msgAlerta").innerHTML = resposta['msg'];
	}else{
		document.querySelector(".listar-categorias").innerHTML = resposta['dados'];
	}
}


listarCatProdutos(1);

async function listarProdutos(pagina, id_cat){
	console.log("Página " + pagina + ". Id da categoria: " + id_cat);
	const dadosProd = await fetch('listar-produtos.php?pagina=' + pagina + "&id_cat=" + id_cat);

	const respostaProd = await dadosProd.json();

	if(respostaProd['erro']){
		document.getElementById("msgAlerta").innerHTML = respostaProd['msg'];
	}else{
		
		//document.getElementById("msgAlerta").innerHTML = respostaProd['msg'];

		const listarProdutosModal = new bootstrap.Modal(document.getElementById("listarProdutosModal"));
		listarProdutosModal.show();
		document.querySelector(".listar-produtos").innerHTML = respostaProd['dados'];
	}
}

async function listarProdutosPag(pagina, id_cat){
	const dadosProd = await fetch('listar-produtos.php?pagina=' + pagina + "&id_cat=" + id_cat);

	const respostaProd = await dadosProd.json();

	if(respostaProd['erro']){
		document.getElementById("msgErroListProd").innerHTML = respostaProd['msg'];
	}else{
		document.querySelector(".listar-produtos").innerHTML = respostaProd['dados'];
	}
}