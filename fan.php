<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["tipo_u"]) == 'f'){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
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
					<?php
                    require_once 'bbdd_bbfs.php';

                    $ranking = conciertosxciudad($email);

                    echo "<h2 class='titulo'>CONCIERTOS DE $ciudad</h2>";
                    echo '<div class="centrar-tabla">';
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Nombre</th> <th>Estado</th> <th>Fecha</th> <th>Hora</th> <th>Local</th> <th>Género</th><br>";
                    echo "</tr>";
                    while ($fila = mysqli_fetch_array($ranking)) {
                        extract($fila);
                        /* Siempre después de extract las variables se llaman como en la bbdd
                         */
                        echo "<tr>";
                        echo "<td>$nombre_c</td> <td>$estado</td> <td>$fecha</td> <td>$hora</td> <td>$nombre_l</td> <td>$nombre_genero</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
				</article>
				
				<article>
					<?php
                    require_once 'bbdd_bbfs.php';

                    $sel = conciertosxgenero($email);

                    echo "<h2 class='titulo'>CONCIERTOS DE $genero</h2>";
                    echo '<div class="centrar-tabla">';
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Nombre</th> <th>Fecha</th> <th>Hora</th> <th>Local</th> <th>Ciudad</th><br>";
                    echo "</tr>";
                    while ($fila = mysqli_fetch_array($sel)) {
                        extract($fila);
                        /* Siempre después de extract las variables se llaman como en la bbdd
                         */
                        echo "<tr>";
                        echo "<td>$nombre_c</td> <td>$fecha</td> <td>$hora</td> <td>$nombre_l</td> <td>$nombre_ciudad</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
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
    /*
    echo "<h2>Login o Password Incorrectos</h2>";*/
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado ");';
    echo '</script>';
   
}
?>