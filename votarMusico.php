<?php
session_start();
if(isset($_SESSION["tipo_u"]) == 'f'){
require_once 'bbdd_bbfs.php';
$email = $_SESSION["email_u"];
$nombre = $_SESSION["nombre_u"];


if(isset($_POST['votopos'])){

    $email_musico = $_POST['musico'];
    
    
    $rankings = mca2($email,$email_musico);
    while ($fila = mysqli_fetch_array($rankings)) {
    extract($fila);
    }
    
    if(comprobarVotoMusico($email, $idc)){
        echo "Ya has votado al musico";
        echo "<a href='votarMusico.php'> Volver </a>";
    }else{
        votarMusico($email, $email_musico, true, $idc);
    }
    
    
}else if(isset($_POST['votoneg'])){
    
    $email_musico = $_POST['musico'];
    
    
    $rankings = mca2($email,$email_musico);
    while ($fila = mysqli_fetch_array($rankings)) {
    extract($fila);
    }
    
    if(comprobarVotoMusico($email, $idc)){
        echo "Ya has votado al musico";
        echo "<a href='votarMusico.php'> Volver </a>";
    }else{
        votarMusico($email, $email_musico, false, $idc);
    }   
}else{
    
?>
<form action="" method="POST">
    Musicos:
    <select name="musico">
        <?php
    $ranking = musicosConciertosAsistidos($email);
    while ($fila = mysqli_fetch_array($ranking)) {
    extract($fila);
    echo "<option value='$musico_mail'>$n_u - $c_u</option>";
    
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