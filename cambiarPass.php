<?php
/*
  NO FUNCIONA CORRECTAMENTE A LA HORA DE COMPROBAR CUANDO SON ERRONEAS Y A LA HORA DE CAMBIARLAS
*/
session_start();
require_once 'bbdd_bbfs.php';
if (isset($_SESSION['tipo_u'])) {
    $email = $_SESSION["email_u"];
    $tipo = $_SESSION['tipo_u'];

    if (isset($_POST['comprobar'])) {
        $contraseña = $_POST['pass11'];
        $conrtaseña2 = $_POST['pass12'];
        if ($contraseña == $conrtaseña2) {
            if (verificarUsuario($email, $contraseña) == true) {
                ?>
                <form action="" method="POST">
                    Nueva contraseña: <br><input type="password" name="pass21"><br>
                    Verificación contrseña: <br><input type="password" name="pass22"><br>
                    <input type="submit" name="cambiar" value="cambiar">
                </form>
                <?php
            } else {
                echo "Esta no es la contraseña";
            }
        } else {
            echo '<br>Fallo en verificación contraseñas<br>';
        }
    } else if (isset($_POST['cambiar'])) {
        $email = $_SESSION["email_u"];
        $contraseña3 = $_POST['pass21'];
        $conrtaseña4 = $_POST['pass22'];
        if ($contraseña3 == $conrtaseña4) {
            cambiarPass($email, $contraseña3,$tipo);
        } else {
            echo 'Contraseña erronea';
        }
    } else {
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
                            echo '<a href="fan.php"> Volver a mi perfil</a><br>';
                        }else if($tipo == 'm'){
                            echo '<a href="settings-musico.php">Settings</a>';
                            echo '<a href="musico.php"> Volver a mi perfil</a><br>';
                        }else if($tipo == 'l'){
                            echo '<a href="settings-local.php">Settings</a>';
                            echo '<a href="local.php"> Volver a mi perfil</a><br>';
                        }
                        ?>   
                            <a href="logout.php">SALIR</a>
                        </nav>
                    </header>
                <section class="main">
                <article>
                <h2 class="titulo">Cambiar contraseña</h2>
                <form class="formulario" action="" method="POST">
                    <label for="actual">Contraseña actual:</label> <br><input type="password" name="pass11" id="actual"><br>
                    <label for="verificar">Verificación contraseña:</label> <br><input type="password" name="pass12" id="verificar"><br>
                    <input type="submit" name="comprobar" value="COMPROBAR">
                </form>
            <?php
            }
            ?>
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
} else {
    header('Location:home.php');
}
?>

