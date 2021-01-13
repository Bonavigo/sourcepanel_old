<?php require_once('app/general.php'); ?>
<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title> - Sourcepanel</title>
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
<body style="background:#f5f5f5;">
<nav class="blue darken-4">
	<div class="nav-wrapper">
		<a href="index.php" class="brand-logo hide-on-med-and-down"><img src="assets/img/sourcepanel_p.png" style="margin-top:13px;margin-left:15px;"></a>
		<ul id="nav-mobile" class="right">
			<li class="tooltippedbtn" data-position="bottom" data-tooltip="Notificações"><a href="#!" class="dropdown-trigger-not" data-target="notificacoes"><i class="material-icons">chat</i></a></li>
			<li class="tooltippedbtn" data-position="bottom" data-tooltip="Minhas moedas"><a href="#lojabr" class="modal-trigger"><span style="font-size:18px;"><img src="assets/img/moeda.png" style="position:relative;top:7px;" class="hide-on-small-only"><img src="assets/img/moeda2.png" style="position:relative;top:2px;" class="hide-on-med-and-up"> <strong><!--<?php echo $Moedas['br']; ?>--></strong><span class="hide-on-small-only"></span></span></a></li>
			<li><a href="#!" class="dropdown-trigger-eu" data-target="meuperfil"><?php echo $_SESSION['usuario'] ?><div class="card blue darken-3 hide-on-med-and-down" title="<?php echo $_SESSION['usuario'] ?>" style="margin-top:8px;width:50px;height:50px;background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $_SESSION['usuario'] ?>&amp;action=std&amp;direction=3&amp;head_direction=3&amp;gesture=sml&amp;size=m) no-repeat -8px -15px;border-radius: 50px;float: right;margin-left: 10px;"></div></a></li>
			<div style="clear:both;"></div>
		</ul>
	</div>
</nav>
<ul id="meuperfil" class="dropdown-content">
	<li class="waves-effect waves-light"><a href="index.php?modulo=25" class="notifica-notificacao">Configurações</a></li>
	<li class="waves-effect waves-light"><a href="sair.php" class="notifica-notificacao">Sair</a></li>
</ul>
<ul id="notificacoes" class="dropdown-content notifica">
	<li class="notifica-notificacao light-green darken-4 waves-effect waves-light"><a class="notifica-header">NOTIFICAÇÕES</a></li>
	<?php
		/*$notificacoes = DB::query("SELECT * FROM notificacoes WHERE user_id =%i ORDER BY id DESC LIMIT 3", $_SESSION['id']);
		foreach ($notificacoes as $notificacao) {
			echo '<li class="waves-effect '.$notificacao['tipo'].'">
			<a class="notifica-notificacao">';
			if ($notificacao['tipo'] == 'alerta') {
				echo '<span style="font-size:18px;">Alerta</span><br>';
			}
			else if ($notificacao['tipo'] == 'financeiro') {
				echo '<span style="font-size:18px;">Pagamento</span><br>';
			}
			else if ($notificacao['tipo'] == 'aviso') {
				echo '<span style="font-size:18px;">Aviso</span><br>';
			}
			else if ($notificacao['tipo'] == 'comentario') {
				echo '<span style="font-size:18px;">Comentário</span><br>';
			}
			else {
				echo '<span style="font-size:18px;">Patrulha</span><br>';
			}
			if (!empty($notificacao['msg'])) {
				echo '<span style="font-size:15px;">'.$notificacao['msg'].'</span><br>';
			}
			echo '<span style="font-size:13px;">'.date('H:i', $notificacao['timestamp']).' - '.date('d/m/Y', $notificacao['timestamp']).'</span></a></li>';
		}*/
	?>
	<li class="notifica notifica-bottom light-green darken-4 waves-effect waves-light"></li>
</ul>
<ul id="atualizacoes" class="dropdown-content notifica">
	<li class="notifica-notificacao light-green darken-4 waves-effect waves-light"><a class="notifica-header">ATUALIZAÇÕES</a></li>
	<?php
		/*foreach ($updates as $update) {
			$atualizador = DB::queryFirstRow("SELECT * FROM usuarios WHERE id=%i", $update['user_id']);
			$autor = $atualizador['usuario'];
			echo '<li class="waves-effect">
			<a class="notifica-notificacao">';
			echo '<span style="font-size:16px;">'.date('d/m/Y', $update['time']).'</span><br>';
			echo '<span style="font-size:14px;">'.$update['acao'].'</span><br><span style="font-size:13px;">por '.$autor.'</span></a></li>';
		}*/
	?>
	<li class="notifica notifica-bottom light-green darken-4 waves-effect waves-light"></li>
</ul>
<div class="z-depth-2" style="background:#FFFFFF;height:45px;">
	<div class="circle waves-effect sidenav-trigger" data-target="mobile-navbar" style="height:40px;width:40px;text-align:center;margin-top:2px;margin-left:15px;"><i style="margin-top:7px;font-size:28px;" class="material-icons">menu</i></div>
</div>
	<main>

	</main>
	<footer class="blue darken-4" style="color:#FFF;">
		<div class="footer-copyright">
			<div class="container">
				<p style="text-align:center;margin:8px;">© 2020-<?php echo date('Y'); ?> <i class="fas fa-code"></i> por <a class="modal-trigger" style="color:#FFF;font-weight:bold;" href="https://github.com/Bonavigo" target="_blank">BrunoBonamigo</a> <a class="modal-trigger" style="color:#FFF;font-weight:bold;" href="#reportarbugs"> · Reportar <i class="fas fa-bug"></i></a></p>
			</div>
		</div>
	</footer>
</body>
</html>