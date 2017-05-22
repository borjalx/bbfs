<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'f' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
$tipo = $_SESSION['tipo_u'];
$nombre = $_SESSION["nombre_u"];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BBFsound</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/inicio-sesion.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
    </head>
    <body>
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
                    <h2 class="titulo">CONCIERTOS</h2>
                    <form class="formulario" action="" method="POST">
                        <select name="concierto">
                            <?php
                            $ranking = conciertosCelebrados();
                            while ($fila = mysqli_fetch_array($ranking)) {
                            extract($fila);
                            echo "<option value='$idconcierto'>$nombre</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="apuntar" value="He Asistido">
                    </form>
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
if(isset($_POST['apuntar'])){
$concierto = $_POST['concierto'];

if(!comprobarConciertoAsistido($email, $concierto)){
apuntarConciertoAsistido($email, $concierto);
}else{
echo "<p class='aviso'>Ya sabemos que has asistido a ese concierto!</p>";
}

}
}else{
/*
echo "<h2>Login o Password Incorrectos</h2>";*/
echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
echo '<script type="text/javascript">';
echo 'alert("NO estás autentificado ");';
echo '</script>';

}
?>