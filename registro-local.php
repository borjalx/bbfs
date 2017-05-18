<?php
require_once 'bbdd_bbfs.php';
if(isset($_POST['enviar'])){
    
    $email = $_POST['correo'];
    $contraseña = $_POST['password'];
    $nombre = $_POST['nombre-local'];
    $direccion = $_POST['direccion-local'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $aforo = $_POST['aforo'];
    $genero = $_POST['genero'];
     
   registrarLocal($email, $nombre, $telefono, $ciudad, $genero, $aforo, $direccion, $contraseña);
}else{
    ?>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Registro LOCAL BBFsound</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link rel="stylesheet" href="css/registro.css">
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
					<a href="home.php">Home</a>
                                        <a href="inicio-sesion.php">ENTRAR</a>
					
				</nav>
			</header>
			
			<section class="main">
				<article>
					<nav>
						<a href="registro-fan.php">Registro FAN</a>
						<a href="registro-musico.php">Registro MÚSICO</a>
					</nav>
					<h2 class="titulo">Registro LOCAL</h2>
						<form class="formulario" action="" method="POST">
							
							<label for="nombre-local">Nombre del local:</label>
							<input type="text" name="nombre-local" id="nombre-local">
							
							<label for="direccion-local">Direccion del local:</label>
							<input type="text" name="direccion-local" id="direccion-local">

							<label for="correo">Correo electrónico:</label>
							<input type="email" name="correo" id="correo">

							<label for="password">Contraseña:</label>
							<input type="password" name="password" id="password">
							
							<label for="telefono">Teléfono:</label>
							<input type="number" name="telefono" id="telefono">

							<label for="aforo">Aforo:</label>
							<input type="number" name="aforo" id="aforo">
							<p>Ciudad:</p>
							<select name="ciudad">
								<option value="4">Madrid</option>
								<option value="2">Barcelona</option>
								<option value="1">Valencia</option>
								<option value="3">Sevilla</option>
								<option value="10">Zaragoza</option>
								<option value="5">Malaga</option>
								<option value="6">Murcia</option>
								<option value="7">Mallorca</option>
								<option value="8">Gran Canaria</option>
								<option value="9">Bilbao</option>
							</select>
							<p>Genero musical favorito:</p>
							<select name="genero">
								<option value="1">Rock</option>
								<option value="2">Rap</option>
								<option value="5">Electrónica</option>
								<option value="6">Hip Hop</option>
								<option value="3">Trap</option>
								<option value="7">Pop</option>
								<option value="8">Reggae</option>
								<option value="9">Jazz</option>
								<option value="10">Reggaeton</option>
								<option value="4">Bachata</option>
							</select>
							<input type="submit" name="enviar" value="ENVIAR">
						</form>
				</article>
			</section>
			
			<aside>
				<div class="imagen"></div>
				
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
} 
?>

