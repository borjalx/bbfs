<!DOCTYPE html>
<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'm' ) == 0){
require_once 'bbdd_bbfs.php';
$nombre_m = $_SESSION["nombre_u"];
$telefono = $_SESSION["tel_u"];
$ciudad = $_SESSION["ciudad_u"];
$genero = $_SESSION["genero_u"];
$nc = $_SESSION["nc_u"];
$email = $_SESSION["email_u"];
$idg = $_SESSION["idg_u"];
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
                    <a href="apuntarConcierto.php">Apuntarse</a>
                    <a href="desapuntarConcierto.php">Desapuntarse</a>
                    <a href="settings-musico.php">Settings</a>
                    <a href="logout.php">SALIR</a>
                </nav>
            </header>
            
            <section class="main">
                <article>
                    <?php
                    require_once 'bbdd_bbfs.php';
                    $ranking = conciertosxciudad_m($email);
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
                        $sel = conciertosxgenero_m($email);
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
                        <article>
                            <?php
                            require_once 'bbdd_bbfs.php';
                            $sel = calqtha($email);
                            echo "<h2 class='titulo'>CONCIERTOS A LOS QUE TE HAS APUNTADO</h2>";
                            echo '<div class="centrar-tabla">';
                                echo "<table>";
                                    echo "<tr>";
                                        echo "<th>Nombre</th> <th>Fecha</th> <th>ACEPTADO</th> <br>";
                                    echo "</tr>";
                                    while ($fila = mysqli_fetch_array($sel)) {
                                    extract($fila);
                                    /* Siempre después de extract las variables se llaman como en la bbdd
                                    */
                                    $ac;
                                    if($aceptado == false){
                                    $ac = "No";
                                    }else if($aceptado == true){
                                    $ac = "Si";
                                    }
                                    echo "<tr>";
                                        echo "<td>$nombre</td> <td>$fecha</td> <td>$ac</td>";
                                    echo "</tr>";
                                    }
                                echo "</table>";
                                ?>
                            </article>
                        </section>
                        
                        
                        <aside>
                            <div class="imagen"></div>
                            <div>
                                <h2><?php echo "$nombre_m";?></h2>
                                <p>Nombre : <?php echo $nombre_m;?></p>
                                <p>Ciudad : <?php echo $ciudad;?></p>
                                <p>Teléfono : <?php echo $telefono;?></p>
                                <p>Genero : <?php echo $genero;?></p>
                                <p>Nº componentes : <?php echo $nc;?></p>
                                <p>ID Genero : <?php echo $idg;?></p>
                                <p>Votos positivos: <?php 
                                $votos1 = votosp($email); 
                                while ($fila = mysqli_fetch_array($votos1)) {
                                    extract($fila);
                                    echo $n_v;
                                }
                                    ?></p>
                                <p>Votos negativos: <?php 
                                $votos2 = votosn($email); 
                                while ($fila = mysqli_fetch_array($votos2)) {
                                    extract($fila);
                                    echo $n_v;
                                    //echo $n_v;
                                }
                                    ?></p>
                            </div>
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