<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>BBFsound</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/estiloshome.css">
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
                    <a href="inicio-sesion.php">Iniciar sesión</a>
                    <a href="registro-fan.php">Regístrate AQUÍ</a>
                </nav>
            </header>

            <section class="main">
                <article>
                    <?php
                    require_once 'bbdd_bbfs.php';

                    $ranking = rankingMusicos();

                    echo '<h2 class="titulo">RANKING MUSICOS</h2>';
                    echo '<div class="centrar-tabla">';
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Nombre</th> <th>Votos</th><br>";
                    echo "</tr>";
                    while ($fila = mysqli_fetch_array($ranking)) {
                        extract($fila);
                        /* Siempre después de extract las variables se llaman como en la bbdd
                         */
                        echo "<tr>";
                        echo "<td>$nombre</td> <td>$Votos</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                    </div>
                </article>

                <article>
                    
                    <?php
                    require_once 'bbdd_bbfs.php';

                    $ranking = agendaConciertos();

                    echo '<h2 class="titulo">AGENDA CONCIERTOS</h2>';
                    echo '<div class="centrar-tabla">';
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Nombre</th> <th>Fecha</th> <th>Género</th><br>";
                    echo "</tr>";
                    while ($fila = mysqli_fetch_array($ranking)) {
                        extract($fila);
                        /* Siempre después de extract las variables se llaman como en la bbdd
                         */
                        echo "<tr>";
                        echo " <td>$nombre</td> <td>$fecha</td> <td>$nombre_genero</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                    </div>
                </article>
            </section>

            <aside>
                <div class="imagen"></div>
                <div class="imagen"></div>
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