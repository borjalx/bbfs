<?php
session_start();

if(strcasecmp($_SESSION['tipo_u'] , 'l' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form class="formulario" action="" method="POST">							
                Nombre del concierto :
                <input type="text" name="nombrec">
                Fecha:
                <input type="date" name="fecha">
                Hora:
                <input type="time" name="hora">
                Precio entrada : 
                <input type="number" name="precio">
                Genero musical favorito:
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
                <input type="submit" name="crear" value="CREAR">
        </form>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
<?php

if(isset($_POST['crear'])){
    $nombre_conc = $_POST['nombrec'];
    $fecha_conc = $_POST['fecha'];
    $hora_conc = $_POST['hora'];
    $precio_conc = $_POST['precio'];
    $idgenero = $_POST["genero"];
    
    crearConcierto($nombre_conc, $fecha_conc, $hora_conc, $precio_conc, $email, $idgenero);
}
}else{
    /*
    echo "<h2>Login o Password Incorrectos</h2>";*/
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=http://localhost/BBFS/inicio-sesion.php">';
    echo '<script type="text/javascript">';
    echo 'alert("NO estás autentificado");';
    echo '</script>';
    
}
?>