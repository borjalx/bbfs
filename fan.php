<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["nombre_u"])){
require_once 'bbdd_bbfs.php';
$nombre = $_SESSION["nombre_u"];
$apellido = $_SESSION["apellido_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$sexo = $_SESSION["sexo_u"];
$genero = $_SESSION["genero_u"];
$nacimiento = $_SESSION["nacimiento_u"];

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
					<a href="#">Settings</a>
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
				<h2><?php echo "$nombre $apellido";?></h2>
                                <p>
                                <div>Nombre : <?php echo $nombre;?></div>
                                <div>Apellido : <?php echo $apellido;?></div>
                                <div>Teléfono : <?php echo $telefono;?></div>
                                <div>Nombre Ciudad : <?php echo $ciudad;?></div>
                                <div>Sexo : <?php echo $sexo;?></div>
                                <div>Género : <?php echo $genero;?></div>
                                <div>Nacimiento : <?php echo $nacimiento;?></div>
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
    echo "NO estas autentificado";
    header("Location:home.php");
}
?>