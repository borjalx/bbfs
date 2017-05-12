<?php
session_start();
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
if(isset($_POST['editar'])){
$name = $_POST['name'];
$tel = $_POST['tel'];
$town = $_POST['town'];
$gender = $_POST['gender'];
$afo = $_POST['afo'];
$dir = $_POST['dir'];
editarLocal($email, $name, $tel, $town, $gender, $afo, $dir);
}else if (isset($_SESSION["tipo_u"]) == 'l') {
$nombre = $_SESSION["nombre_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$aforo = $_SESSION["aforo_u"];
$direccion = $_SESSION["direccion_u"];
$genero = $_SESSION["genero_u"];
//$n_ciudad = nombreCiudad($ciudad);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BBFsound</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/estilossettings.css">
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
                    <a href="local.php"> Volver a mi perfil</a><br>
                    <a href="logout.php">SALIR</a>
                </nav>
            </header>
            <section class="main">
                <article>
                    <h2 class="titulo"><?php echo "$nombre"; ?></h2>
                    <form  class="formulario" action="" method="POST">
                        <p> Nombre : </p>
                        <input type="text" name="name" value="<?php echo $nombre; ?>"/>
                        <p> Dirección : </p>
                        <input type="text" name="dir" value="<?php echo $direccion; ?>"/>
                        <p> Telefono : </p>
                        <input type="text" name="tel" value="<?php echo $telefono; ?>"/>
                        <p> Aforo : </p>
                        <input type="number" name="afo" value="<?php echo $aforo; ?>"/>
                        <p> Ciudad : </p>
                        <select name="town" selected="<?php echo $ciudad; ?>">
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
                        <select name="gender">
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
                        <p><a href="cambiarPass.php"><i class="fa fa-lock" aria-hidden="true"></i> Cambiar contraseña</a></p>
                        <input type="submit" name="editar" value="EDITAR">
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
else {
/*
echo "<h2>Login o Password Incorrectos</h2>"; */
echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
echo '<script type="text/javascript">';
echo 'alert("NO estás autentificado ");';
echo '</script>';
}
?>