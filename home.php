<?php 
include_once('head.php');
if (!isset($_SESSION['usuario'])) {
	header('Location: index.php?erro=1');
}
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="funcoes.js"></script>
		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript">
		//carregar os tweets
	function atualizaTweet(){
		$.ajax({
			url: 'get_tweet.php',
			success: function(data){
				$('#tweets').html(data);
			}
		});
	}
	//quantidade de seguidores
	function qtdTweets(){
		$.ajax({
			url: 'qtd_tweet.php',
			success: function(data){
				//alert(data);
				$('#qtd_tweets').html(data);
			}
		});
	}
		//apagar tweet
		function apagaTweet(clicked_id){
			var id_tweet = clicked_id;
			//alert(tweet);
			$.ajax({
				url: 'apagar_tweet.php',
				method: 'post',
				data: {id_tweet: id_tweet},
				success: function(data){
					//alert(data);
					atualizaTweet();
					qtdTweets();
				}
			});
		}
	
		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	         <a href="index.php"><img src="imagens/icone_twitter.png" /></a>
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>

	    <div class="container">

	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?= $_SESSION['usuario'] ?></h4>
	    				<hr/>
	    				<div class="col-md-6">
	    					TWEETS <br/> <div id="qtd_tweets"></div>
	    				</div>
	    				<div class="col-md-6">
	    					SEGUIDORES <br/> <div id="qtd_seguidores"></div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>

	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<div class="input-group">
	    					<input type="text" id="texto_tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140">
	    					<span class="input-group-btn">
	    						<button class="btn btn-default" id="btn_tweet">Tweet</button>
	    					</span>
	    				</div>
	    			</div>
	    		</div>
	    		<div id="tweets" class="list-group">
	    				
	    		</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				<div>
			</div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>