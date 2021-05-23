<?php 

$misRedes = shell_exec('netsh wlan show profiles');
$redes = substr($misRedes, 180);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$search = $_POST['wifiName'];

	$shell = shell_exec('netsh wlan show profile name=' . $search . ' key=clear');
	$tot = strrpos($shell, 'Contenido de la clave  :');
	$result = substr($shell, $tot) . "                  ";
	$result = substr($result, 25, 18);
	$result = "Su contraseña es: " . $result;
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Mis redes Wi-Fi</title>
	<link rel="stylesheet" type="text/css" href="app.css">
</head>
<body>
	<div class="box">
		
		<?php if(!isset($_POST['wifiName'])) { ?>
		<h1>Redes Wi-Fi</h1>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<input type="search" name="wifiName" class="form-control" placeholder="Nombre del Wi-Fi" autocomplete="off">
		</form>
		<?php echo "<pre>$redes</pre>"; ?>
		<?php } else { ?>
		<h1>Mi busqueda: <?php echo strtoupper($_POST['wifiName']); ?></h1>
		<?php echo "<pre>$result</pre>"; ?>
		<?php } ?>
	</div>
</body>
</html>