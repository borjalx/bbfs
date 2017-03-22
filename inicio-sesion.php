
<!--https://reyvolsamweb.wordpress.com/2012/04/19/iniciando-sesin-sistema-de-inicio-de-sesin-en-php-y-mysql/-->


        <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Registro FAN BBFsound</title>
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
                            <a href="home.php">Home</a>
                            <a href="registro-fan.php">Regístrate AQUÍ</a>
                        </nav>
                    </header>

                    <section class="main">
                        <article>
                            <h2 class="titulo">Inicio de Sesion</h2>
                            <form class="formulario" action="" method="POST">

                                <label for="nombre-usuario">Email</label>
                                <input type="email" name="email" id="nombre-usuario">

                                <label for="password1">Contraseña:</label>
                                <input type="password" name="password1" id="password1">

                                <input type="submit" name="entrar" value="ENTRAR">
                            </form>
                            <?php
                            require_once 'bbdd_bbfs.php';
                            if (isset($_POST['entrar'])) {

                            $email = $_POST['email'];
                            $pass = $_POST['password1'];

                            inicioSesion($email, $pass);

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
