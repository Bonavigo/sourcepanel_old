<?php
	require_once('app/general.php');
	if (!isset($_SESSION['code_verify'])) {
		$num = rand(21000, 30000);
		$codigo = 'SRCP-'.$num;
		$_SESSION['code_verify'] = $codigo;
	}
	if (!isset($_SESSION['code_verify2'])) {
		$num = rand(21000, 30000);
		$codigo = 'SRCP-'.$num;
		$_SESSION['code_verify2'] = $codigo;
	}
	if(!empty($_POST['usuario']) AND !empty($_POST['senha'])) {
		$logar->logar(strip_tags($_POST['usuario']), strip_tags($_POST['senha'])/*, $_POST['g-recaptcha-response']*/);
	}
	if(!empty($_POST['usuario_cad']) AND !empty($_POST['senha_cad'])) {
		if (!empty($_POST['concordo'])) {
			$dados = $api->usarapi("https://www.habbo.com.br/api/public/users?name=".$_POST['esqueci_user']);
			if ($dados->motto == $_SESSION['code_verify']) {
				$logar->cadastrar(strip_tags($_POST['usuario_cad']), strip_tags($_POST['senha_cad']), strip_tags($_POST['senha_cad2'])/*, $_POST['g-recaptcha-response']*/);
			} if ($dados->error == 'not-found') {
				$_SESSION['erro'] = 'Usuário inexistente!';
				echo '<script>location.href="login.php"</script>';
			} else {
				$_SESSION['erro'] = 'A missão não foi alterada!';
				echo '<script>location.href="login.php"</script>';
			}
		}
		if (empty($_POST['concordo'])) {
			$_SESSION['erro'] = 'Você precisa concordar com os termos de uso!';
			echo '<script>location.href="login.php"</script>';
		}
	}
	if(!empty($_POST['esqueci_user']) AND !empty($_POST['esqueci_senha'])) {
		$dados = $api->usarapi("https://www.habbo.com.br/api/public/users?name=".$_POST['esqueci_user']);
		if ($dados->motto == $_SESSION['code_verify2']) {
			$logar->esqueci_senha(strip_tags($_POST['esqueci_user']), strip_tags($_POST['esqueci_senha']), strip_tags($_POST['esqueci_senha2'])/*, $_POST['g-recaptcha-response']*/);
		}
		if ($dados->error == 'not-found') {
			$_SESSION['erro'] = 'Usuário inexistente!';
			echo '<script>location.href="login.php"</script>';
		}
		else {
			$_SESSION['erro'] = 'A missão não foi alterada!';
			echo '<script>location.href="login.php"</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Sourcepanel</title>
	<meta charset="utf-8">
	<link rel="icon" href="assets/img/sourcepanel_p.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/materialize/css/materialize.min.css">
	<script src="assets/materialize/js/materialize.min.js"></script>
	<script src="assets/main.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://kit.fontawesome.com/5db384e8a3.js" crossorigin="anonymous"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/geral.css">
</head>
<body class="blue darken-2">
<div id="cadastro" class="modal modal-cadastro">
	<form method="POST" action="#">
	<div class="modal-content">
		<p style="text-align:center;margin:0;font-size:22px;"><img src="assets/img/sourcepanel_g.png"><br><b>Source</b>panel</p>
		<div class="input-field" style="margin-top:5px;clear:both;">
			<input id="usuario_cad" name="usuario_cad" type="text" class="validate" required>
			<label for="usuario_cad">Usuário</label>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<input id="senha_cad" name="senha_cad" type="password" class="validate" required>
			<label for="senha_cad">Senha</label>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<input id="senha_cad2" name="senha_cad2" type="password" class="validate" required>
			<label for="senha_cad2">Repita a Senha</label>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<input id="codigo" name="codigo" type="text" class="validate" value="<?php echo $_SESSION['code_verify']; ?>" required disabled>
			<label for="codigo">Código</label>
			<span class="helper-text" data-error="" data-success="">Coloque este código em sua missão</span>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<p><label><input type="checkbox" class="filled-in" name="concordo" value="concordo" /><span>Ao clicar em CADASTRAR, você estará concordando com os <a href="#">Termos de Uso</a> do Sourcepanel.</span></label></p>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="modal-close waves-effect waves-red btn-flat">Fechar</button>
		<button type="submit" class="waves-effect waves-green btn-flat">Cadastrar</button>
	</div>
	</form>
</div>
<div id="esqueci" class="modal modal-cadastro">
	<form method="POST" action="#">
	<div class="modal-content">
		<p style="text-align:center;margin:0;font-size:22px;"><img src="assets/img/sourcepanel_g.png"><br>Recuperar senha do <b>Source</b>panel</p>
		<div class="input-field" style="margin-top:5px;clear:both;">
			<input id="esqueci_user" name="esqueci_user" type="text" class="validate" required>
			<label for="esqueci_user">Usuário</label>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<input id="esqueci_senha" name="esqueci_senha" type="password" class="validate" required>
			<label for="esqueci_senha">Senha</label>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<input id="esqueci_senha2" name="esqueci_senha2" type="password" class="validate" required>
			<label for="esqueci_senha2">Repita a Senha</label>
		</div>
		<div class="input-field" style="margin-top:5px;">
			<input id="codigo2" name="codigo" type="text" class="validate" value="<?php echo $_SESSION['code_verify2']; ?>" required disabled>
			<label for="codigo2">Código</label>
			<span class="helper-text" data-error="" data-success="">Coloque este código em sua missão</span>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="modal-close waves-effect waves-red btn-flat">Fechar</button>
		<button type="submit" class="waves-effect waves-green btn-flat">Recuperar senha</button>
	</div>
	</form>
</div>
<div class="container">
	<div class="row">
		<div class="col m2 l4 xl4 hide-on-small-only"></div>
		<div class="col s12 m8 l4 xl4">
		<div class="card" style="border-radius:8px;margin-top:25%;">
			<div class="card-content">
				<form method="POST" action="#">
				<img width="60" src="assets/img/sourcepanel_g.png" style="display:block;margin:-10px auto 5px auto;">
				<span class="card-title" style="font-size:18px;margin:5px 0 15px 0;text-align:center;">Faça o login para ter acesso ao painel.</span>
				<?php
					if (!empty($_SESSION['erro'])) {
						echo '<div class="card-panel red">
								<p style="color:#FFF;">'.$_SESSION['erro'].'</p>
							</div>';
					}
				?>
				<?php
					if (!empty($_SESSION['sucesso'])) {
						echo '<div class="card-panel green">
								<p style="color:#FFF;">'.$_SESSION['sucesso'].'</p>
							</div>';
					}
				?>
				<div class="input-field" style="margin-top:5px;">
					<input id="usuario" name="usuario" type="text" class="validate" required>
					<label for="usuario">Usuário</label>
				</div>
				<div class="input-field" style="margin-top:10px;">
					<input id="senha" name="senha" type="password" class="validate" required>
					<label for="senha">Senha</label>
				</div>
				<p><label><input type="checkbox" value="ficar_logado" name="ficar_logado" class="filled-in"><span>Ficar logado</span></label></p>
				<a class="modal-trigger" href="#esqueci" style="display:inline-block;margin:5px 0 0 0;">Esqueci a senha</a>
				<div class="input-field" style="margin-top:10px;">
					<div style="margin-bottom:8px;margin:0 auto;" class="g-recaptcha" data-sitekey="codigo"></div>
				</div>
				<div class="input-field" style="margin-top:10px;">
					<button type="submit" style="width:100%;height:45px;" class="blue darken-1 waves-effect waves-light btn">ENTRAR</button>
				</div>
				<div class="input-field" style="margin-top:10px;">
					<button type="button" style="width:100%;height:45px;" class="indigo accent-2 waves-effect waves-light btn modal-trigger" href="#cadastro">CADASTRAR-SE</button>
				</div>
				</form>
			</div>
		</div>
		</div>
		<div class="col m2 l4 xl4 hide-on-small-only"></div>
	</div>
</div>
</body>
</html>