<?php require_once('app/general.php'); ?>
<?php
	if (empty($_SESSION['id'])) {
		echo '<script>location.href="login.php"</script>';
	}
	$dados_alistado = DB::queryFirstRow("SELECT * FROM alistados WHERE nick=%s AND status='ativo'", $_SESSION['usuario']);
	$dados_painel = DB::queryFirstRow("SELECT * FROM usuarios WHERE usuario=%s", $_SESSION['usuario']);
	$patente = DB::queryFirstRow("SELECT * FROM patentes WHERE id=%s", $dados_alistado['patente']);
	if (DB::affectedRows($dados_alistado) < 1) {
		session_destroy();
		echo '<script>location.href="login.php"</script>';
	}
	if (!isset($_GET['modulo'])) {
		$_GET['modulo'] = 1;
	}
	$cargos = DB::query("SELECT * FROM rel_cargos WHERE id_usuario=%s", $_SESSION['id']);
	$i = 0;
	foreach ($cargos as $cargo) {
		$query = DB::query("SELECT * FROM permissoes_cargos WHERE id_cargo=%s0 AND id_modulo=%s1", $cargo['id_cargo'], $_GET['modulo']);
		if (DB::affectedRows($query) > 0) {
			$i++;
		}
	}
	if ($i > 0) {
		$modulo = DB::queryFirstRow("SELECT * FROM modulos WHERE id=%s", $_GET['modulo']);
	} else {
		echo '<script>alert("Você não tem permissão para acessar essa página!");location.href="index.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $modulo['nome']; ?> - Sourcepanel - <?php echo $patente['nome']; ?> <?php echo $dados_alistado['nick']; ?></title>
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
			<li class="tooltippedbtn" data-position="bottom" data-tooltip="Minhas moedas"><a href="#loja" class="modal-trigger"><span style="font-size:18px;"><strong><?php echo $dados_painel['moedas']; ?></strong> <img src="assets/img/moeda.png" style="position:relative;top:5px;" class="hide-on-small-only"><img src="assets/img/moeda2.png" style="position:relative;top:1px;" class="hide-on-med-and-up"><span class="hide-on-small-only"></span></span></a></li>
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
	<li class="notifica-notificacao blue darken-4 waves-effect waves-light"><a class="notifica-header">NOTIFICAÇÕES</a></li>
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
	<li class="notifica notifica-bottom blue darken-4 waves-effect waves-light"></li>
</ul>
<div class="z-depth-2" style="background:#FFFFFF;height:45px;">
	<div class="circle waves-effect sidenav-trigger" data-target="mobile-navbar" style="height:40px;width:40px;text-align:center;margin-top:2px;margin-left:15px;"><i style="margin-top:7px;font-size:28px;" class="material-icons">menu</i></div>
</div>
<ul id="mobile-navbar" class="sidenav">
	<li style="margin-top:-20px;">
		<div class="user-view blue darken-4">
			<a href="#"><div class="card blue darken-3" title="<?php echo $_SESSION['usuario'] ?>" style="margin-top:8px;width:50px;height:50px;background: url(https://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $_SESSION['usuario'] ?>&amp;action=std&amp;direction=3&amp;head_direction=3&amp;gesture=sml&amp;size=m) no-repeat -8px -15px;border-radius: 50px;float: right;margin-left: 10px;"></div></a>
			<a href="#"><span class="white-text name"><?php echo $_SESSION['usuario']; ?></span></a>
			<a href="#"><span class="white-text email"><?php echo $patente['nome']; ?></span></a>
		</div>
	</li>
		<?php
			/*$menus = mysqli_query($grupo_mysqli, "SELECT * FROM ac_menu_pai WHERE menu_status='ativo' ORDER by menu_ordem");
			while($menu = mysqli_fetch_assoc($menus)){
				$submenus = mysqli_query($grupo_mysqli, "SELECT * FROM ac_modulos a, ac_permissoes b, ac_cargos_relacoes c WHERE a.mdl_status = 'ativo' AND c.id=".$_SESSION['id']." AND b.cargo_id = c.cargo_id AND b.mdl_id = a.mdl_id AND a.mdl_pai_id=".$menu['menu_id']." GROUP BY a.mdl_id ORDER BY a.mdl_ordem");

				if(!empty($menu['menu_link']) AND $menu['menu_geral'] == "sim"){
					echo '<li id='.$menu['menu_id'].'><a class="modal-trigger waves-effect" href="'.$menu['menu_link'].'">';
					if (!empty($menu['menu_icon'])) {
						echo '<img src="'.$menu['menu_icon'].'" class="sidenav-icon"> ';
					}
					echo $menu['menu_nome'].'</a></li>';
				}

				if(mysqli_num_rows($submenus) >= 1 OR $menu['menu_geral'] == "sim" AND empty($menu['menu_link'])){
					echo '<ul class="collapsible collapsible-accordion">
					<li class="bold" id='.$menu['menu_id'].'><a style="padding-left:30px;" class="collapsible-header waves-effect">';
					if (!empty($menu['menu_icon'])) {
						echo '<img src="'.$menu['menu_icon'].'" class="sidenav-icon"> ';
						}
						echo $menu['menu_nome'].'</a>
						<div class="collapsible-body">
							<ul>
						';
						while ($submenu = mysqli_fetch_assoc($submenus)){
							echo '<li><a style="padding-left:50px;" href="index.php?modulo='.$submenu['mdl_id'].'&tipo='.$submenu['mdl_link'].'">'.$submenu['mdl_nome'].'</a></li>';
						}
						echo'</ul>
						</div>
						</li>
						</ul>';
				}
			}*/
		?>
	</li>
</ul>
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