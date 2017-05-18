<!DOCTYPE html>
<?php
session_start();
if(strcasecmp($_SESSION['tipo_u'] , 'f' ) == 0){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
$nombre = $_SESSION["nombre_u"];

//$n_ciudad = nombreCiudad($ciudad);
if(isset($_POST['votopos'])){
    
    $idc = $_POST['concierto'];
    if(comprobarVotoConcierto($email, $idc)){
        echo "Ya has votado al concierto";
        echo "<a href='votarConcierto.php'> Volver </a>";
    }else{
        votarConcierto($email, $idc, true);
    }
    
    
}else if(isset($_POST['votoneg'])){
    
    $idc = $_POST['concierto'];
    if(comprobarVotoConcierto($email, $idc)){
        echo "Ya has votado al concierto";
        echo "<a href='votarConcierto.php'> Volver </a>";
    }else{
        votarConcierto($email, $idc, false);
    }    
}else{
    
?>
<form action="" method="POST">
    Conciertos:
    <select name="concierto">
        <?php
    $ranking = conciertosAsistidos($email);
    while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
    echo "<option value='$idconcierto'>$nombre</option>";
}
        ?>
    </select>
    <input type="submit" name="votopos" value="votopos">
    <input type="submit" name="votoneg" value="votoneg">
    
</form>

<?php
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