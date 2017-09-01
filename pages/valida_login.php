<?php
	session_start();
	$usuariot = $_POST['usuario'];
	//$usuariot = isset($_POST['usuario']) ? $_POST['usuario'] : '';
	$senhat = $_POST['senha'];
	//$senhat = isset($_POST['senha']) ? $_POST['senha'] : '';	
	
	
	include_once("conexao.php");
	
	
	$result = mysql_query("SELECT * FROM usuarios WHERE login='$usuariot' 
	AND senha = '$senhat' LIMIT 1"); //seleciona apenas se o usuario e a senhas estiverem corretas
	$resultado = mysql_fetch_assoc($result); //Obtém uma linha do resultado como um array associativo
	if(empty($resultado)){
		//mensagem de erro
		$_SESSION['loginErro'] = "Usuario ou senha invalido";

		//manda o usuario para tela de login
		header("Location: login.php");	
	}else{
		//Define os valores atribuidos na sessão do usuario
		$_SESSION['usuarioId']          = $resultado['id'];
		$_SESSION['usuarioNome']        = $resultado['nome'];
		$_SESSION['usuarioNivelAcesso'] = $resultado['nivel_acesso_id'];
		$_SESSION['usuarioLogin']       = $resultado['login'];
		$_SESSION['usuarioSenha']       = $resultado['senha'];
		
		if($_SESSION['usuarioNivelAcesso'] == 1){
			header("Location: adminstrativo.php");
		}else{
			header("Location: usuario.php");
		}
		
		
	}
	?>
