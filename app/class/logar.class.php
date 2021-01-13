<?php
	class Logar {
		public function logar($usuario, $senha/*, $captcha*/) {
			$dados = DB::queryFirstRow("SELECT * FROM usuarios WHERE usuario=%s", $usuario);
			if (DB::affectedRows($dados) > 0) {
				if (md5('source0120panel'.$senha) == $dados['senha']) {
					$_SESSION['usuario'] = $usuario;
					$logar = DB::query("UPDATE usuarios SET ip_ultimo_login=%s0 WHERE usuario=%s1", $_SERVER['REMOTE_ADDR'], $usuario);
					echo '<script>location.href="index.php"</script>';
				}
				else {
					$_SESSION['erro'] = 'Senha incorreta!';
					echo '<script>location.href="login.php"</script>';
					unset($_SESSION['usuario']);
				}
			} else {
				$_SESSION['erro'] = 'Conta inexistente!';
				echo '<script>location.href="login.php"</script>';
				unset($_SESSION['usuario']);
			}
		}
		public function cadastrar($usuario, $senha, $senha2/*, $captcha*/) {
			$dados = DB::query("SELECT * FROM usuarios WHERE usuario=%s", $usuario);
			if (DB::affectedRows($dados) < 1) {
				if ($senha == $senha2) {
					DB::insert('usuarios', [
						'usuario' => $usuario,
						'senha' => md5('source0120panel'.$senha),
						'criacao' => time(),
						'ip_criacao' => $_SERVER['REMOTE_ADDR'],
						'ip_ultimo_login' => $_SERVER['REMOTE_ADDR']
					]);
					$_SESSION['sucesso'] = 'Conta criada com sucesso!';
				}
				if ($senha !== $senha2) {
					$_SESSION['erro'] = 'As senhas não batem!';
					echo '<script>location.href="login.php"</script>';
				}
			} else {
				$_SESSION['erro'] = 'Conta já existente!';
				echo '<script>location.href="login.php"</script>';
			}
		}
		public function esqueci_senha($usuario, $senha, $senha2/*, $captcha*/) {
			if ($senha == $senha2) {
				$trocar = DB::query("UPDATE usuarios SET senha=%s0 WHERE usuario=%s1", md5('source0120panel'.$senha), $usuario);
				$_SESSION['sucesso'] = 'Senha trocada com sucesso!';
				echo '<script>location.href="login.php"</script>';
			} else {
				$_SESSION['erro'] = 'As senhas não batem!';
				echo '<script>location.href="login.php"</script>';
			}
		}
	}
?>