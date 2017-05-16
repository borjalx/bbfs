<?php
session_start();
if (isset($_SESSION["tipo_u"]) == 'l') {
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
if(isset($_POST['modificar'])){
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $precio = $_POST['precio'];
    $idgenero = $_POST['gender'];
    $idc = $_POST['idc'];
    
    modificarConcierto($idc, $nombre, $fecha, $hora, $precio, $idgenero);
}
if(isset($_POST['escoger'])){
    $idc = $_POST['concierto'];
    
    $ranking = datosConcierto($idc);    
    while ($fila = mysqli_fetch_array($ranking)) {
        extract($fila);
    }
?>
<form action="" method="POST">
    Nombre
    <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
    Fecha
    <input type="date" name="fecha" value="<?php echo $fecha; ?>"><br>
    Hora
    <input type="time" name="hora" value="<?php echo $hora; ?>"><br>
    Precio
    <input type="number" name="precio" value="<?php echo $precio; ?>"><br>
    Genero:
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
    </select><br>
    <input type="hidden" name="idc" value="<?php echo $idc; ?>"><br>
    <input type="submit" name="modificar" value="modificar">
</form>
<?php
}else{
?>
<form action="" method="POST">
    Nombre concierto modificable:
    <select name="concierto">
        <?php
        $ranking2 = conciertosModificables($email);
        while ($fila = mysqli_fetch_array($ranking2)) {
        extract($fila);
        echo "<option value='$idconcierto'> $nombre </option>";
        }
        ?>
    </select>
    <input type="submit" name="escoger" value="escoger">
</form>
<?php
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