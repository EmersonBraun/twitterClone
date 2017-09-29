<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?erro=1');
}
require_once('db.class.php');

$id_usuario = $_SESSION['id_usuario'];

$objDb = new db();
$link = $objDb->conecta_mysql();

$sql = "SELECT DATE_FORMAT(t.data_inclusao,'%d %b %Y %T')";
$sql.=" AS data_inclusao_formatada, t.tweet, t.id_tweet, u.usuario, u.id";
$sql.=" FROM tweet AS t JOIN usuarios AS u ON(t.id_usuario = u.id)";
$sql.=" WHERE id_usuario = $id_usuario ";//tweets do usuario
$sql.=" OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores";
$sql.=" WHERE id_usuario = $id_usuario)";
$sql.="ORDER BY data_inclusao DESC";//tweet dos seguidores

$resultado_id = mysqli_query($link, $sql);

if ($resultado_id) {
	while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {

		echo "<a href='#' class='list-group-item'>";
			echo "<h4 class='list-group-item-heading'>".$registro['usuario']."
			<small> - ".$registro['data_inclusao_formatada']."</small>
			</h4>";
			echo "<p class='list-group-item-text'>".$registro['tweet'] ;

			$btn_apagar_display = 'none';
			if ($registro['id'] == $id_usuario) {
				$btn_apagar_display = 'block';
				$funcao = 'apagaTweet(this.id)';
			}else{
				$funcao = '';
			}
			echo "<button type='button' 
			id='".$registro['id_tweet']."' 
			data-tweet=".$registro['id_tweet']." 
			value=".$registro['id_tweet']." 
			style='display:".$btn_apagar_display. "' 
			class='btn btn-primary pull-right'
			onclick='$funcao'>Apagar Tweet
			</button>";
			echo '</p>';
				echo '<div class="clearfix"></div>';
		echo "</a>";
	}
} else {
	echo "Erro na consulta";
}

 ?>