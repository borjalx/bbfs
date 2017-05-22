<?php
session_start();
require_once 'bbdd_bbfs.php';
$email_musico = $_GET['email_m'];
$tipo = $_SESSION['tipo_u'];
$ranking = verPerfilMusico($email_musico);
while ($fila = mysqli_fetch_array($ranking)) {
extract($fila);
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>BBFsound</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/verPerfil.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
    </head>
    <div class="contenedor">
        <header>
            <div class="logo">
                <a href="home.php"><img src="imagenes/logo.png" width="" alt="BBFsound"></a>
            </div>
            <nav>
                <?php
                if($tipo == 'f'){
                echo '<a href="settings-fan.php">Settings</a>';
                echo '<a href="fan.php">Mi Perfil</a><br>';
                }else if($tipo == 'm'){
                echo '<a href="settings-musico.php">Settings</a>';
                echo '<a href="musico.php">Mi Perfil</a><br>';
                }else if($tipo == 'l'){
                echo '<a href="settings-local.php">Settings</a>';
                echo '<a href="local.php">Mi Perfil</a><br>';
                }
                ?>
                <a href="logout.php">SALIR</a>
            </nav>
        </header>
        <section class="main">
            <article>
                <div class="perfil">
                    
                    <h2 class="titulo"><?php echo "$nombre";?></h2>
                    <div class="imagen"></div>
                    <p><b>Nombre:</b> <?php echo $nombre;?></p>
                    <p><b>Ciudad:</b> <?php echo $nombre_ciudad;?></p>
                    <p><b>Teléfono:</b> <?php echo $telefono;?></p>
                    <p><b>Genero:</b> <?php echo $nombre_genero;?></p>
                    <p><b>Nº Componentes:</b> <?php echo $n_componentes;?></p>
                    
                </div>
                <a href="votarMusico.php">Volver</a>
            </article>
        </section>
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