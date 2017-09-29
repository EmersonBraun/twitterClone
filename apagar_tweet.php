<?php 
include_once('head.php');

$id_usuario = $_SESSION['id_usuario'];
$id_tweet = $_POST['id_tweet'];
//quantidade de seguidores
$sql = "DELETE FROM tweet WHERE id_tweet = $id_tweet";
$resultado_id = mysqli_query($link, $sql);
//echo $sql;
/*
if ($resultado_id) {
	$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	$qtd_seguidores = $registro['qtd_seguidores'];
}else{
	echo "Erro na execução da query";
}
//echo "Tweet apagado";*/
?>