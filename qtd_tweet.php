<?php 
session_start();

	if(!isset($_SESSION['usuario'])){
		header('Location: index.php?erro=1');
	}

	require_once('db.class.php');

	$id_usuario = $_SESSION['id_usuario'];

	$objDb = new db();
	$link = $objDb->conecta_mysql();
//quantidade de tweets
$sql = "SELECT COUNT(*) AS qtd_tweets FROM tweet WHERE id_usuario = $id_usuario";
$resultado_id = mysqli_query($link, $sql);
$qtd_tweets = 0;

if ($resultado_id) {
	$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	$qtd_tweets = $registro['qtd_tweets'];
}else{
	echo "Erro na execução da query";
}
echo $qtd_tweets;
?>