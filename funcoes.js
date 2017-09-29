$(document).ready(function(){
	atualizaTweet();
	qtdTweets();
	qtdSeguir();
	//verificar se os campos de usuário e senha foram devidamente preenchidos
	$('#btn_login').click(function(){

		var campo_vazio = false;

		if($('#campo_usuario').val() == ''){
			$('#campo_usuario').css({'border-color' : '#A94442'});
			campo_vazio = true;
		}else{
			$('#campo_usuario').css({'border-color' : '#CCC'});
		}

		if($('#campo_senha').val() == ''){
			$('#campo_senha').css({'border-color' : '#A94442'});
			campo_vazio = true;
		}else{
			$('#campo_senha').css({'border-color' : '#CCC'});
		}

		if(campo_vazio) return false;

	});
	//associar a função ao botão de submissão
	$("#btn_tweet").click(function(){

		if ($("#texto_tweet").val().length > 0) {
			$.ajax({
				url: 'inclui_tweet.php',
				method: 'post',
				data: {texto_tweet: $('#texto_tweet').val()},
				success: function(data){
					$('#texto_tweet').val('');
					atualizaTweet();
					qtdTweets();
				}
			});
		}
	});
	//carregar os tweets
	function atualizaTweet(){
		$.ajax({
			url: 'get_tweet.php',
			success: function(data){
				$('#tweets').html(data);
			}
		});
	}
	//procurar pessoas
	$("#btn_procurar_pessoa").click(function(){

		if ($("#nome_pessoa").val().length > 0) {
			$.ajax({
				url: 'get_pessoas.php',
				method: 'post',
				data: 
				//$('#form_procurar_pessoas').serialize(),
				{nome_pessoa: $('#nome_pessoa').val()},
				success: function(data){
					$('#pessoas').html(data);

					$('.btn_seguir').click( function(){
						var id_usuario = $(this).data('id_usuario');

						$('#btn_seguir_'+id_usuario).hide();
						$('#btn_deixar_seguir_'+id_usuario).show();

						$.ajax({
							url: 'seguir.php',
							method: 'post',
							data: {seguir_id_usuario: id_usuario},
							success: function(data){
								qtdSeguir();
							}
						});
					});
					$('.btn_deixar_seguir').click( function(){
						var id_usuario = $(this).data('id_usuario');

						$('#btn_seguir_'+id_usuario).show();
						$('#btn_deixar_seguir_'+id_usuario).hide();

						$.ajax({
							url: 'deixar_seguir.php',
							method: 'post',
							data: {deixar_seguir_id_usuario: id_usuario},
							success: function(data){
								qtdSeguir();
							}
						});
					});
				}
			});
		}
	});

	//quantidade de seguidores
	function qtdSeguir(){
		$.ajax({
			url: 'qtd_seguidores.php',
			success: function(data){
				//alert(data);
				$('#qtd_seguidores').html(data);
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
});