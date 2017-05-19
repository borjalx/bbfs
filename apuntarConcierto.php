<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'm' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>BBFsound</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/estilosConcierto.css">
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
                    <a href="musico.php">Mi Perfil</a>
                    <a href="logout.php">SALIR</a>
                </nav>
            </header>
            <section class="main">
                <article>
                    <h2 class="titulo">CONCIERTOS</h2>
                    <div class="centrar-tabla">
                        <table>
                            <tr>
                                <th>ID concierto</th> <th>Nombre concierto</th> <th>Fecha</th> <th>Hora</th> <th>Local</th> <th>Ciudad</th><br>
                            </tr>
                            <?php
                            $conc = conciertoSinMusico();
                            while ($fila = mysqli_fetch_array($conc)) {
                            extract($fila);
                            if(!comprobarApuntadoConcierto($email, $idconcierto)){
                            echo "<tr>";
                                echo "<td>$idconcierto</td> <td>$nombre</td> <td>$fecha</td> <td>$hora</td> <td>$n_local</td> <td>$nombre_ciudad</td>";
                            echo "</tr>";
                            }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="centrar">
                    <form action="" method="POST">
                        <label for="idconcierto">ID del Concierto</label>
                        <select name="con_c" id="idconcierto">
                            <?php
                            $conc = conciertoSinMusico();
                            while ($fila = mysqli_fetch_array($conc)){
                            extract($fila);
                            if(!comprobarApuntadoConcierto($email, $idconcierto)){
                            echo "<option value='$idconcierto'> $idconcierto</option>";
                            }
                            }
                            ?>
                        </select>
                        <input type="submit" name="escoger1" value="ESCOGER">
                    </form>
                    </div>
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
if(isset($_POST['escoger1'])){
$idc = $_POST['con_c'];
$hoy = getdate();
$date = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
apuntaraConcierto($idc, $email, $date);
header("location:apuntarConcierto.php");
}
}else{
echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
echo '<script type="text/javascript">';
echo 'alert("NO estás autentificado");';
echo '</script>';
}
?>