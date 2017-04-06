<!DOCTYPE html>
<?php
session_start();
/*me falta hacer que a los locales les salga los musicos por ciudad y generos disponibles*/
/*Tengo error a la hora de autentificar el tipo de usuario (MAR)*/
if(isset($_SESSION["tipo_u"]) == 'l'){
require_once 'bbdd_bbfs.php';
$nombre = $_SESSION["nombre_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$aforo = $_SESSION["aforo_u"];
$direccion = $_SESSION["direccion_u"];
$genero = $_SESSION["genero_u"];

//$n_ciudad = nombreCiudad($ciudad);
?>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>BBFsound</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
	</head>
	<body>
		<div class="contenedor">
			<header>
				<div class="logo">
					<a href="home.php"><img src="imagenes/logo.png" width="" alt="BBFsound"></a>
				</div>
				<form action="home.php" method="post">
					<input type="text" name="buscador" placeholder="Buscar en BBFsound...">
					<button type="submit" name="buscar"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
				<nav>
					<a href="home2.php">Home</a>
                                        <a href="settings-local.php">Settings</a>
                                        <a href="logout.php">SALIR</a>
				</nav>
			</header>
			
			<section class="main">
				<article>
					<h2 class="titulo">PROXIMOS CONCIERTOS</h2>
					<div class="centrar-tabla">
					<table>
						<tr>
							<th>Columna</th>
							<th>Columna</th>
							<th>Columna</th>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
					</table>
					</div>
				</article>
				
				<article>
					<h2 class="titulo">VOTAR CONCIERTOS</h2>
					<div class="centrar-tabla">
					<table>
						<tr>
							<th>Columna</th>
							<th>Columna</th>
							<th>Columna</th>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
						<tr>
							<td>Fila</td>
							<td>Fila</td>
							<td>Fila</td>
						</tr>
					</table>
					</div>
				</article>
			</section>
			
			<aside>
				<div class="imagen"></div>
				<h2><?php echo $nombre;?></h2>
				<p>
                                <div>Nombre : <?php echo $nombre;?></div>
                                <div>Ciudad : <?php echo $ciudad;?></div>
                                <div>Teléfono : <?php echo $telefono;?></div>
                                <div>Aforo : <?php echo $aforo;?></div>
                                <div>Dirección : <?php echo $direccion;?></div>
                                <div>Genero : <?php echo $genero?></div>
                                </p>
				<div class="imagen"></div>
			</aside>
			
			<footer>
				<div class="derechos-autor">
					<p>Todos los derechos reservados Copyright © BBFsound 2017.</p>
				</div>
				<section class="redes-sociales">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
				</section>
			</footer>
		</div>
	</body>
</html>
<?php
}else{
    /*
    echo "<h2>Login o Password Incorrectos</h2>";*/
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado");';
    echo '</script>';
    
}
?>